<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate a dynamic XML sitemap.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $products = Product::where('status', 1)->latest()->get();
        $categories = Category::all();
        $blogs = Blog::latest()->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Static Pages
        $staticPages = [
            ['url' => url('/'), 'priority' => '1.0', 'freq' => 'daily'],
            ['url' => url('/shop'), 'priority' => '0.8', 'freq' => 'daily'],
            ['url' => url('/about-us'), 'priority' => '0.5', 'freq' => 'monthly'],
            ['url' => url('/contact-us'), 'priority' => '0.5', 'freq' => 'monthly'],
        ];

        foreach ($staticPages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>' . $page['url'] . '</loc>';
            $xml .= '<lastmod>' . now()->tz('UTC')->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>' . $page['freq'] . '</changefreq>';
            $xml .= '<priority>' . $page['priority'] . '</priority>';
            $xml .= '</url>';
        }

        // Product Pages
        foreach ($products as $product) {
            $xml .= '<url>';
            $xml .= '<loc>' . url('/shop-details/' . $product->slug) . '</loc>';
            $xml .= '<lastmod>' . $product->updated_at->tz('UTC')->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.9</priority>';
            $xml .= '</url>';
        }

        // Category Pages
        foreach ($categories as $category) {
            $xml .= '<url>';
            $xml .= '<loc>' . url('/shop/' . $category->slug) . '</loc>';
            $lastMod = $category->updated_at ? $category->updated_at->tz('UTC')->toAtomString() : now()->tz('UTC')->toAtomString();
            $xml .= '<lastmod>' . $lastMod . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.7</priority>';
            $xml .= '</url>';
        }

        // Blog Pages
        foreach ($blogs as $blog) {
            $xml .= '<url>';
            $xml .= '<loc>' . url('/blog-details/' . $blog->url_name) . '</loc>';
            $xml .= '<lastmod>' . \Carbon\Carbon::parse($blog->date)->tz('UTC')->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>monthly</changefreq>';
            $xml .= '<priority>0.6</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'text/xml');
    }
}
