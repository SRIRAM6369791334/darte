<?php

namespace App\Http\Controllers;

use App\Models\HomePromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomePromotionController extends Controller
{
    /* ================= LIST ================= */
    public function index()
    {
        $promotions = HomePromotion::orderBy('sort_order', 'asc')->get();
        return view("pages.home_promotions", compact("promotions"));
    }

    /* ================= STORE ================= */
    public function store(Request $request)
    {
        $request->validate([
            "bg_image" => "required|image|mimes:png,jpg,jpeg,webp|dimensions:width=480,height=600",
            "link_url" => "required|string|max:255",
        ], [
            "bg_image.dimensions" => "Image must be exactly 480x600 pixels."
        ]);

        try {
            $path = $request->file("bg_image")->store("home_promotions", "public");

            HomePromotion::create([
                "link_url" => $request->link_url,
                "bg_image" => $path,
            ]);

            return response()->json([
                "message" => "Promotion Added Successfully",
                "promotions" => HomePromotion::orderBy('sort_order', 'asc')->get()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to add promotion"
            ], 500);
        }
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id)
    {
        $promo = HomePromotion::findOrFail($id);

        $request->validate([
            "bg_image" => "nullable|image|mimes:png,jpg,jpeg,webp|dimensions:width=480,height=600",
            "link_url" => "required|string|max:255",
        ], [
            "bg_image.dimensions" => "Instagram Image must be exactly 480x600 pixels."
        ]);

        try {
            $data = [
                "link_url" => $request->link_url,
            ];

            if ($request->hasFile("bg_image")) {

                // delete old image (storage safe)
                if ($promo->bg_image && Storage::disk('public')->exists($promo->bg_image)) {
                    Storage::disk('public')->delete($promo->bg_image);
                }

                $data["bg_image"] = $request->file("bg_image")->store("home_promotions", "public");
            }

            $promo->update($data);

            return response()->json([
                "message" => "Instagram Updated Successfully",
                "promotions" => HomePromotion::orderBy('sort_order', 'asc')->get()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to update Instagram"
            ], 500);
        }
    }

    /* ================= DELETE ================= */
    public function destroy($id)
    {
        $promo = HomePromotion::findOrFail($id);

        try {
            if ($promo->bg_image && Storage::disk('public')->exists($promo->bg_image)) {
                Storage::disk('public')->delete($promo->bg_image);
            }

            $promo->delete();

            return response()->json([
                "message" => "Instagram Deleted Successfully",
                "promotions" => HomePromotion::orderBy('sort_order', 'asc')->get()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to delete Instagram"
            ], 500);
        }
    }

    /* ================= SORT ================= */
    public function updateSortOrder(Request $request)
    {
        $order = $request->order;

        foreach ($order as $position => $id) {
            HomePromotion::where('id', $id)->update([
                'sort_order' => $position
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
