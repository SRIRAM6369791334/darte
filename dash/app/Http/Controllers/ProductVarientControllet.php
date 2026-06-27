<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductChildImage;
use App\Models\ProductVarient;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductVarientControllet extends Controller
{
    public $productvarientSuccessMessage = "Product varient Added Successfully";
    public function index()
    {
        $productvarient = ProductVarient::select(
            'product_varient.*', 
            'products.product_name', 
            'products.category_id as categoryid', 
            'products.subcategory_id as subcategoryid',
            'categories.category_name',
            'units.short_name as unit_short_name'
            )
            ->join('products', 'product_varient.product_id', "=", 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('units', 'product_varient.unit_id', '=', 'units.id')
            ->get();



        $products = Product::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $units = Unit::all();

        return view("pages.product_varient", compact('productvarient', 'products', 'categories', 'subcategories', 'units'));
    }

//     public function addproductvarient(Request $request)
//     {
//         $validated = $request->validate([
//             'categoryid' => "required",
//             // 'subcategoryid'=>"required",
//             'product_id' => "required",
//             'varient' => "required",
//             'value' => "required",
//             'mrp_price' => "required",
//             'offer_price' => "required",
//             'product_qty' => "required",
//             'low_stock' => "required",
//             'hot_deals' => 'nullable',
//             'product_gst' => 'nullable',
//         ]);

//         if ($request->hasFile("Varient_image")) {
//     $variantImage = $request->file("Varient_image");
//     $variantImagePath = $variantImage->store("variant_images", "public");
// } else {
//     $variantImagePath = null; // or set a default image path if needed
// }
// // "varient_img" => $variantImagePath,

//         $subcate = $request->subcategoryid;
//         $subcatedisplay = SubCategory::where('id', $subcate)->first();
//         $displayname = $subcatedisplay->subcategory_name;


//         $productver =  ProductVarient::create([...$validated, "subcatename" => $displayname, "varient_img" => $variantImagePath]);
//         $product =  Product::find($validated["product_id"]);
//         $categoryId = $product->category_id;
//         // $subacategoryid = $product->subcategory_id;
//         $proname = $product->product_name;
//         $varient_name = $product->varient_name;



//         DB::table('productstocks')->insert([
//             "productid" => $request->product_id,
//             "category_id" =>  $categoryId,
//             "subcategory_id" => $subacategoryid ?? '',
//             "pro_ver_id" => $productver->id,
//             "productname" => $proname,
//             "varient_name" => $varient_name,
//             "overallstock" =>  $request->product_qty,
//             "availablestock" => $request->product_qty,
//             "salestock" => 0,
//             "low_stocks" => $request->low_stock,
//             "last_stockupdate_date" => date("Y-m-d"),
//         ]);


//         $productvarient = ProductVarient::select('product_varient.*', 'products.product_name', 'products.category_id', 'categories.category_name')
//             ->join('products', 'product_varient.product_id', "=", 'products.id')
//             ->join('categories', 'products.category_id', '=', 'categories.id')
//             ->get();



//         $products = Product::all();
//         $categories = Category::all();


//         return response()->json([
//             "message" => $this->productvarientSuccessMessage,
//             "productvarient" => $productvarient
//         ]);
//     }

  public function addproductvarient(Request $request)
{
    $validated = $request->validate([
        'categoryid'     => "required",
        'subcategoryid'  => "nullable",
        'product_id'     => "required",

        'varient'        => "nullable",
        'unit_id'        => "required",
        'value'          => "required",
        'mrp_price'      => "required",
        'offer_price'    => "required",
        'product_qty'    => "required",
        'low_stock'      => "required",
        'hot_deals'      => 'nullable',
    'Popular_products'   => 'nullable',
    'pre_order'      => 'nullable',
    'pre_note'       => 'nullable',
    'flash_sale'     => 'nullable',
    'flash_sale_date'=> 'nullable',
        'product_gst'    => 'nullable',
        'sku'            => 'nullable',
        'barcode'        => 'nullable',
        'weight'         => 'nullable',
    ]);


     $validated['hot_deals'] = $request->has('hot_deals') ? 1 : 0;
    $validated['Popular_products'] = $request->has('Popular_products') ? 1 : 0;
    $validated['pre_order'] = $request->has('pre_order') ? 1 : 0;
    $validated['flash_sale'] = $request->has('flash_sale') ? 1 : 0;
    if (!$request->has('pre_order')) {
    $validated['pre_note'] = null;
}
    // Handle optional image upload
    if ($request->hasFile("Varient_image")) {
        $variantImage = $request->file("Varient_image");
        $variantImagePath = $variantImage->store("variant_images", "public");
    } else {
        $variantImagePath = null;
    }

    // Get product and category info
    $product = Product::findOrFail($validated["product_id"]);
    $categoryId = $product->category_id;
    $proname = $product->product_name;
    $varient_name = $product->varient_name;
    
    // Get subcategory name
    $subcateid = $validated['subcategoryid'] ?? null;
    $subcatedisplay = SubCategory::where('id', $subcateid)->first();
    $displayname = $subcatedisplay ? $subcatedisplay->subcategory_name : '';


    // Create product variant (subcategory logic removed)
    // Create product variant
    $productver = ProductVarient::create([
        ...$validated,
        "subcatename"  => $displayname, 
        "varient_img"  => $variantImagePath,
        "sku"          => $request->sku ?? (strtoupper(substr($proname, 0, 3)) . '-' . rand(1000, 9999)),
        "barcode"      => $request->barcode,
        "unit_id"      => $request->unit_id,
        "varient"      => $request->value,
        "weight"       => $request->weight,
    ]);

    // Create stock entry (subcategory logic removed)
    DB::table('productstocks')->insert([
        "productid"             => $request->product_id,
        "category_id"           => $categoryId,
        "subcategory_id"        => $request->subcategoryid, 

        "pro_ver_id"            => $productver->id,
        "productname"           => $proname,
        // "varient_name"          => $varient_name,
        "overallstock"          => $request->product_qty,
        "availablestock"        => $request->product_qty,
        "salestock"             => 0,
        "low_stocks"            => $request->low_stock,
        "last_stockupdate_date" => now()->format('Y-m-d'),
    ]);

    // Reload updated variant list
    // Reload updated variant list
    $productvarient = ProductVarient::select(
            'product_varient.*',
            'products.product_name',
            'products.category_id as categoryid',
            'products.subcategory_id as subcategoryid',
            'categories.category_name',
            'units.short_name as unit_short_name'
        )
        ->join('products', 'product_varient.product_id', '=', 'products.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->leftJoin('units', 'product_varient.unit_id', '=', 'units.id')
        ->get();


        if ($request->hasFile('product_image1')) {
    foreach ($request->file('product_image1') as $productImage) {
        if ($productImage->isValid()) {
            $path = $productImage->store('product_images1', 'public');

            DB::table('product_child_images')->insert([
                'product_id'         => $request->product_id,
                'variant_id'         => $productver->id,
                'product_child_image' => $path,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }
    }
}


    return response()->json([
        "message"        => $this->productvarientSuccessMessage,
        "productvarient" => $productvarient
    ]);
}

    public function update(Request $request, $id)
    {
        $productvarient = ProductVarient::findOrFail($id);

        $validated = $request->validate([
            'categoryid' => "required",
            'subcategoryid' => "nullable",
            'product_id' => "required",
            'varient' => "nullable",
            'unit_id' => "required",
            'value' => "required",
            'mrp_price' => "required",
            'offer_price' => "required",
            'product_qty' => "required",
            'low_stock' => "required",
            'pre_note'     => "nullable",
            'product_gst' => 'nullable',
            'sku' => 'nullable',
            'barcode' => 'nullable',
            'flash_sale' => 'nullable',
            'flash_sale_date' => 'nullable',
            'weight' => 'nullable',
        ]);
         $hotDealsValue   = $request->has('hot_deals') ? 1 : 0;
         $bestselValue    = $request->has('popular_prod') ? 1 : 0;
         $preorderValue   = $request->has('pre_order') ? 1 : 0;
         $flashSaleValue   = $request->has('flash_sale') ? 1 : 0;

        $productvarient->update([
            'categoryid' => $validated["categoryid"],
            'subcategoryid' => $validated["subcategoryid"] ?? null,

            'product_id' => $validated["product_id"],
            'unit_id' => $request->unit_id,
            'varient' => $request->value,
            'value' => $validated["value"],
            'mrp_price' => $validated["mrp_price"],
            'offer_price' => $validated["offer_price"],
            'product_qty' => $validated["product_qty"],
            'low_stock' => $validated["low_stock"],
            'hot_deals' => $hotDealsValue,
            'Popular_products' => $bestselValue,
            'pre_order' => $preorderValue,
            'flash_sale' => $flashSaleValue,
            'flash_sale_date' => $validated['flash_sale_date'] ?? null,
            'pre_note'          => $validated["pre_note"],
            'product_gst' => $validated["product_gst"],
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'weight' => $request->weight,
        ]);

        // Check and update variant image only if new file uploaded
if ($request->hasFile("varient_image")) {
    $variantImage = $request->file("varient_image");
    $variantImagePath = $variantImage->store("variant_images", "public");

    $productvarient->update([
        'varient_img' => $variantImagePath
    ]);
}


        $product = Product::find($validated['product_id']);
        $categoryId = $product->category_id;
        $subaCategoryId = $product->subcategory_id;
        $proname = $product->product_name;

        // Update product stock based on the changes made to the product variant
        DB::table('productstocks')
            ->updateOrInsert(
                ['pro_ver_id' => $productvarient->id],
                [
                    'productid' => $validated['product_id'],
                    'category_id' => $categoryId,
                    'subcategory_id' => $validated['subcategoryid'] ?? null,
                    'productname' => $proname,
                    'overallstock' => $request->product_qty,
                    'availablestock' => $request->product_qty,
                    'low_stocks' => $request->low_stock,
                    'last_stockupdate_date' => now(),
                ]
            );






        //  ====  update image =


        if (!empty($request->product_image1) && is_iterable($request->product_image1)) {
            foreach ($request->product_image1 as $key => $img) {
                if ($img->isFile()) {
                    $productImage = $img;
                    $path = $productImage->store("product_images1", "public");
                    $product1 = ProductChildImage::create([
                        "variant_id" => $productvarient->id,
                        "product_id" => $product->id,
                        "product_child_image" => $path
                    ]);
                }
            }
        }

        // foreach ($request->product_image1 as $key => $img) {
        //     if ($img->isFile()) {
        //         $productImage = $img;
        //         $path =  $productImage->store("product_images1", "public");
        //         $product1 = ProductChildImage::create(["variant_id" => $productvarient->id, "product_id" => $product->id, "product_child_image" => $path]);
        //     }
        // }





$variantId = $productvarient->id;

        $productvarient = ProductVarient::select(
            'product_varient.*', 
            'products.product_name', 
            'products.category_id as categoryid', 
            'products.subcategory_id as subcategoryid',
            'categories.category_name',
            'units.short_name as unit_short_name'
            )
            ->join('products', 'product_varient.product_id', "=", 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('units', 'product_varient.unit_id', '=', 'units.id')
            ->get();

            // Update pre_order value in carts table for matching product and variant
DB::table('carts')
    ->where('product_id', $validated['product_id'])
    ->where('product_varient_id', $variantId)
    ->update([
        'pre_order' => $preorderValue
    ]);


        return response()->json([
            "message" => $this->productvarientSuccessMessage,
            "productvarient" => $productvarient
        ]);
    }

    // public function destroy($id)
    // {


    //     // Use a SQL DELETE query to remove the coupon with the given ID
    //     $deletedRows = ProductVarient::where('id', $id)->delete();

    //     DB::table('productstocks')->where("pro_ver_id", $id)->delete();


    //     if ($deletedRows) {
    //         $productvarient = ProductVarient::select('product_varient.*', 'products.product_name', 'products.category_id', 'categories.category_name')
    //             ->join('products', 'product_varient.product_id', "=", 'products.id')
    //             ->join('categories', 'products.category_id', '=', 'categories.id')
    //             ->get();
    //         return response()->json([
    //             "message" => "Product Varient Deleted Successfully",
    //             "productvarient" => $productvarient
    //         ]);
    //     } else {
    //         return response()->json([
    //             "message" => "Product Varient Not Found or Could Not Be Deleted",
    //         ], 404); // You can use a different HTTP status code if needed
    //     }
    // }
    
     public function destroy($id)
{
    // Find the variant
    $variant = ProductVarient::find($id);

    if (!$variant) {
        return response()->json([
            "message" => "Product Variant not found",
        ], 404);
    }

    // Get the product ID associated with this variant
    $productId = $variant->product_id;

    // Delete the variant
    $deletedRows = ProductVarient::where('id', $id)->delete();

    // Delete related stock entry
    DB::table('productstocks')->where("pro_ver_id", $id)->delete();

    // Check if any more variants exist for this product
    $remainingVariants = ProductVarient::where('product_id', $productId)->count();

    if ($remainingVariants === 0) {
        // Delete the product if no more variants are left
        DB::table('products')->where('id', $productId)->delete();
    }

    // Return updated variant list
    // Return updated variant list
    $productvarient = ProductVarient::select(
        'product_varient.*', 
        'products.product_name', 
        'products.category_id as categoryid', 
        'products.subcategory_id as subcategoryid',
        'categories.category_name',
        'units.short_name as unit_short_name'
        )
        ->join('products', 'product_varient.product_id', "=", 'products.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->leftJoin('units', 'product_varient.unit_id', '=', 'units.id')
        ->get();

    return response()->json([
        "message" => "Product Variant Deleted Successfully" . ($remainingVariants === 0 ? " and Product Removed" : ""),
        "productvarient" => $productvarient
    ]);
}


    public function Getsubcategory($id)
    {
        $product = Product::where('subcategory_id', $id)->get();
        return response()->json($product);
    }
    public function Getproduct($id)
    {
        $product = Product::where('category_id', $id)->get();
        return response()->json($product);
    }

    public function getproductverfilter(Request $request)
    {

        $catId =  $request->category_id;
        $productId = $request->product_id;



        $productvarient = ProductVarient::select(
            'product_varient.*', 
            'products.product_name', 
            'products.category_id as categoryid', 
            'products.subcategory_id as subcategoryid',
            'categories.category_name',
            'units.short_name as unit_short_name'
            )
            ->join('products', 'product_varient.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('units', 'product_varient.unit_id', '=', 'units.id')
            ->when($request->filled('category_id'), function ($query) use ($catId) {
                $query->where('products.category_id', $catId);
            })
            ->when($request->filled('product_id'), function ($query) use ($productId) {
                $query->where('products.id', $productId);
            })
            // Add more conditions as needed
            ->get();

        $data = [
            'productvarient' => $productvarient,
            'i' => 1,
        ];

        return $data;
    }
}