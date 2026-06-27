<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Services\SeoService;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        // Blog listing SEO (from DB or fallback)
        $seoService = app(SeoService::class);
        $meta       = $seoService->getMetaForCurrentUrl() ?? (object) [
            'meta_title'       => 'Blog — Style, Tips & Trends | DARTE',
            'meta_description' => 'Read the latest articles, style tips, and leather care guides from DARTE — your premium leather accessories brand.',
            'meta_keyword'     => 'DARTE blog, leather care, fashion tips, style guide, premium bags blog',
            'og_title'         => 'DARTE Blog — Style & Leather Care Tips',
            'og_description'   => 'Read expert tips on leather care, fashion, and style from the DARTE team.',
            'og_image'         => asset('assets/images/logo.webp'),
            'schema_code'      => null,
        ];

        view()->share('meta', $meta);
        return view('pages.blog', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('url_name', $slug)->firstOrFail();

        $latestBlogs = Blog::latest()->limit(5)->get();

        // Build dynamic blog post SEO
        $seoService = app(SeoService::class);
        $meta       = $seoService->buildBlogMeta($blog);
        view()->share('meta', $meta);
        return view('pages.blog-details', compact('blog', 'latestBlogs'));
    }
}
