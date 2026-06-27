<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use App\Models\ProductSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductOrdersController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index(Request $request) {
        $status = $request->get('status', 'new');
        
        $query = ProductOrder::query()
            ->with(['product', 'orderAddress.area', 'customer', 'returnRequests']);

        switch ($status) {
            case 'packing':
                $query->where("status", "processing");
                break;
            case 'dispatched':
                $query->where("status", "shipped");
                break;
            case 'delivery':
                $query->where("status", "out_for_delivery");
                break;
            case 'delivered':
                $query->where("status", "delivered");
                break;
            case 'return':
                $query->where(function($q) {
                    $q->where("status", "return")
                      ->orWhereHas('returnRequests');
                });
                break;

            case 'new':

            default:
                // New orders can be 'Order Placed' or 'pending'
                $query->whereIn('status', ['Order Placed', 'pending']);
                break;
        }

        $productOrders = $query->orderBy('created_at', 'desc')->get();

        return view('pages.product_orders', compact('productOrders', 'status'));
    }


    public function orderStat() {
        return redirect()->route('shiprocket.sync');
    }


        /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */

        public function create() {
            //
        }

        /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */

        public function store( Request $request ) {
            //
        }

        /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */

        public function show( $id ) {
            //
        }

        /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */

        public function edit( $id ) {
            //
        }

        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */

        public function update( Request $request, $id ) {
            //
        }

        /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */

        public function destroy( $id ) {
            //
        }

        public function productOrderDeliveryAssign( Request $request ) {
            $orderId = $request->order_id;
            $deliveryPersonId =  $request->deliver_id;
            $productOrder =   ProductOrder::query()->where( 'order_id', $orderId )->first();
            $productSlot =  ProductSlot::query()->where( 'order_id', $orderId );

            if ( !$productOrder ) {
                return errorResponse( 'Order Id Not found' );
            }

            $productOrder->update( [
                'delivery_person_id' => $deliveryPersonId,
                'is_delivery_assigned' => 1
            ] );

            $productSlot->update( [
                'deliver_person_id' => $deliveryPersonId
            ] );

            $productOrders =  ProductOrder::query()->with( 'product', 'orderAddress.area', 'customer' )->where( 'payment_status', 'paid' )->where( 'status', 'pending' )->get();

            return response()->json( [
                'message' => 'Deivery Person assigned Successfully',
                'productOrders' => $productOrders
            ] );
        }
    }
