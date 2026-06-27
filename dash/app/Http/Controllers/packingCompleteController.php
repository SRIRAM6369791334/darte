<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use Illuminate\Http\Request;

class packingCompleteController extends Controller
{
    public function index()
    {
        $productcompletes =  ProductOrder::query()->with("product", "orderAddress.area", "customer")->where("status", "delivered")->get();



        return view("pages.product_delivered", compact("productcompletes"));
    }
}
