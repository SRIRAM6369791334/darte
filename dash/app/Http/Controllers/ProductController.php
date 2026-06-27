<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatusUpdated;
use App\Models\AreaAssign;
use App\Models\Category;
use App\Models\DeliveryPerson;
use App\Models\MilkOrder;
use App\Models\MilkOrderUserAddress;
use App\Models\MilkSlot;
use App\Models\MilkTransactionLog;
use App\Models\Product;
use App\Models\ProductChildImage;
use App\Models\ProductOrder;
use App\Models\ProductOrderUserAddress;
use App\Models\ProductRefund;
use App\Models\ProductSlot;
use App\Models\ProductStock;
use App\Models\ProductTracking;
use App\Models\ProductTransactionLog;
use App\Models\ProductVarient;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Brand;
use App\Models\Unit;
use App\Services\ShiprocketService;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;


// require("sendsms.php");

class ProductController extends Controller
{

    public $productOrderSuccessMessage = "Product Added Successfully";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products =  Product::with(['category', 'brand'])->get();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $units = Unit::all();
        return view("pages.products", compact("products", "categories", "subcategories", "brands", "units"));
    }


    public function destroyVarientThumpImages(string $id)
    {
        ProductChildImage::find($id)->delete();

        return successResponse("Deleted Successfully");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */

    // DO NOT TRY TO OPTIMIZE OR CHANGE ANYTHING IN THIS BELOW STORE FUNCTION
    // IF YOU DO THAT THE CODE WILL FAIL FOR SURE
    // TIME WASTED 3 DAYS
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => "required",
            'product_name' => "required",
            'product_specification' => "nullable",
            'product_image' => "required|mimes:png,jpg,webp,jpeg",
            'product_description' => "nullable",
            'brand_id' => "nullable",
            'subcategory_id' => "nullable",
            'slug' => "nullable|unique:products,slug",
            'meta_title' => "nullable",
            'meta_description' => "nullable",
            'meta_key' => "nullable",
        ]);

        $validated['product_description'] = $validated['product_description'] ?? '';
        $validated['product_specification'] = $validated['product_specification'] ?? '';

        if (empty($request->slug)) {
            $validated['slug'] = Str::slug($request->product_name) . '-' . time();
        }

        $subcate = $request->subcategory_id;
        $subcatedisplay = SubCategory::where('id', $subcate)->first();
        $displayname = $subcatedisplay ? $subcatedisplay->subcategory_name : '';

        $cate = $request->category_id;
        $catedisplay = Category::where('id', $cate)->first();
        $catedisplayname = $catedisplay->category_name;

        $sizecheck = $request->size_check;

        if ($request->hasFile("product_image")) {
            $productImage = $request->file("product_image");
            $path =  $productImage->store("product_images", "public");
            $product = Product::create([
                ...$validated, 
                "product_image" => $path, 
                "cate_name" => $catedisplayname, 
                "subcate_name" => $displayname,
                "meta_title" => $request->meta_title ?: $request->product_name . ' - Darte',
                "meta_description" => $request->meta_description ?: Str::limit(strip_tags($request->product_description), 160),
                "meta_key" => $request->meta_key
            ]);
            $imageArray = $request->product_image1;
            $afterRemoval = [];
            $thumpArray = $request->product_image_count;
            // dd($thumpArray);
            // $product = Product::create([...$validated,"cate_name"=>$catedisplayname,"subcate_name"=>$displayname]);

            foreach ($request->Varient_image as $key => $productCode) {

                if (count($afterRemoval) != 0) {
                    $tempImageArray = $afterRemoval;
                }

                if ($productCode->isFile()) {
                    // $varientImage = $request->file("Varient_image");
                    $varientImage = $productCode;
                    // dd($varientImage);
                    $vpath =  $varientImage->store("varient_images", "public");
                }

                $sku = $request->sku[$key] ?? (strtoupper(substr($product->product_name, 0, 3)) . '-' . rand(1000, 9999));

                $createdProduct =  ProductVarient::create([
                    'categoryid' => $product->category_id,
                    'subcategoryid' => $product->subcategory_id,
                    'subcatename' => $displayname,
                    'product_id' => $product->id,
                    'sku' => $sku,
                    'barcode' => $request->barcode[$key] ?? null,
                    'unit_id' => $request->unit_id[$key] ?? null,
                    'varient' => $request->product_value[$key],
                    'varient_img' => $vpath,
                    'pre_note' => $request->pre_note[$key] ?? null,
                    'varient_name' => $request->varient_name[$key],
                    'value' => $request->product_value[$key],
                    'offer_price' => $request->product_offer_price[$key],
                    'mrp_price' => $request->product_mrp_price[$key],
                    'product_qty' => $request->product_quantity[$key],
                    'low_stock' => $request->low_stock[$key],
                    'hot_deals' => $request->hot_deals[$key] ?? 0,
                    'Popular_products' => $request->popular_prod[$key] ?? 0,
                    'pre_order' => $request->preorder[$key] ?? 0,
                    'flash_sale' => $request->flash_sale[$key] ?? 0,
                    'flash_sale_date' => $request->flash_sale_date[$key] ?? null,
                    'product_gst' => $request->product_gst[$key] ?? 0,
                    'size_value' => $sizecheck,
                    'weight' => $request->weight[$key] ?? null,
                ]);


                DB::table('productstocks')->insert([
                    "productid" => $product->id,
                    "category_id" =>  $validated["category_id"],
                    "subcategory_id" => $validated["subcategory_id"] ?? null,
                    "pro_ver_id" => $createdProduct->id,
                    "productname" => $validated["product_name"],
                    "overallstock" =>  $request->product_quantity[$key],
                    "availablestock" => $request->product_quantity[$key],
                    "salestock" => 0,
                    "low_stocks" => $request->low_stock[$key],
                    "last_stockupdate_date" => date("Y-m-d"),
                ]);



                if (!empty($request->product_image1) && is_array($request->product_image1)) {
                    foreach ($request->product_image1 as $thumpkey => $img) {
                        if ($img->isFile()) {
                            if (count($afterRemoval) == 0) {
                                if ($thumpArray[$key] > $thumpkey) {
                                    $productImage = $img;
                                    $path =  $productImage->store("product_images1", "public");
                                    ProductChildImage::create([
                                        "product_id" => $product->id,
                                        "product_child_image" => $path,
                                        "variant_id" => $createdProduct->id
                                    ]);
                                }
                            } else {
                                if ($thumpArray[$key] > $thumpkey) {
                                    $productImage = $afterRemoval[$thumpkey];
                                    $path =  $productImage->store("product_images1", "public");
                                    ProductChildImage::create([
                                        "product_id" => $product->id,
                                        "product_child_image" => $path,
                                        "variant_id" => $createdProduct->id
                                    ]);
                                }
                            }
                        }
                    }
                }


                if (isset($thumpArray[$key])) {
                    $sourceArray = count($afterRemoval) != 0 ? ($tempImageArray ?? []) : ($imageArray ?? []);
                    $afterRemoval = array_slice($sourceArray, $thumpArray[$key]);
                } else {
                    $afterRemoval = [];
                }
            }

            // dd($request->product_image1);

            // foreach ($request->product_image1 as $imgkey => $img) {

            //         if ($img->isFile()) {
            //             $productImage = $img;
            //             $path =  $productImage->store("product_images1", "public");
            //             $product1 = ProductChildImage::create(["product_id" => $product->id, "product_child_image" => $path,"variant_id" => $createdProduct->id]);
            //         }
            // }




            // foreach ($request->product_image1 as $key => $img) {

            //     if ($img->isFile()) {
            //         $productImage = $img;
            //         $path =  $productImage->store("product_images1", "public");
            //         $product1 = ProductChildImage::create(["product_id" => $product->id, "product_child_image" => $path,"variant_id" => $createdProduct->id]);
            //     }
            // }
            $products =  Product::with('category')->get();


            return response()->json([
                "message" => $this->productOrderSuccessMessage,
                "products" => $products
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        $validated =   $request->validate([
            'category_id' => "required",
            'product_name' => "required",
            'product_description' => "nullable",
            "category_image" => $request->hasFile("category_image") ? "required|mimes:png,jpg,webp,jpeg" : "",
            'product_specification' => "nullable",
            'brand_id' => "nullable",
            'subcategory_id' => "nullable",
            'slug' => "nullable|unique:products,slug," . $id,
            'meta_title' => "nullable",
            'meta_description' => "nullable",
            'meta_key' => "nullable",
        ]);

        $validated['product_description'] = $validated['product_description'] ?? '';
        $validated['product_specification'] = $validated['product_specification'] ?? '';

        if (empty($request->slug)) {
            $validated['slug'] = Str::slug($request->product_name) . '-' . time();
        }
        if ($request->hasFile("product_image")) {


            $productImage = $request->file("product_image");
            $path =  $productImage->store("product_images", "public");
            File::delete(public_path("images/" . $product->product_image));
            $product->update([
                ...$validated,
                "product_image" =>  $path,
                "meta_title" => $request->meta_title ?: $request->product_name . ' - Darte',
                "meta_description" => $request->meta_description ?: Str::limit(strip_tags($request->product_description), 160),
                "meta_key" => $request->meta_key
            ]);
            $products =  Product::with(['category', 'brand'])->get();
            return response()->json([
                "message" => $this->productOrderSuccessMessage,
                "products" => $products
            ]);
        } else {

            $product->update([
                'category_id' => $validated["category_id"],
                'product_name' => $validated["product_name"],
                'product_description' => $validated["product_description"] ?? '',
                'product_specification' => $validated["product_specification"] ?? '',
                'brand_id' => $validated["brand_id"] ?? null,
                'subcategory_id' => $validated["subcategory_id"] ?? null,
                'slug' => $validated["slug"],
                'meta_title' => $request->meta_title ?: $request->product_name . ' - Darte',
                'meta_description' => $request->meta_description ?: Str::limit(strip_tags($request->product_description), 160),
                'meta_key' => $request->meta_key,
            ]);

            $products =  Product::with(['category', 'brand'])->get();
            return response()->json([
                "message" => $this->productOrderSuccessMessage,
                "products" => $products
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (File::exists(public_path("images/") . $product->product_image)) {
            File::delete(public_path("images/" . $product->product_image));
            $product->delete();


            ProductVarient::where("product_id", $id)?->delete();

            DB::table('productstocks')->where("productid", $id)->delete();

            $products =  Product::all();
            return response()->json([
                "message" => "Product Deleted Successfully",
                "products" => $products
            ]);
        }

        return redirect("products")->with("error", "Product Deleted Failed");
    }


    public function productImageUpload(Request $request)
    {
        return response($request->hasFile("addProductImage"));
    }

    public function getProductDetail(Request $request)
    {
        $productId = $request->product_id;
        if (!$productId) {
            abort(404);
        }

        $product =   Product::findOrFail($productId);
        return response($product);
    }


    public function createMilkSubscription(Request $request)
    {
        $planType = $request->plan_type;
        $userId = $request->user_id;
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $user = User::query()->where("user_id", $userId)->first();
        $lastId = MilkOrder::max('id');
        $orderId = sprintf('HG-ORD-%06d', $lastId + 1);

        if ($planType == "1") {
            $startDate = Carbon::parse($request->from_date);
            $endDate = Carbon::parse($request->to_date);
            $dates = [];
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $dates[] = $date->toDateString();
            }
            $noOfdays = count($dates);
            $dates = json_encode($dates);
            MilkOrder::query()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'order_id' => $orderId,
                'from_date' => $request->from_date,
                'to_date' => $endDate,
                'date_to_delivery' => $dates,
                'date_ordered_on' => now(),
                'no_of_days' => $noOfdays,
                "payment_status" => 1,
                'plan_type' => $planType,
                'user_id' => $userId,
            ]);

            $this->createMilkSlot($orderId);

            $totalAmount = Product::findOrFail($productId)->product_mrp_price * $quantity * $noOfdays;

            MilkTransactionLog::create([
                'order_id' => $orderId,
                'order_date' => now(),
                'order_amount' => $totalAmount,
                'amount_credited' => $totalAmount,
                'user_id' => $userId
            ]);

            $this->assignDeliverPersonMilkOrder($orderId, $user);
            $this->addMilkOrderDeliveryAddress($orderId, $user);

            return successResponse("Order Created Successfully");
        }
        if ($planType == "2") {
            $startDate = Carbon::parse($request->from_date);
            $endDate = Carbon::parse($request->from_date);
            $dates = [];
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $dates[] = $date->toDateString();
            }
            $noOfdays = count($dates);
            $dates = json_encode($dates);
            MilkOrder::query()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'order_id' => $orderId,
                'from_date' => $startDate,
                'to_date' => $endDate,
                'date_to_delivery' => $dates,
                'date_ordered_on' => now(),
                'no_of_days' => $noOfdays,
                "payment_status" => 1,
                'plan_type' => $planType,
                'user_id' => $userId,

            ]);
            $this->createMilkSlot($orderId);
            $totalAmount = Product::findOrFail($productId)->product_mrp_price * $quantity * $noOfdays;
            MilkTransactionLog::create([
                'order_id' => $orderId,
                'order_date' => now(),
                'order_amount' => $totalAmount,
                'amount_credited' => $totalAmount,
                'user_id' => $userId
            ]);


            $this->assignDeliverPersonMilkOrder($orderId, $user);
            $this->addMilkOrderDeliveryAddress($orderId, $user);

            return successResponse("Order Created Successfully");
        }
        if ($planType == "3") {
            $startDate = Carbon::parse($request->from_date);
            $endDate = Carbon::parse($request->to_date);
            $dates = $request->selected_dates;
            $noOfdays = count($dates);
            $dates = json_encode($dates);
            MilkOrder::query()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'order_id' => $orderId,
                'from_date' => $startDate,
                'to_date' => $endDate,
                'date_to_delivery' => $dates,
                'date_ordered_on' => now(),
                'no_of_days' => $noOfdays,
                "payment_status" => 1,
                'plan_type' => $planType,
                'user_id' => $userId,
            ]);
            $this->createMilkSlot($orderId);

            $totalAmount = Product::findOrFail($productId)->product_mrp_price * $quantity * $noOfdays;

            MilkTransactionLog::create([
                'order_id' => $orderId,
                'order_date' => now(),
                'order_amount' => $totalAmount,
                'amount_credited' => $totalAmount,
                'user_id' => $userId
            ]);

            $this->assignDeliverPersonMilkOrder($orderId, $user);
            $this->addMilkOrderDeliveryAddress($orderId, $user);

            return successResponse("Order Created Successfully");
        }
    }

    // addMilkOrderDeliveryAddress($orderId, $user)
    public function addMilkOrderDeliveryAddress($orderId, $user)
    {
        $defaultUserAddress =  $user->defaultAddress->toArray();
        MilkOrderUserAddress::create([
            ...$defaultUserAddress,
            "order_id" => $orderId,
        ]);
    }


    public function addProductOrderDeliveryAddress($orderId, $user)
    {
        $defaultUserAddress =  $user->defaultAddress->toArray();
        ProductOrderUserAddress::create([
            ...$defaultUserAddress,
            "order_id" => $orderId,
        ]);
    }

    // Milk Product Assign Deiver Person
    public function assignDeliverPersonMilkOrder($orderId, $user)
    {
        $userDefaultAddressId  = $user->user_default_address_id;
        $userDefaultAddress =  UserAddress::query()->findOrFail($userDefaultAddressId);

        $areaId = $userDefaultAddress["area_id"];
        $deliveryPerson = DeliveryPerson::with(['areaAssigns', 'milkOrders'])
            ->whereHas('areaAssigns', function ($query) use ($areaId) {
                $query->where('area_id', $areaId);
            })
            ->withCount('milkOrders')
            ->orderBy('milk_orders_count', 'asc')
            ->first();
        if ($deliveryPerson) {
            $milkOrder =   MilkOrder::query()->where("order_id", $orderId)->first();
            $milkSlot =  MilkSlot::query()->where("order_id", $orderId);
            $milkOrder->update([
                "delivery_person_id" => $deliveryPerson->delivery_person_id,
                "is_delivery_assigned" => 1
            ]);
            $milkSlot->update([
                "deliver_person_id" => $deliveryPerson->delivery_person_id
            ]);
        }
    }

    // createProductSubscription

    public function createProductSubscription(Request $request)
    {
        $userId = $request->user_id;
        $selettype = $request->selecttype;


        $user = User::query()->where("user_id", $userId)->first();
        $lastId = ProductOrder::max('id');
        $orderId = sprintf('HG-ORD-PR-%06d', $lastId + 1);

        ProductOrder::query()->create([
            'order_id' => $orderId,
            'date_ordered_on' => now(),
            'user_id' => $userId,
            "payment_status" => 1,
        ]);

        $this->createProductSlot($orderId, $selettype, $request);

        $this->assignDeliverProductOrder($orderId, $user);
        $this->addProductOrderDeliveryAddress($orderId, $user);
        return successResponse("Order Created Successfully");
    }


    // Product  Order Assign Deiver Person
    public function assignDeliverProductOrder($orderId, $user)
    {
        $userDefaultAddressId  = $user->user_default_address_id;
        $userDefaultAddress =  UserAddress::query()->findOrFail($userDefaultAddressId);

        $areaId = $userDefaultAddress["area_id"];
        $deliveryPerson = DeliveryPerson::with(['areaAssigns', 'productOrders'])
            ->whereHas('areaAssigns', function ($query) use ($areaId) {
                $query->where('area_id', $areaId);
            })
            ->withCount('productOrders')
            ->orderBy('product_orders_count', 'asc')
            ->first();
        if ($deliveryPerson) {
            $productOrder =   ProductOrder::query()->where("order_id", $orderId)->first();
            $productSlot =  ProductSlot::query()->where("order_id", $orderId);
            $productOrder->update([
                "delivery_person_id" => $deliveryPerson->delivery_person_id,
                "is_delivery_assigned" => 1
            ]);
            $productSlot->update([
                "deliver_person_id" => $deliveryPerson->delivery_person_id
            ]);
        }
    }


    public function createMilkSlot($orderId)
    {
        $order = MilkOrder::query()->where("order_id", $orderId)->first();
        $orderedDates = json_decode($order->date_to_delivery);
        $order->update(["payment_status" => 1]);
        $slots = [];
        if (!$orderedDates && !count($orderedDates)) {
            return errorResponse("Order Not Fount", 404);
        }
        $slots = array_map(function ($orderedDate) use ($orderId) {
            return [
                'delivery_date' => $orderedDate,
                'order_id' => $orderId,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }, $orderedDates);

        MilkSlot::insert($slots);
    }



    public function createProductSlot($orderId, $selettype, $request)
    {

        $order = ProductOrder::query()->where("order_id", $orderId)->first();

        if ($selettype == "2") {

            $order->update(["payment_status" => 1, "delivery_status" => 4]);
        } else {
            $order->update(["payment_status" => 1]);
        }


        $productId = $request->product_id; // Assuming product_id is a single value
        $productvarid = $request->productvar_id;
        $quantity = $request->product_quantity;
        $delvieryDate  = Carbon::parse($request->from_date);
        $userId = $request->user_id;

        $slots = [];
        $totalAmount = 0;

        if ($selettype == "2") {
            foreach ($productvarid as $key => $value) {
                $totalAmount += (ProductVarient::findOrFail($value)->offer_price * $quantity[$key]);

                $slots[] = [
                    'delivery_date' => $delvieryDate,
                    'order_id' => $orderId,
                    "product_id" => $productId[$key],
                    "product_varient_id" => $value,
                    "quantity" => $quantity[$key],
                    "delivery_status" => 4,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            // dd( $totalAmount);
            $prooder = ProductOrder::where('order_id', $orderId)->update([
                "total_amount" => $totalAmount
            ]);




            ProductSlot::insert($slots);

            foreach ($slots as $slot) {
                $productVarientId = $slot['product_varient_id'];
                $quantity = $slot['quantity'];

                // Get the current stock information for the product
                $productStock = ProductStock::where('pro_ver_id', $productVarientId)->first();
                $productVarient = ProductVarient::where('id', $productVarientId)->first();

                // Update available_stock and sale_stock based on the quantity
                $availableStock = $productStock->availablestock - $quantity;
                $saleStock = $productStock->salestock + $quantity;

                // Update the ProductStock table
                ProductStock::where('pro_ver_id', $productVarientId)->update([
                    'availablestock' => $availableStock,
                    'salestock' => $saleStock,
                ]);
                $productVarientAvailQty = $productVarient->product_qty - $quantity;
                ProductVarient::where('id', $productVarientId)->update([
                    'product_qty' => $productVarientAvailQty,
                ]);
            }
        } else {
            foreach ($productvarid as $key => $value) {
                $totalAmount += (ProductVarient::findOrFail($value)->offer_price * $quantity[$key]);


                $slots[] = [
                    'delivery_date' => $delvieryDate,
                    'order_id' => $orderId,
                    "product_id" => $productId[$key],
                    "product_varient_id" => $value,
                    "quantity" => $quantity[$key],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            $prooder = ProductOrder::where('order_id', $orderId)->update([
                "total_amount" => $totalAmount
            ]);


            ProductSlot::insert($slots);


            foreach ($slots as $slot) {
                $productVarientId = $slot['product_varient_id'];
                $quantity = $slot['quantity'];

                // Get the current stock information for the product
                $productStock = ProductStock::where('pro_ver_id', $productVarientId)->first();
                $productVarient = ProductVarient::where('id', $productVarientId)->first();

                // Update available_stock and sale_stock based on the quantity
                $availableStock = $productStock->availablestock - $quantity;
                $saleStock = $productStock->salestock + $quantity;

                // Update the ProductStock table
                ProductStock::where('pro_ver_id', $productVarientId)->update([
                    'availablestock' => $availableStock,
                    'salestock' => $saleStock,
                ]);
                $productVarientAvailQty = $productVarient->product_qty - $quantity;
                ProductVarient::where('id', $productVarientId)->update([
                    'product_qty' => $productVarientAvailQty,
                ]);
            }
        }





        ProductTransactionLog::create([
            'order_id' => $orderId,
            'order_date' => now(),
            'order_amount' => $totalAmount,
            'amount_credited' => $totalAmount,
            'user_id' => $userId
        ]);
    }



    public function viewProductInvoice($orderId = null)
    {
        $order = ProductOrder::where('order_id', $orderId)
            ->orWhere('order_number', $orderId)
            ->first();

        // Try to get products from legacy ProductSlot first
        $products = ProductSlot::query()
            ->where("order_id", $orderId)
            ->where("is_cancelled", "!=", 1)
            ->with("productVarient", "productOrder.customer.user_addresses", "productOrder.orderAddress", "product.productvari")
            ->get();

        // If no slot items found, try to get from modern ProductOrderItem (storefront)
        if ($products->isEmpty() && $order) {
            $products = \App\Models\ProductOrderItem::query()
                ->where('order_id', $order->id)
                ->with('product', 'variant')
                ->get();

            // Map ProductOrderItem fields to match the view's expectations from ProductSlot
            // This avoids large-scale changes to the blade file
            $products = $products->map(function($item) {
                $item->product_rate = $item->price;
                $item->product_total = $item->total;
                $item->gst_amt = $item->gst_amount;
                $item->gst_per = $item->gst_rate;
                $item->productVarient = $item->variant;
                return $item;
            });
        }

        // Get shipping/billing addresses
        $addresses = \App\Models\ProductOrderUserAddress::where("order_id", $orderId)->get();

        // Fallback for address if ProductOrderUserAddress is missing (e.g. storefront orders)
        if ($addresses->isEmpty() && $order) {
            // Mock a address object for the view
            $billingAddress = (object)[
                'address_type_name' => 'billing',
                'firstname' => $order->billing_name,
                'address_line_one' => $order->billing_street,
                'address_line_two' => $order->billing_door_no,
                'city' => $order->billing_city,
                'state' => $order->billing_state ?? '',
                'pincode' => $order->billing_pincode,
                'address_phone_number' => $order->billing_phone,
                'phonecode' => '',
            ];
            $shippingAddress = (object)[
                'address_type_name' => 'shipping',
                'firstname' => $order->shipping_name,
                'address_line_one' => $order->shipping_street,
                'address_line_two' => $order->shipping_door_no,
                'city' => $order->shipping_city,
                'state' => $order->shipping_state ?? '',
                'pincode' => $order->shipping_pincode,
                'address_phone_number' => $order->shipping_phone,
                'phonecode' => '',
            ];
            $addresses = collect([$billingAddress, $shippingAddress]);
        }

        return view("invoicePages.product_orders_invoice", compact("products", "addresses", "order"));
    }



    // update status
    public function upadetstatus(Request $request)
    {

        $order_id = $request->order_id;
        $status = $request->select_status;
        $custometid = $request->user_id;
        $numbercus = $request->phone_number;

        //LOGGING INTO SHIPROCKET

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => '{"email": "thiruvenkatesh.sts@gmail.com","password": "Thiru@123"}',
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json'
        //     ),
        // ));
        // $SR_login_Response = curl_exec($curl);
        // curl_close($curl);
        // $SR_login_Response_out = json_decode($SR_login_Response);
        // $token = $SR_login_Response_out->{'token'};

        $sid = DB::table('product_tracking')
            ->where('order_id', $order_id)
            ->first();


        // GENERATING AWB CODE FOR ORDER TRACKING

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/assign/awb',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => '{
        //         "shipment_id": "' . $sid->shiprocket_shipment_id . '",
        //         "courier_id": ""
        //     }',
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json',
        //         'Authorization: Bearer' . $token,
        //     ),
        // ));

        // $altresponse = curl_exec($curl);
        // $SR_login_Response_out6 = json_decode($altresponse);

        // if (isset($SR_login_Response_out6->response->data->awb_code)) {
        //     $awb_code = $SR_login_Response_out6->response->data->awb_code;
        // } else {
        //     $awb_code = 0;
        // }

        // curl_close($curl);

        // GENERATING TRACKING URL USING AWB CODE
        // $shipmentId = $sid->shiprocket_shipment_id;

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     // CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/track?order_id=$'.$shipmentId,
        //     CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/shipment/$shipmentId",
        //     // CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/awb/$shipmentId",
        //     // CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/track/shipment/221028486',
        //     // CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/cancel/shipment/awbs',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HEADER => 'Content-Type: application/json',
        //     CURLOPT_HTTPHEADER => array(
        //         'Authorization: Bearer' . $token,
        //     ),
        // ));

        // $response = curl_exec($curl);
        // curl_close($curl);
        // $SR_login_Response_out1 = json_decode($response, true);

        $status_map = [
            '0' => 'Order Placed',
            '1' => 'processing',
            '2' => 'shipped',
            '3' => 'out_for_delivery',
            '4' => 'delivered',
            '5' => 'ready_for_pickup',
            '6' => 'return',
        ];
        $status_str = $status_map[$status] ?? $status;

        // If status is 'Ready for Pickup', trigger Shiprocket
        if ($status == '5') {
            try {
                if ($sid && $sid->shiprocket_shipment_id) {
                    $shiprocket = new ShiprocketService();

                    // 1. Assign AWB if missing
                    if (empty($sid->awb_code)) {
                        $awbResponse = $shiprocket->assignAWB([
                            'shipment_id' => $sid->shiprocket_shipment_id,
                            'courier_id' => '' // Default
                        ]);

                        if (isset($awbResponse['response']['data']['awb_code'])) {
                            $awb_code = $awbResponse['response']['data']['awb_code'];
                            DB::table('product_tracking')->where('order_id', $order_id)->update(['awb_code' => $awb_code]);
                        }
                    }

                    // 2. Generate Pickup
                    $pickupResponse = $shiprocket->generatePickup([
                        'shipment_id' => [$sid->shiprocket_shipment_id]
                    ]);

                    if (!isset($pickupResponse['status']) || ($pickupResponse['status'] != 200 && $pickupResponse['status'] != 1)) {
                         \Log::warning('Shiprocket Pickup Request Failed', ['response' => $pickupResponse]);
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Shiprocket Error during status update: ' . $e->getMessage());
            }
        }


        DB::table('product_orders')
            ->where(function($query) use ($order_id) {
                $query->where('order_id', $order_id)->orWhere('order_number', $order_id);
            })
            ->update([
                "status" => $status_str
            ]);

        DB::table('product_slots')
            ->where('order_id', $order_id)
            ->update([
                "delivery_status" => $status
            ]);

        // $trackurl = $SR_login_Response_out1['tracking_data']['track_url'];
        // DB::table('product_tracking')->where('order_id', $order_id)->update(['awb_code' => $awb_code, 'tracking_url' => $trackurl]);

        // $productOrders = new ProductTracking();
        // $productOrders->order_id = $order_id;
        // $productOrders->delivery_status = $status;
        // $productOrders->user_id = $custometid;

        // $productOrders->save();


        $productOrders =  ProductOrder::query()
            ->with("product", "customer")
            ->whereIn('status', ['Order Placed', 'pending'])
            ->get();

        // Send to the user who made the current order
        $order = ProductOrder::with("customer")
            ->where("order_id", $order_id)
            ->orWhere("order_number", $order_id)
            ->first();

        if ($order && $order->customer && !empty($order->customer->email)) {
            try {
                Mail::to($order->customer->email)->send(new OrderStatusUpdated($order, $status));
            } catch (\Exception $e) {
                \Log::error("Email failed for order $order_id: " . $e->getMessage());
            }
        }

        return response()->json([
            "message" => "Status update successfully",
            "productOrders" => $productOrders
        ]);
    }

    public function pickupstatus(Request $request)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"email": "thiruvenkatesh.sts@gmail.com","password": "Thiru@123"}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $SR_login_Response = curl_exec($curl);
        curl_close($curl);
        $SR_login_Response_out = json_decode($SR_login_Response);
        $token = $SR_login_Response_out->{'token'};
        $order_id = $request->order_id;

        $ship = DB::table("product_tracking")->where('order_id', $order_id)->first();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/generate/pickup',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "shipment_id": [' . $ship->shiprocket_shipment_id . ']

            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer' . $token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $productOrders =  ProductOrder::query()->with("product", "orderAddress.area", "customer")->where("payment_status", 'paid')->get();


        return response()->json([
            "message" => "Status failed successfully",
            "productOrders" => $productOrders
        ]);
    }

    public function getproductfilter(Request $request)
    {
        $selectvalue = $request->category_id;


        $products =  Product::with('category')->where('category_id', $selectvalue)->get();

        $data = [
            'products' => $products,
            'i' => 1,
        ];

        return $data;
    }

    // product refund

    public function updaterefund(Request $request)
    {

        $order_id = $request->order_id;

        $custometid = $request->user_id;

        DB::table('product_orders')
            ->where('order_id', $order_id)
            ->update([
                "status" => "cancelled"
            ]);

        DB::table('product_slots')
            ->where('order_id', $order_id)
            ->update([
                "is_cancelled" => 1
            ]);

        $productSlot = DB::table('product_slots')
            ->where('order_id', $order_id)
            ->first();



        $productSlotId = $productSlot ? $productSlot->id : null;

        ProductRefund::create([
            'order_id' => $order_id,
            'slot_id' => $productSlotId,
            'cancelled_by' => "Admin",
            'refund_status' => 0
        ]);

        $order =  DB::table('product_slots')
            ->where('order_id', $order_id)
            ->get();



        foreach ($order as $ord) {

            $getstock =  DB::table('productstocks')->where("productid", $ord->product_id)->where('pro_ver_id', $ord->product_varient_id)->first();

            DB::table('productstocks')->where("productid", $ord->product_id)->where('pro_ver_id', $ord->product_varient_id)->update([
                "overallstock" => $getstock->overallstock + $ord->quantity,
                "availablestock" => $getstock->availablestock + $ord->quantity,
                "salestock" => $getstock->salestock - $ord->quantity,
            ]);

            // Sync with ProductVarient table
            $productVarient = DB::table('product_varient')->where('id', $ord->product_varient_id)->first();
            if ($productVarient) {
                DB::table('product_varient')->where('id', $ord->product_varient_id)->update([
                    'product_qty' => $productVarient->product_qty + $ord->quantity,
                ]);
            }
        }


        $productOrders =  ProductOrder::query()->with("product", "orderAddress.area", "customer")->where("payment_status", "paid")->where("status", "pending")->get();

        return response()->json([
            "message" => "Status update successfully",
            "productOrders" => $productOrders
        ]);
    }

    // public function Getsubproo($id)
    // {
    //     $ff = SubCategory::where('category_name', $id)->get();
    //     return response()->json($ff);
    // }
    public function getProductsByCategory($id)
{
    $products = Product::where('category_id', $id)->get();
    return response()->json($products);
}


    public function getthump($product_id)
    {
        $thump = ProductChildImage::where('variant_id', $product_id)->get();

        // @dd($thump);
        return response()->json($thump);
    }

    public function downloadTemplate()
    {
        $headers = [
            'product_name', 'product_ingredients', 'product_description', 'brand',
            'product_image', 'variant_name', 'variant_value', 'unit',
            'sku', 'barcode', 'mrp_price', 'offer_price', 'stock_quantity',
            'low_stock', 'gst', 'variant_image'
        ];

        $callback = function() use ($headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);

            // Add a sample row
            fputcsv($file, [
                'Sample Product', 'Ingredients listing here', 'Description here', 'BrandX',
                'product1.jpg', 'Pack of 1', '500', 'Gram',
                'SKU001', '123456789', '100', '80', '50',
                '5', '5', 'variant1.jpg'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=product_upload_template.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ]);
    }

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'nullable',
            'brand_id' => 'nullable',
            'excel_file' => 'required|mimes:xlsx,xls,csv,txt',
            'zip_file' => 'nullable|mimes:zip',
        ]);

        $tempPath = null;
        if ($request->hasFile('zip_file')) {
            $zip = new \ZipArchive;
            $res = $zip->open($request->file('zip_file')->path());
            if ($res === TRUE) {
                $tempPath = storage_path('app/temp_bulk_upload_' . time());
                if (!File::exists($tempPath)) {
                    File::makeDirectory($tempPath, 0755, true);
                }
                $zip->extractTo($tempPath);
                $zip->close();
            }
        }

        try {
            Excel::import(new ProductImport($request->category_id, $request->subcategory_id, $tempPath, $request->brand_id), $request->file('excel_file'));

            // Clean up temp images
            if ($tempPath) {
                File::deleteDirectory($tempPath);
            }

            $products =  Product::with(['category', 'brand'])->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Products uploaded successfully',
                'products' => $products
            ]);

        } catch (\Exception $e) {
            if ($tempPath) {
                File::deleteDirectory($tempPath);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
