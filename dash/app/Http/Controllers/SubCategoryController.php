<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Stmt\Catch_;

class SubCategoryController extends Controller {

    // VIEW

    public function index() {
        $subcate =  SubCategory::all();
        $cate = Category::all();
        return view( 'pages.subcategory', compact( 'subcate', 'cate' ) );
    }

    // ADD SUBCATEGORY

    public function store( Request $request ) {
        $request->validate( [
            'subcategory_name'=> 'required',
            'category_name' => 'required',
        ] );

        $categoryname = $request->category_name;
        $subcategoryname = $request->subcategory_name;
        $subcatedisplay = Category::where( 'id', $categoryname )->first();
        $displayname = $subcatedisplay->category_name;

        SubCategory::create( [
            'category_name' => $categoryname,
            'subcategory_name'=> $subcategoryname,
            'category_display'=>$displayname,
        ] );

        $subcate = SubCategory::all();

        return response()->json( [
            'message' => 'Sub Category Added Successfully',
            'subcategories' => $subcate
        ] );
    }

    // EDIT SUBCATEGORY

    public function update( Request $request, $id ) {
        $subcategory = SubCategory::findOrFail( $id );

        $request->validate( [
            'edit_category_name'=> 'required',
            'edit_subcategory_name' => 'required',
        ] );

        $categoryname = $request->edit_category_name;
        $subcategoryname = $request->edit_subcategory_name;

        $subcategory->update( [
            'category_name' => $categoryname,
            'subcategory_name' => $subcategoryname,
        ] );

        $subcategories =  SubCategory::all();

        return response()->json( [
            'message' => 'Sub Category Updated Successfully',
            'subcategories' => $subcategories
        ] );
    }

    public function destroy( $id ) {
        $subcategory = SubCategory::findOrFail( $id );

        if ( $subcategory->subcategory_image && File::exists( public_path( 'images/' ) . $subcategory->subcategory_image ) ) {
            File::delete( public_path( 'images/' ) . $subcategory->subcategory_image );
        }

        // Soft delete products associated with this subcategory
        \App\Models\Product::where('subcategory_id', $subcategory->id)->delete();

        $subcategory->delete();

        $subcategories =  SubCategory::all();

        return response()->json( [
            'message' => 'Record Deleted Successfully',
            'subcategories' => $subcategories
        ] );
    }

    public function getSubByCategory($id) {
        $subcategories = SubCategory::where('category_name', $id)->get();
        return response()->json($subcategories);
    }

}