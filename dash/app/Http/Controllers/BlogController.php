<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('pages.blog', compact('blogs'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'date' => 'required|date',
        //     'image' => 'required|image',
        //     'description' => 'required'
        // ]);
        $request->validate([
    'title' => 'required|string|max:255',
    'date' => 'required|date',
    'image' => 'required|image|mimes:jpeg,png,webp|max:2048',
    'description' => 'required|string|min:1'
]);

        $fileName = time().'_'.Str::random(5).'.'.$request->image->extension();
        $request->image->move(public_path('uploads/blogs'), $fileName);

        Blog::create([
            'title'            => $request->title,
            'date'             => $request->date,
            'image'            => $fileName,
            'description'      => $request->description,
            'url_name'         => Str::slug($request->title),
            'meta_title'       => $request->meta_title ?: $request->title . ' - Darte Blog',
            'meta_description' => $request->meta_description ?: Str::limit(strip_tags($request->description), 160),
            'meta_key'         => $request->meta_key,
        ]);

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $blog = Blog::findOrFail($request->id);

        $fileName = $blog->image;

        if ($request->hasFile('image')) {

            if (file_exists(public_path('uploads/blogs/'.$blog->image))) {
                unlink(public_path('uploads/blogs/'.$blog->image));
            }

            $fileName = time().'_'.Str::random(5).'.'.$request->image->extension();
            $request->image->move(public_path('uploads/blogs'), $fileName);
        }

        $blog->update([
            'title'            => $request->title,
            'date'             => $request->date,
            'image'            => $fileName,
            'description'      => $request->description,
            'url_name'         => Str::slug($request->title),
            'meta_title'       => $request->meta_title ?: $request->title . ' - Darte Blog',
            'meta_description' => $request->meta_description ?: Str::limit(strip_tags($request->description), 160),
            'meta_key'         => $request->meta_key,
        ]);

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $blog = Blog::findOrFail($request->id);

        if (file_exists(public_path('uploads/blogs/'.$blog->image))) {
            unlink(public_path('uploads/blogs/'.$blog->image));
        }

        $blog->delete();

        return response()->json(['success' => true]);
    }
}
