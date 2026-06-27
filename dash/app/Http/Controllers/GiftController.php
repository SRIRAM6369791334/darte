<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductVarient;
use App\Models\ProductStock;
use App\Models\GiftCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class GiftController extends Controller
{
    // --- Gift Categories ---
    public function categoryIndex()
    {
        $categories = GiftCategory::all();
        return view("pages.gifts.categories", compact("categories"));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            "banner_title" => "required",
            "banner_description" => "required",
            "category_image" => "required|mimes:png,jpg,jpeg,webp|dimensions:width=960,height=550|max:10240",
        ]);

        $categoryImagePath = null;
        if ($request->hasFile("category_image")) {
            $categoryImage = $request->file("category_image");
            $filename = time() . '.' . $categoryImage->getClientOriginalExtension();
            $categoryImagePath = $categoryImage->move(public_path('images/category_images'), $filename);
            $categoryImagePath = 'category_images/' . $filename;
        }

        GiftCategory::create([
            "category_name" => $request->banner_title,
            "banner_title" => $request->banner_title,
            "banner_description" => $request->banner_description,
            "category_image" => $categoryImagePath,
            "status" => 1,
        ]);

        $categories = GiftCategory::all();

        return response()->json([
            "message" => "Gift Banner Added Successfully",
            "categories" => $categories
        ]);
    }

    public function categoryUpdate(Request $request, $id)
    {
        $category = GiftCategory::findOrFail($id);
        $request->validate([
            "banner_title" => "required",
            "banner_description" => "required",
            "category_image" => $request->hasFile("category_image") ? "required|mimes:png,jpg,jpeg,webp|dimensions:width=960,height=550|max:10240" : "",
        ]);

        $updateData = [
            "category_name" => $request->banner_title,
            "banner_title" => $request->banner_title,
            "banner_description" => $request->banner_description,
        ];

        if ($request->hasFile("category_image")) {
            $categoryImage = $request->file("category_image");
            $filename = time() . '.' . $categoryImage->getClientOriginalExtension();
            $path = $categoryImage->move(public_path('images/category_images'), $filename);
            $newPath = 'category_images/' . $filename;

            if ($category->category_image && file_exists(public_path('images/' . $category->category_image))) {
                unlink(public_path('images/' . $category->category_image));
            }
            $updateData["category_image"] = $newPath;
        }

        $category->update($updateData);
        $categories = GiftCategory::all();

        return response()->json([
            "message" => "Gift Banner Updated Successfully",
            "categories" => $categories
        ]);
    }

    public function categoryDestroy($id)
    {
        $category = GiftCategory::findOrFail($id);
        if ($category->category_image && file_exists(public_path('images/' . $category->category_image))) {
            unlink(public_path('images/' . $category->category_image));
        }
        $category->delete();
        $categories = GiftCategory::all();
        return response()->json([
            "message" => "Gift Banner Deleted Successfully",
            "categories" => $categories
        ]);
    }

    // --- Gift SubCategories ---
    public function subcategoryIndex()
    {
        $subcategories = SubCategory::where('is_gift', 1)->get();
        $categories = GiftCategory::all();
        return view("pages.gifts.subcategories", compact("subcategories", "categories"));
    }

    public function subcategoryStore(Request $request)
    {
        $request->validate([
            "subcategory_name" => "required",
            "category_name" => "required",
            "subcategory_image" => "required|mimes:png,jpg,jpeg,webp",
        ]);

        $category = GiftCategory::find($request->category_name);
        $displayname = $category->category_name ?? null;

        $path = null;
        if ($request->hasFile("subcategory_image")) {
            $path = $request->file("subcategory_image")->store("subcategory_images", "public");
        }

        SubCategory::create([
            "subcategory_name" => $request->subcategory_name,
            "category_name" => $request->category_name, // ID
            "subcategory_image" => $path,
            "is_gift" => 1,
            "category_display" => $displayname
        ]);

        $subcategories = SubCategory::where('is_gift', 1)->get();
        return response()->json([
            "message" => "Gift SubCategory Added Successfully",
            "subcategories" => $subcategories
        ]);
    }

    public function subcategoryUpdate(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $request->validate([
            "subcategory_name" => "required",
            "category_name" => "required",
            "subcategory_image" => $request->hasFile("subcategory_image") ? "required|mimes:png,jpg,jpeg,webp" : "",
        ]);

        $category = GiftCategory::find($request->category_name);
        $displayname = $category->category_name ?? null;

        $updateData = [
            "subcategory_name" => $request->subcategory_name,
            "category_name" => $request->category_name,
            "category_display" => $displayname
        ];

        if ($request->hasFile("subcategory_image")) {
            $path = $request->file("subcategory_image")->store("subcategory_images", "public");
            if ($subcategory->subcategory_image && Storage::disk('public')->exists($subcategory->subcategory_image)) {
                Storage::disk('public')->delete($subcategory->subcategory_image);
            }
            $updateData["subcategory_image"] = $path;
        }

        $subcategory->update($updateData);
        $subcategories = SubCategory::where('is_gift', 1)->get();

        return response()->json([
            "message" => "Gift SubCategory Updated Successfully",
            "subcategories" => $subcategories
        ]);
    }

    public function subcategoryDestroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        if ($subcategory->subcategory_image && Storage::disk('public')->exists($subcategory->subcategory_image)) {
            Storage::disk('public')->delete($subcategory->subcategory_image);
        }
        $subcategory->delete();
        $subcategories = SubCategory::where('is_gift', 1)->get();
        return response()->json([
            "message" => "Gift SubCategory Deleted Successfully",
            "subcategories" => $subcategories
        ]);
    }

    // --- Gift Products ---
    public function productIndex()
    {
        $products = Product::where('is_gift', 1)->get();
        $categories = GiftCategory::all();
        $subcategories = SubCategory::where('is_gift', 1)->get();
        $brands = Brand::all();
        return view("pages.gifts.products", compact("products", "categories", "subcategories", "brands"));
    }

    public function productStore(Request $request)
    {
        $request->validate([
            "product_name" => "required",
            "category_id" => "required",
            "product_image" => "required|mimes:png,jpg,jpeg,webp",
            "mrp_price" => "required|numeric",
            "offer_price" => "required|numeric",
            "stock_quantity" => "required|numeric",
            "low_stock" => "required|numeric",
        ]);

        $path = null;
        if ($request->hasFile("product_image")) {
            $path = $request->file("product_image")->store("product_images", "public");
        }

        $category = GiftCategory::find($request->category_id);
        $subcategory = SubCategory::find($request->subcategory_id);

        $product = Product::create([
            "product_name" => $request->product_name,
            "category_id" => $request->category_id,
            "subcategory_id" => $request->subcategory_id,
            "brand_id" => $request->brand_id,
            "product_description" => $request->product_description,
            "product_image" => $path,
            "product_mrp_price" => $request->mrp_price,
            "product_regular_price" => $request->offer_price,
            "product_quantity" => $request->stock_quantity,
            "low_stock" => $request->low_stock,
            "is_gift" => 1,
            "cate_name" => $category->category_name ?? null,
            "subcate_name" => $subcategory->subcategory_name ?? null,
            "slug" => \Illuminate\Support\Str::slug($request->product_name) . '-' . time(),
            "product_specification" => $request->product_name,
            "approval_days" => 0,
        ]);

        // Create a basic variant for stock management compatibility
        $variant = ProductVarient::create([
            'categoryid' => $product->category_id,
            'subcategoryid' => $product->subcategory_id,
            'subcatename' => $product->subcate_name,
            'product_id' => $product->id,
            'sku' => strtoupper(substr($product->product_name, 0, 3)) . '-' . rand(1000, 9999),
            'varient_name' => 'Standard',
            'mrp_price' => $request->mrp_price,
            'offer_price' => $request->offer_price,
            'product_qty' => $request->stock_quantity,
            'low_stock' => $request->low_stock,
        ]);

        // Create Stock entry
        DB::table('productstocks')->insert([
            "productid" => $product->id,
            "category_id" => $product->category_id,
            "subcategory_id" => $product->subcategory_id,
            "pro_ver_id" => $variant->id,
            "productname" => $product->product_name,
            "overallstock" => $request->stock_quantity,
            "availablestock" => $request->stock_quantity,
            "salestock" => 0,
            "low_stocks" => $request->low_stock,
            "last_stockupdate_date" => date("Y-m-d"),
        ]);

        $products = Product::where('is_gift', 1)->get();
        return response()->json([
            "message" => "Gift Product Added Successfully",
            "products" => $products
        ]);
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            "product_name" => "required",
            "category_id" => "required",
            "product_image" => $request->hasFile("product_image") ? "required|mimes:png,jpg,jpeg,webp" : "",
            "mrp_price" => "required|numeric",
            "offer_price" => "required|numeric",
            "stock_quantity" => "required|numeric",
            "low_stock" => "required|numeric",
        ]);

        $category = GiftCategory::find($request->category_id);
        $subcategory = SubCategory::find($request->subcategory_id);

        $updateData = [
            "product_name" => $request->product_name,
            "category_id" => $request->category_id,
            "subcategory_id" => $request->subcategory_id,
            "brand_id" => $request->brand_id,
            "product_description" => $request->product_description,
            "product_mrp_price" => $request->mrp_price,
            "product_regular_price" => $request->offer_price,
            "product_quantity" => $request->stock_quantity,
            "low_stock" => $request->low_stock,
            "cate_name" => $category->category_name ?? null,
            "subcate_name" => $subcategory->subcategory_name ?? null,
            "slug" => \Illuminate\Support\Str::slug($request->product_name) . '-' . time(),
        ];

        if ($request->hasFile("product_image")) {
            $path = $request->file("product_image")->store("product_images", "public");
            if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
                Storage::disk('public')->delete($product->product_image);
            }
            $updateData["product_image"] = $path;
        }

        $product->update($updateData);

        // Update variant and stock records
        $variant = ProductVarient::where('product_id', $id)->first();
        if ($variant) {
            $variant->update([
                'categoryid' => $product->category_id,
                'subcategoryid' => $product->subcategory_id,
                'subcatename' => $product->subcate_name,
                'mrp_price' => $request->mrp_price,
                'offer_price' => $request->offer_price,
                'product_qty' => $request->stock_quantity,
                'low_stock' => $request->low_stock,
            ]);

            DB::table('productstocks')->updateOrInsert(
                ['pro_ver_id' => $variant->id],
                [
                    "productid" => $product->id,
                    "category_id" => $product->category_id,
                    "subcategory_id" => $product->subcategory_id,
                    "productname" => $product->product_name,
                    "overallstock" => $request->stock_quantity,
                    "availablestock" => $request->stock_quantity,
                    "low_stocks" => $request->low_stock,
                    "last_stockupdate_date" => now(),
                ]
            );
        }

        $products = Product::where('is_gift', 1)->get();

        return response()->json([
            "message" => "Gift Product Updated Successfully",
            "products" => $products
        ]);
    }

    public function productDestroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
            Storage::disk('public')->delete($product->product_image);
        }
        $product->delete();
        $products = Product::where('is_gift', 1)->get();
        return response()->json([
            "message" => "Gift Product Deleted Successfully",
            "products" => $products
        ]);
    }
}
