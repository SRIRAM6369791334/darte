<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view("pages.brands", compact("brands"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "brand_name" => "required",
            "brand_image" => "nullable|image|mimes:png,jpg,jpeg,webp|max:2048",
        ]);

        $brandImagePath = null;

        if ($request->hasFile("brand_image")) {
            $brandImage = $request->file("brand_image");
            $brandImagePath = $brandImage->store("brand_images", "public");
        }

        Brand::create([
            "brand_name" => $request->brand_name,
            "brand_slug" => Str::slug($request->brand_name),
            "brand_image" => $brandImagePath,
            "status" => true,
        ]);

        $brands = Brand::all();

        return response()->json([
            "message" => "Brand Added Successfully",
            "brands" => $brands
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            "brand_name" => "required",
            "brand_image" => "nullable|image|mimes:png,jpg,jpeg,webp|max:2048",
        ]);

        $updateData = [
            "brand_name" => $request->brand_name,
            "brand_slug" => Str::slug($request->brand_name),
        ];

        if ($request->hasFile("brand_image")) {
            // Delete old image
            if ($brand->brand_image && File::exists(public_path('images/') . $brand->brand_image)) {
                File::delete(public_path('images/') . $brand->brand_image);
            }

            $brandImage = $request->file("brand_image");
            $updateData["brand_image"] = $brandImage->store("brand_images", "public");
        }

        $brand->update($updateData);

        $brands = Brand::all();

        return response()->json([
            "message" => "Brand Updated Successfully",
            "brands" => $brands
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        // Delete image
        if ($brand->brand_image && File::exists(public_path('images/') . $brand->brand_image)) {
            File::delete(public_path('images/') . $brand->brand_image);
        }

        $brand->delete();

        $brands = Brand::all();

        return response()->json([
            "message" => "Brand Deleted Successfully",
            "brands" => $brands
        ]);
    }
}
