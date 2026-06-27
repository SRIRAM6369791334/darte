<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class NotificationController extends Controller
{

    public $NotificationSuccessMessage = "Reviews Saved Successfully";
    public function index(){
        $notififils = Review::with('product.category')->get();
        $products =  Product::with('category')->get();
        $categories = Category::all();

        return view("pages.notification",compact("notififils","products", "categories"));


    }

    // add notifications

    // public function notifications(Request $request){

    //     $validate = $request->validate(
    //         [
    //             'notification_title' => "required",
    //             'notification_content' => "required",
    //             // 'notification_image' => "required|mimes:png,jpg,webp,jpeg",
    //             ]
    //         );


    //         if ($request->hasFile("notification_image")) {
    //             $productImage = $request->file("notification_image");
    //             $path =  $productImage->store("notification_image", "public");
    //             $notififils = AppNotification::create([...$validate, "notification_image" => $path]);

    //             $notififils = AppNotification::all();


    //             return response()->json([
    //                 "message" => $this->NotificationSuccessMessage,
    //                 "notififils" =>$notififils
    //             ]);
    //         }


    // }
    public function notifications(Request $request)
{
    $validate = $request->validate([
        'notification_title' => "required",
        'notification_content' => "nullable",
        'category_id' => "required",
        'product_id' => "required",
        'product_review' => "required",
        'star_rating' => "required",
    ]);

     $category = Category::find($validate['category_id']);
    $product = Product::find($validate['product_id']);

    $data = [
        'name' => $validate['notification_title'],
        'prod_id' => $validate['product_id'],
        'review' => $validate['product_review'],
        'ratings' => $validate['star_rating'],
        'status' => $request->has('approval') ? 1 : 0,
    ];

    Review::create($data); 

    $notififils = Review::with('product.category')->get();

    return response()->json([
        "message" => $this->NotificationSuccessMessage,
        "notififils" =>$notififils
    ]);
}


     // Update coupons
    //  public function update(Request $request, $id)
    //  {
    //      $notification = AppNotification::findOrFail($id);

    //      $validated = $request->validate([
    //         'notification_title' => "required",
    //         'notification_content' => "required",
    //         "notification_image" => $request->hasFile("notification_image") ? "required|mimes:png,jpg,webp,jpeg" : "",

    //      ]);

    //      if ($request->hasFile("notification_image")) {


    //         $productImage = $request->file("notification_image");
    //         $path =  $productImage->store("notification_image", "public");
    //         File::delete(public_path("images/" . $notification->notification_image));
    //         $notification->update([
    //             ...$validated,
    //             "notification_image" =>  $path,
    //         ]);
    //         $notififils =  AppNotification::all();
    //         return response()->json([
    //             "message" => $this->NotificationSuccessMessage,
    //             "notififils" => $notififils
    //         ]);
    //     }else{



    //      $notification->update([
    //          'notification_title' => $validated["notification_title"],
    //          'notification_content' => $validated["notification_content"],



    //      ]);

    //      $notififils =  AppNotification::all();
    //      return response()->json([
    //          "message" => $this->NotificationSuccessMessage,
    //          "notififils" => $notififils
    //      ]);
    //     }
    //  }

    public function update(Request $request, $id)
{
    $notification = Review::findOrFail($id);

    $validated = $request->validate([
        'notification_title' => "required",
        'product_id' => "required",
        'product_review' => "required",
        'star_rating' => "required",
    ]);

    $notification->update([
        'name' => $validated['notification_title'],
        'prod_id' => $validated['product_id'],
        'review' => $validated['product_review'],
        'ratings' => $validated['star_rating'],
        'status' => $request->has('approval') ? 1 : 0,
    ]);

    $notififils = Review::with('product.category')->get();

    return response()->json([
        "message" => $this->NotificationSuccessMessage,
        "notififils" => $notififils
    ]);
}


     public function destroy($id)
     {





         // Use a SQL DELETE query to remove the review with the given ID
         $notification = Review::where('id', $id)->delete();

         if ($notification) {
             $notification = Review::with('product.category')->get();
             return response()->json([
                 "message" => "Reviews Deleted Successfully",
                 "notification" => $notification
             ]);
         } else {
             return response()->json([
                 "message" => "Reviews Not Found or Could Not Be Deleted",
             ], 404); // You can use a different HTTP status code if needed
         }
     }

     public function toggleStatus($id)
     {
         $notification = Review::findOrFail($id);
         $notification->status = $notification->status == 1 ? 0 : 1;
         $notification->save();
 
         $notififils = Review::with('product.category')->get();
         return response()->json([
             "message" => "Status Updated Successfully",
             "notification" => $notififils
         ]);
     }

public function getProductsByCategory($id)
{
    $products = Product::where('category_id', $id)->get(['id', 'product_name']);
    return response()->json($products);
}


}
