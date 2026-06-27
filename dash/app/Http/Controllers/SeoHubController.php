<?php

namespace App\Http\Controllers;

use App\Models\Seotag;
use App\Models\Metatag;
use Illuminate\Http\Request;

class SeoHubController extends Controller
{
    public function index()
    {
        $seotags = Seotag::latest()->get();
        $metatags = Metatag::latest()->get();
        return view('pages.seo-hub', compact('seotags', 'metatags'));
    }

    public function storeSeoTag(Request $request)
    {
        $request->validate([
            'url' => 'required|unique:seotags,url',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable',
        ]);

        Seotag::create($request->all());

        return response()->json(['success' => true, 'message' => 'SEO Tag created successfully']);
    }

    public function updateSeoTag(Request $request, $id)
    {
        $seotag = Seotag::findOrFail($id);
        $request->validate([
            'url' => 'required|unique:seotags,url,' . $id,
        ]);

        $seotag->update($request->all());

        return response()->json(['success' => true, 'message' => 'SEO Tag updated successfully']);
    }

    public function destroySeoTag($id)
    {
        Seotag::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'SEO Tag deleted successfully']);
    }

    public function storeMetaTag(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/seo');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }

        Metatag::create($data);

        return response()->json(['success' => true, 'message' => 'Meta Tag created successfully']);
    }

    public function updateMetaTag(Request $request, $id)
    {
        $metatag = Metatag::findOrFail($id);
        
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($metatag->image && file_exists(public_path('/uploads/seo/' . $metatag->image))) {
                unlink(public_path('/uploads/seo/' . $metatag->image));
            }
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/seo');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }

        $metatag->update($data);

        return response()->json(['success' => true, 'message' => 'Meta Tag updated successfully']);
    }

    public function destroyMetaTag($id)
    {
        $metatag = Metatag::findOrFail($id);
        if ($metatag->image && file_exists(public_path('/uploads/seo/' . $metatag->image))) {
            unlink(public_path('/uploads/seo/' . $metatag->image));
        }
        $metatag->delete();
        return response()->json(['success' => true, 'message' => 'Meta Tag deleted successfully']);
    }
}
