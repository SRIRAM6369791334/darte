<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    /**
     * View the Checkout page with the user's current cart items.
     */
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $userId = $user->id;
        $cartItems = Cart::whereHas('product')
            ->with(['product', 'variant'])
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        $totalGst = 0;
        foreach ($cartItems as $item) {
            $price = $item->variant->offer_price ?? $item->product->product_price;
            $quantity = $item->product_quantity;
            $subtotal += $price * $quantity;

            // Calculate GST if available on variant
            $gstRate = $item->variant->product_gst ?? 0;
            $totalGst += ($price * $quantity) * ($gstRate / 100);
        }

        $states = \App\Models\State::all();

        // Fetch latest order for address fallback
        $latestOrder = \Illuminate\Support\Facades\DB::table('product_orders')
            ->where('user_id', $userId)
            ->latest()
            ->first();

        // Helper: pick first non-empty value from a list
        $pick = fn(...$vals) => collect($vals)->first(fn($v) => !empty(trim((string) $v)), '');

        // Resolve all address fields: user profile (shipping) → user profile (billing) → latest order
        $addr = (object) [
            'name'     => $pick($user->shipping_name,    $user->billing_name,    $latestOrder->shipping_name    ?? '', $user->name),
            'phone'    => $pick($user->shipping_phone,   $user->billing_phone,   $latestOrder->shipping_phone   ?? '', $user->phone_number, $user->phone),
            'door_no'  => $pick($user->shipping_door_no, $user->billing_door_no, $latestOrder->shipping_door_no ?? ''),
            'street'   => $pick($user->shipping_street,  $user->billing_street,  $latestOrder->shipping_street  ?? ''),
            'area'     => $pick($user->shipping_area,    $user->billing_area,    $latestOrder->shipping_area    ?? ''),
            'city'     => $pick($user->shipping_city,    $user->billing_city,    $latestOrder->shipping_city    ?? ''),
            'state'    => $pick($user->shipping_state,   $user->billing_state,   $latestOrder->shipping_state   ?? ''),
            'pincode'  => $pick($user->shipping_pincode, $user->billing_pincode, $latestOrder->shipping_pincode ?? ''),
        ];

        $userState = trim($addr->state);
        $userCity  = trim($addr->city);

        $stateRecord = \App\Models\State::where('name', $userState)->first();
        $shippingCharge = $stateRecord ? $stateRecord->shipping_charge : 0;

        $totalAmount = $subtotal + $totalGst + $shippingCharge;

        return view('pages.checkout', compact(
            'cartItems', 'subtotal', 'totalGst', 'shippingCharge',
            'totalAmount', 'states', 'user', 'addr', 'userState', 'userCity'
        ));
    }

    /**
     * Get shipping charge for a selected state via AJAX.
     */
    public function getShippingCharge(Request $request)
    {
        $stateName = trim($request->state_name);
        $state = \App\Models\State::where('name', $stateName)->first();

        if ($state) {
            return response()->json([
                'status' => 'success',
                'shipping_charge' => $state->shipping_charge
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'State not found.'
        ], 404);
    }

    /**
     * Get cities (districts) for a selected state via AJAX.
     */
    public function getCitiesByState(Request $request)
    {
        $stateName = trim($request->state_name);

        $cities = \App\Models\District::where('state_name', $stateName)
            ->orderBy('name', 'asc')
            ->pluck('name');

        return response()->json([
            'status' => 'success',
            'cities' => $cities
        ]);
    }

    /**
     * Get available couriers from Shiprocket based on pincode and weight.
     */
    public function getShiprocketCouriers(Request $request)
    {
        $deliveryPincode = $request->pincode;
        $paymentMethod = $request->payment_method; // 'Cash on Delivery' or 'Online Payment'
        $isCod = ($paymentMethod === 'Cash on Delivery') ? 1 : 0;

        $userId = Auth::id();
        $cartItems = Cart::whereHas('product')->with(['variant'])->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Cart is empty.']);
        }

        // Calculate total weight
        $totalWeight = 0;
        foreach ($cartItems as $item) {
            $totalWeight += ($item->variant->weight ?? 0.5) * $item->product_quantity;
        }

        // Normalize weight: If totalWeight is > 10, it's likely grams (e.g. 50g). 
        // Shiprocket expects KG. 50kg for a standard order is unlikely for this store.
        if ($totalWeight > 10) {
            $totalWeight = $totalWeight / 1000;
        }
        $totalWeight = max($totalWeight, 0.1); // Minimum weight 0.1kg for serviceability

        try {
            $shiprocket = new \App\Services\ShiprocketService();
            $params = [
                'pickup_postcode' => config('services.shiprocket.pickup_pincode'), // Use dynamic pincode from config
                'delivery_postcode' => $deliveryPincode,
                'weight' => $totalWeight,
                'cod' => $isCod,
            ];

            \Illuminate\Support\Facades\Log::info('Checking couriers for pincode', $params);

            $response = $shiprocket->checkServiceability($params);

            \Illuminate\Support\Facades\Log::info('Shiprocket Serviceability Response', ['response' => $response]);

            $isSuccessful = (isset($response['status']) && $response['status'] == 200) || (isset($response['status_code']) && $response['status_code'] == 200);

            if ($isSuccessful && !empty($response['data']['available_courier_companies'])) {
                $couriers = $response['data']['available_courier_companies'];

                // Filter and format for frontend
                $formattedCouriers = array_map(function ($c) use ($isCod) {
                    return [
                        'id' => $c['courier_company_id'],
                        'name' => $c['courier_name'],
                        'rate' => $isCod ? ($c['freight_charge'] + $c['cod_charges']) : $c['freight_charge'],
                        'etd' => $c['etd'] ?? 'N/A'
                    ];
                }, $couriers);

                // Sort by rate ascending
                usort($formattedCouriers, function ($a, $b) {
                    return $a['rate'] <=> $b['rate'];
                });

                return response()->json([
                    'status' => 'success',
                    'couriers' => $formattedCouriers
                ]);
            }

            // If we got a 200 but no couriers, or a different status
            $message = 'No couriers available for this location.';
            if (isset($response['message'])) {
                $message = $response['message'];
            }

            return response()->json([
                'status' => 'error',
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Shiprocket Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Apply a coupon code via AJAX.
     */
    public function applyCoupon(Request $request)
    {
        $couponCode = $request->coupon_code;
        $subtotal = (float) $request->subtotal;

        $coupon = \App\Models\Coupon::where('codename', $couponCode)
            ->where('start_date', '<=', now()->toDateString())
            ->where('end_date', '>=', now()->toDateString())
            ->first();

        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired coupon code.'
            ]);
        }

        // Check minimum order value
        if ($subtotal < (float) $coupon->mini_amt) {
            return response()->json([
                'status' => 'error',
                'message' => 'Minimum order value of ₹' . number_format((float) $coupon->mini_amt, 2) . ' required.'
            ]);
        }

        $discount = 0;
        // 1 = Rs (Fixed amount), 2 = % (Percentage)
        if ($coupon->discounttype == '1') {
            $discount = (float) $coupon->discount;
        } elseif ($coupon->discounttype == '2') {
            $discount = ($subtotal * (float) $coupon->discount) / 100;
        }

        // Cap discount to subtotal
        if ($discount > $subtotal) {
            $discount = $subtotal;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Coupon applied successfully!',
            'discount' => $discount
        ]);
    }

    /**
     * Prepare Razorpay Order ID for the frontend modal.
     */
    public function preparePayment(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::whereHas('product')->with(['product', 'variant'])->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Cart is empty.'], 400);
        }

        // Calculation logic (Must match placeOrder exactly)
        $subtotal = 0;
        $gstAmount = 0;
        foreach ($cartItems as $item) {
            $price = $item->variant->offer_price ?? $item->product->product_price;
            $quantity = $item->product_quantity;
            $subtotal += $price * $quantity;
            $gstRate = $item->variant->product_gst ?? 0;
            $gstAmount += ($price * $quantity) * ($gstRate / 100);
        }

        $shipping = floatval($request->shipping_charge ?? 0);
        $discount = floatval($request->coupon_discount ?? 0);
        $total = ($subtotal + $gstAmount + $shipping) - $discount;

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $razorpayOrder = $api->order->create([
                'receipt' => 'rcpt_' . uniqid(),
                'amount' => (int) round($total * 100),
                'currency' => 'INR',
            ]);

            return response()->json([
                'status' => 'success',
                'razorpay_order_id' => $razorpayOrder['id'],
                'amount' => $total,
                'user' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone
                ],
                'razorpay_key' => config('services.razorpay.key')
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Payment initiation failed: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store the order details and items.
     */
    public function placeOrder(Request $request)
    {
        $userId = Auth::id();

        $rules = [
            'shipping_name' => 'required',
            'shipping_email' => 'required|email',
            'shipping_phone' => 'required',
            'shipping_door_no' => 'required',
            'shipping_street' => 'required',
            'shipping_city' => 'required',
            'shipping_state' => 'required',
            'shipping_pincode' => 'required',
            'payment_method' => 'required',
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Please fill all required fields.', 'errors' => $validator->errors()], 422);
        }

        // Razorpay Verification if Online
        if ($request->payment_method === 'Online Payment') {
            if (!$request->razorpay_payment_id || !$request->razorpay_signature || !$request->razorpay_order_id) {
                return response()->json(['status' => 'error', 'message' => 'Payment verification failed.'], 400);
            }

            try {
                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $attributes = [
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                ];
                $api->utility->verifyPaymentSignature($attributes);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Payment signature invalid.'], 400);
            }
        }

        $cartItems = Cart::whereHas('product')->with(['product', 'variant'])->where('user_id', $userId)->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Cart is empty.'], 400);
        }

        // Recalculate totals
        $subtotal = 0;
        $gstAmount = 0;
        foreach ($cartItems as $item) {
            $price = $item->variant->offer_price ?? $item->product->product_price;
            $quantity = $item->product_quantity;
            $subtotal += $price * $quantity;
            $gstRate = $item->variant->product_gst ?? 0;
            $gstAmount += ($price * $quantity) * ($gstRate / 100);
        }

        $shipping = floatval($request->shipping_charge ?? 0);
        $discount = floatval($request->coupon_discount ?? 0);
        $total = ($subtotal + $gstAmount + $shipping) - $discount;

        $orderNumber = 'ORD-' . strtoupper(uniqid());

        // Save Order
        $order = \App\Models\ProductOrder::create([
            'user_id' => $userId,
            'order_number' => $orderNumber,
            'order_id' => $orderNumber, // Added for admin dashboard compatibility
            'billing_name' => $request->shipping_name,
            'billing_email' => $request->shipping_email,
            'billing_phone' => $request->shipping_phone,
            'billing_door_no' => $request->shipping_door_no,
            'billing_street' => $request->shipping_street,
            'billing_area' => $request->shipping_area,
            'billing_city' => $request->shipping_city,
            'billing_state' => $request->shipping_state,
            'billing_pincode' => $request->shipping_pincode,
            'shipping_name' => $request->shipping_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'shipping_door_no' => $request->shipping_door_no,
            'shipping_street' => $request->shipping_street,
            'shipping_area' => $request->shipping_area,
            'shipping_city' => $request->shipping_city,
            'shipping_state' => $request->shipping_state,
            'shipping_pincode' => $request->shipping_pincode,
            'subtotal' => $subtotal,
            'gst_amount' => $gstAmount,
            'shipping_charge' => $shipping,
            'total_amount' => $total,
            'courier_name' => $request->selected_courier_name, // Record selected courier name
            'status' => 'Order Placed',
            'payment_method' => $request->payment_method,
            'payment_status' => ($request->payment_method === 'Online Payment') ? 'Paid' : 'Pending',
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
        ]);

        foreach ($cartItems as $item) {
            // Capture product_image at order time so it's available even if product is later deleted
            $productImage = $item->product->product_image ?? null;

            // Option A: Save product_image in product_order_items (web table)
            \App\Models\ProductOrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_varient_id,
                'product_name' => $item->product->product_name,
                'product_image' => $productImage,
                'variant_name' => $item->variant->varient_name ?? '',
                'quantity' => $item->product_quantity,
                'price' => $item->variant->offer_price ?? $item->product->product_price,
                'total' => ($item->variant->offer_price ?? $item->product->product_price) * $item->product_quantity,
            ]);

            // Option B: Save product_image in product_slots (dash/admin table) for cross-system compatibility
            \Illuminate\Support\Facades\DB::table('product_slots')->where('order_id', $orderNumber)
                ->where('product_id', $item->product_id)
                ->update(['product_image' => $productImage]);

            // Reduce Stock in Product Stock table
            $productStock = \App\Models\ProductStock::where('pro_ver_id', $item->product_varient_id)->first();
            if ($productStock) {
                // Ensure stock doesn't go below 0 (using max just in case)
                $productStock->availablestock = max($productStock->availablestock - $item->product_quantity, 0);
                $productStock->salestock = ($productStock->salestock ?? 0) + $item->product_quantity;
                $productStock->save();
            }

            // Sync with Product Variant table (Dashboard uses this too)
            $variant = \App\Models\ProductVarient::find($item->product_varient_id);
            if ($variant) {
                $variant->product_qty = max($variant->product_qty - $item->product_quantity, 0);
                $variant->save();
            }
        }

        Cart::where('user_id', $userId)->delete();

        // Shiprocket Integration
        try {
            $shiprocket = new \App\Services\ShiprocketService();

            $orderItems = [];
            $totalWeight = 0;
            $maxLength = 0;
            $maxBreadth = 0;
            $maxHeight = 0;

            foreach ($cartItems as $item) {
                $orderItems[] = [
                    "name" => $item->product->product_name . " " . ($item->variant->varient_name ?? ''),
                    "sku" => $item->variant->sku ?? $item->product->slug ?? 'SKU001',
                    "units" => $item->product_quantity,
                    "selling_price" => $item->variant->offer_price ?? $item->product->product_price,
                    "discount" => 0,
                    "tax" => $item->variant->product_gst ?? 0,
                    "hsn" => 441122
                ];

                // Accumulate weight and find max dimensions
                $itemWeight = (float) ($item->variant->weight ?? 0.5);
                $totalWeight += $itemWeight * $item->product_quantity;

                $maxLength = max($maxLength, (float) ($item->variant->length ?? 10));
                $maxBreadth = max($maxBreadth, (float) ($item->variant->breadth ?? 10));
                $maxHeight = max($maxHeight, (float) ($item->variant->height ?? 10));
            }

            // Ensure minimum values for Shiprocket
            $totalWeight = max($totalWeight, 0.5);
            $maxLength = max($maxLength, 10);
            $maxBreadth = max($maxBreadth, 10);
            $maxHeight = max($maxHeight, 10);

            // Clean address pieces to prevent empty field rejection
            $billingLast = explode(' ', $request->shipping_name);
            $lastName = count($billingLast) > 1 ? array_pop($billingLast) : 'O';
            $firstName = count($billingLast) > 0 ? implode(' ', $billingLast) : $request->shipping_name;

            $shiprocketOrderData = [
                "order_id" => $orderNumber,
                "order_date" => date('Y-m-d H:i'),
                "pickup_location" => config('services.shiprocket.pickup_location'), // Use dynamic location from config
                "billing_customer_name" => $firstName,
                "billing_last_name" => $lastName,
                "billing_address" => $request->shipping_door_no . " " . $request->shipping_street,
                "billing_address_2" => $request->shipping_area ?? "-",
                "billing_city" => $request->shipping_city,
                "billing_pincode" => $request->shipping_pincode,
                "billing_state" => $request->shipping_state,
                "billing_country" => "India",
                "billing_email" => $request->shipping_email,
                "billing_phone" => substr(preg_replace('/[^0-9]/', '', $request->shipping_phone), -10),
                "shipping_is_billing" => true,
                "order_items" => $orderItems,
                "payment_method" => $request->payment_method === 'Online Payment' ? 'Prepaid' : 'COD',
                "shipping_charges" => $shipping,
                "giftwrap_charges" => 0,
                "transaction_charges" => 0,
                "total_discount" => $discount,
                "sub_total" => $subtotal + $gstAmount,
                "length" => $maxLength,
                "breadth" => $maxBreadth,
                "height" => $maxHeight,
                "weight" => $totalWeight
            ];

            \Illuminate\Support\Facades\Log::info('Creating Shiprocket order', [
                'order_id' => $orderNumber,
                'data' => $shiprocketOrderData
            ]);

            $shipResponse = $shiprocket->createOrder($shiprocketOrderData);

            if (isset($shipResponse['order_id']) && isset($shipResponse['shipment_id'])) {
                $shipmentId = $shipResponse['shipment_id'];
                \Illuminate\Support\Facades\Log::info('Shiprocket order created successfully', [
                    'order_id' => $orderNumber,
                    'shiprocket_order_id' => $shipResponse['order_id'],
                    'shipment_id' => $shipmentId
                ]);

                $order->update([
                    'shiprocket_order_id' => $shipResponse['order_id'],
                    'shiprocket_shipment_id' => $shipmentId,
                    'shiprocket_status' => $shipResponse['status'] ?? 'NEW'
                ]);

                // 2. Assign the chosen courier and get AWB
                if ($request->selected_courier_id) {
                    $assignResponse = $shiprocket->assignAWB([
                        'shipment_id' => $shipmentId,
                        'courier_id' => $request->selected_courier_id
                    ]);

                    if (isset($assignResponse['status']) && $assignResponse['status'] == 200) {
                        $awbData = $assignResponse['response']['data'];
                        \Illuminate\Support\Facades\Log::info('Shiprocket AWB Assigned', [
                            'order_id' => $orderNumber,
                            'awb_code' => $awbData['awb_code']
                        ]);
                        $order->update([
                            'awb_code' => $awbData['awb_code'],
                            'courier_name' => $awbData['courier_name'],
                            'shiprocket_status' => 'AWB Assigned'
                        ]);
                    } else {
                        \Illuminate\Support\Facades\Log::warning('Shiprocket AWB Assignment Failed', [
                            'order_id' => $orderNumber,
                            'response' => $assignResponse
                        ]);
                    }
                }
            } else {
                \Illuminate\Support\Facades\Log::error('Shiprocket order creation failed', [
                    'order_id' => $orderNumber,
                    'response' => $shipResponse
                ]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Shiprocket API Error: ' . $e->getMessage());
        }

        try {
            \Illuminate\Support\Facades\Mail::to($order->billing_email)->send(new \App\Mail\OrderConfirmation($order));
            \Illuminate\Support\Facades\Mail::to('admin@darte.com')->send(new \App\Mail\AdminNewOrderNotification($order));
        } catch (\Exception $e) {
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Order successfully placed!',
            'order_number' => $orderNumber
        ]);
    }

    /**
     * View the Account Orders page with real data.
     */
    public function accountOrders()
    {
        $user = Auth::user();
        $orders = \App\Models\ProductOrder::with('items')->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.account-order', compact('orders', 'user'));
    }

    /**
     * View specific order details.
     */
    public function accountOrderDetails($id)
    {
        $user = Auth::user();
        $order = \App\Models\ProductOrder::with(['items' => function ($query) {
                // Option B: eager-load the product even if soft-deleted, as fallback
                $query->with(['product' => function ($q) {
                    $q->withTrashed();
                }]);
            }])
            ->where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        // Option B: For items missing product_image, fetch from product_slots using product_id
        foreach ($order->items as $item) {
            if (!$item->product_image) {
                $slot = \Illuminate\Support\Facades\DB::table('product_slots')
                    ->where('order_id', $order->order_number)
                    ->where('product_id', $item->product_id)
                    ->select('product_image')
                    ->first();
                if ($slot && $slot->product_image) {
                    $item->product_image = $slot->product_image;
                } elseif ($item->product) {
                    // Final fallback: grab directly from the (soft-deleted) product
                    $item->product_image = $item->product->product_image;
                }
            }
        }

        $trackingData = null;
        if ($order->awb_code) {
            try {
                $shiprocket = new \App\Services\ShiprocketService();
                $response = $shiprocket->trackAWB($order->awb_code);

                // Shiprocket often nest data inside the AWB key or 'tracking_data'
                if (isset($response['tracking_data'])) {
                    $trackingData = $response['tracking_data'];
                } elseif (isset($response[$order->awb_code])) {
                    $trackingData = $response[$order->awb_code];
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Shiprocket Tracking Error: ' . $e->getMessage());
            }
        }

        return view('pages.account-order-details', compact('order', 'user', 'trackingData'));
    }

    /**
     * Show the cancellation form for an order.
     */
    public function accountOrderCancel($id)
    {
        $user = Auth::user();
        $order = \App\Models\ProductOrder::with('items.product')
            ->where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        // Only allow cancellation if the order is in a cancellable state
        if (!in_array($order->status, ['Order Placed', 'Pending'])) {
            return redirect()->route('account.order.details', $id)
                ->with('error', 'This order cannot be cancelled.');
        }

        return view('pages.order-cancel', compact('order', 'user'));
    }

    /**
     * Handle the cancellation form submission.
     */
    public function accountOrderCancelSubmit(Request $request, $id)
    {
        $user = Auth::user();
        $order = \App\Models\ProductOrder::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        // Only allow cancellation if the order is in a cancellable state
        if (!in_array($order->status, ['Order Placed', 'Pending'])) {
            return redirect()->route('account.order.details', $id)
                ->with('error', 'This order cannot be cancelled.');
        }

        $request->validate([
            'cancellation_reason' => 'required|string',
        ]);

        $order->update([
            'status' => 'Canceled',
            'cancellation_reason' => $request->cancellation_reason,
        ]);

        // Optionally notify admin
        try {
            \Illuminate\Support\Facades\Log::info('Order cancelled by customer', [
                'order_id' => $order->id,
                'order_no' => $order->order_number,
                'reason' => $request->cancellation_reason,
                'user_id' => $user->id,
            ]);
        } catch (\Exception $e) {
        }

        return redirect()->route('account.order.details', $id)
            ->with('success', 'Your order #' . $order->order_number . ' has been cancelled successfully.');
    }

    /**
     * Show the return form for an order (item-by-item).
     */
    public function accountOrderReturn($id)
    {
        $user = Auth::user();
        $order = \App\Models\ProductOrder::with('items.product')
            ->where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        // Only allow returns if the order is Delivered
        // if ($order->status !== 'Delivered') {
        //     return redirect()->route('account.order.details', $id)
        //         ->with('error', 'Only delivered orders can be returned.');
        // }

        // Optional: Check if it's within 7 days of delivery
        // $deliveryDate = $order->updated_at; // Or whenever it was marked delivered
        // if ($deliveryDate && now()->diffInDays($deliveryDate) > 7) {
        //     return redirect()->route('account.order.details', $id)
        //         ->with('error', 'The 7-day return period has expired for this order.');
        // }

        // Get existing return requests for this order so we don't allow returning the same item twice
        $existingReturns = \App\Models\OrderReturnRequest::where('order_id', $order->id)
            ->whereIn('status', ['Pending', 'Approved'])
            ->selectRaw('order_item_id, SUM(quantity) as total_qty')
            ->groupBy('order_item_id')
            ->pluck('total_qty', 'order_item_id')
            ->toArray();

        return view('pages.order-return', compact('order', 'user', 'existingReturns'));
    }

    /**
     * Handle the return form submission.
     */
    public function accountOrderReturnSubmit(Request $request, $id)
    {
        $user = Auth::user();
        $order = \App\Models\ProductOrder::with('items')->where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        // if ($order->status !== 'Delivered') {
        //     return redirect()->route('account.order.details', $id)
        //         ->with('error', 'Only delivered orders can be returned.');
        // }

        $request->validate([
            'return_items' => 'required|array',
            'return_items.*.id' => 'required|exists:product_order_items,id',
            'return_items.*.quantity' => 'required|integer|min:1',
            'return_items.*.reason' => 'required|string|max:255',
        ]);

        $submittedItems = $request->input('return_items');
        $processedCount = 0;

        foreach ($submittedItems as $itemData) {
            // Verify the item belongs to this order
            $orderItem = $order->items->where('id', $itemData['id'])->first();

            if (!$orderItem)
                continue; // Skip invalid items

            $requestedQty = (int) $itemData['quantity'];
            if ($requestedQty > $orderItem->quantity) {
                // Cannot return more than ordered
                continue;
            }

            // Check how many have already been returned/requested
            $alreadyReturnedQty = \App\Models\OrderReturnRequest::where('order_item_id', $orderItem->id)
                ->whereIn('status', ['Pending', 'Approved'])
                ->sum('quantity');

            if (($alreadyReturnedQty + $requestedQty) > $orderItem->quantity) {
                // Would exceed original quantity
                continue;
            }

            // Create return request
            \App\Models\OrderReturnRequest::create([
                'order_id' => $order->id,
                'order_item_id' => $orderItem->id,
                'user_id' => $user->id,
                'quantity' => $requestedQty,
                'reason' => $itemData['reason'],
                'status' => 'Pending',
            ]);

            $processedCount++;
        }

        if ($processedCount > 0) {
            return redirect()->route('account.order.details', $id)
                ->with('success', 'Return request submitted successfully for ' . $processedCount . ' item(s).');
        } else {
            return redirect()->route('account.order.details', $id)
                ->with('error', 'Could not process the return request. Please check the quantities and try again.');
        }
    }
}
