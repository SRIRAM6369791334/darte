<?php

namespace App\Services;

use App\Models\Seotag;
use Illuminate\Support\Facades\Request;

class SeoService
{
    /**
     * Get SEO data for the current URL path.
     * Looks up the exact path, then tries wildcard patterns.
     *
     * @return Seotag|null
     */
    public function getMetaForCurrentUrl(): ?Seotag
    {
        $path = Request::getPathInfo();

        // 1. Exact match
        $meta = Seotag::where('url', $path)->first();
        if ($meta) return $meta;

        // 2. Wildcard prefix match (e.g. "/shop-details/*" covers all product pages)
        $segments = explode('/', trim($path, '/'));
        if (count($segments) > 1) {
            $prefix = '/' . $segments[0] . '/*';
            $meta = Seotag::where('url', $prefix)->first();
            if ($meta) return $meta;
        }

        return null;
    }

    /**
     * Get site-wide default SEO data.
     *
     * @return array<string, mixed>
     */
    public function getDefaultMeta(): array
    {
        // Try to fetch global defaults from the 'metatags' table (managed in Dashboard)
        $globalMeta = \App\Models\Metatag::first();

        return [
            'meta_title'       => $globalMeta->title ?? (config('app.name', 'DARTE') . ' — Premium Apparel & Clothing'),
            'meta_description' => $globalMeta->description ?? 'Discover DARTE — your destination for premium clothing, apparel, and accessories. Quality and timeless style, crafted for you.',
            'meta_keyword'     => $globalMeta->keyword ?? 'DARTE, apparel, premium apparel, fashion wear, trendy clothing, fashion India',
            'og_title'         => $globalMeta->title ?? (config('app.name', 'DARTE') . ' — Premium Apparel'),
            'og_description'   => $globalMeta->description ?? 'Premium apparel & clothing. Shop DARTE for timeless style.',
            'og_image'         => ($globalMeta && $globalMeta->image) 
                                    ? asset('uploads/seo/' . $globalMeta->image) 
                                    : asset('assets/images/logo.webp'),
            'schema_code'      => $this->getOrganizationSchema(),
        ];
    }

    /**
     * Build dynamic SEO meta for a product detail page.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\ProductVarient|null  $variant
     * @return object
     */
    public function buildProductMeta($product, $variant = null): object
    {
        $variant = $variant ?? $product->variants->first();

        // Check if there is an exact or wildcard database meta rule
        $dbMeta = $this->getMetaForCurrentUrl();

        // Default values
        $productName = $product->product_name;
        $categoryName = $product->category->category_name ?? 'Apparel';
        $price = $variant ? ($variant->offer_price ?? $product->product_price) : $product->product_price;
        $descriptionText = strip_tags($product->product_specification ?? $product->product_description ?? '')
            ?: 'Shop ' . $productName . ' at DARTE. Premium quality apparel and clothing.';
        $descriptionText = mb_strimwidth($descriptionText, 0, 160, '...');

        if ($dbMeta) {
            $title = $dbMeta->meta_title;
            $description = $dbMeta->meta_description;
            $keyword = $dbMeta->meta_keyword;

            // Support placeholders
            $placeholders = [
                '{product_name}' => $productName,
                '{category_name}' => $categoryName,
                '{product_price}' => '₹' . $price,
                '{product_description}' => $descriptionText
            ];

            $title = str_replace(array_keys($placeholders), array_values($placeholders), $title);
            $description = str_replace(array_keys($placeholders), array_values($placeholders), $description);
            if ($keyword) {
                $keyword = str_replace(array_keys($placeholders), array_values($placeholders), $keyword);
            }
        } else {
            $title       = $productName . ' — Buy Online | DARTE';
            $description = $descriptionText;
            $keyword     = $productName . ', DARTE apparel, clothing, premium apparel India';
        }

        $image = $variant
            ? env('MAIN_URL') . 'images/' . $variant->varient_img
            : env('MAIN_URL') . 'images/' . $product->product_image;

        $mrpPrice    = $variant ? $variant->mrp_price   : null;
        $sku         = $variant ? $variant->sku         : null;
        $availability = ($variant && $variant->product_qty > 0) ? 'InStock' : 'OutOfStock';

        $schema = json_encode([
            '@context' => 'https://schema.org/',
            '@type'    => 'Product',
            'name'     => $product->product_name,
            'image'    => [$image],
            'description' => $description,
            'sku'      => $sku,
            'brand'    => ['@type' => 'Brand', 'name' => 'DARTE'],
            'offers'   => [
                '@type'         => 'Offer',
                'url'           => url()->current(),
                'priceCurrency' => 'INR',
                'price'         => $price,
                'priceValidUntil' => now()->addMonths(3)->format('Y-m-d'),
                'itemCondition' => 'https://schema.org/NewCondition',
                'availability'  => 'https://schema.org/' . $availability,
                'seller'        => ['@type' => 'Organization', 'name' => 'DARTE'],
            ],
        ]);

        return (object) [
            'meta_title'       => $title,
            'meta_description' => $description,
            'meta_keyword'     => $keyword,
            'og_title'         => $title,
            'og_description'   => $description,
            'og_image'         => $image,
            'schema_code'      => '<script type="application/ld+json">' . $schema . '</script>',
        ];
    }

    /**
     * Build dynamic SEO meta for a blog detail page.
     *
     * @param  \App\Models\Blog  $blog
     * @return object
     */
    public function buildBlogMeta($blog): object
    {
        // Check if there is an exact or wildcard database meta rule
        $dbMeta = $this->getMetaForCurrentUrl();

        // Default values
        $blogTitle = $blog->title ?? $blog->heading ?? 'Blog Post';
        $descriptionText = strip_tags($blog->content ?? $blog->description ?? '');
        $descriptionText = mb_strimwidth($descriptionText, 0, 160, '...');

        if ($dbMeta) {
            $title = $dbMeta->meta_title;
            $description = $dbMeta->meta_description;
            $keyword = $dbMeta->meta_keyword;

            // Support placeholders
            $placeholders = [
                '{blog_title}' => $blogTitle,
                '{blog_description}' => $descriptionText
            ];

            $title = str_replace(array_keys($placeholders), array_values($placeholders), $title);
            $description = str_replace(array_keys($placeholders), array_values($placeholders), $description);
            if ($keyword) {
                $keyword = str_replace(array_keys($placeholders), array_values($placeholders), $keyword);
            }
        } else {
            $title       = $blogTitle . ' | DARTE';
            $description = $descriptionText;
            $keyword     = 'DARTE blog, apparel, fashion tips, style guide';
        }

        $image = !empty($blog->image)
            ? (str_starts_with($blog->image, 'http') ? $blog->image : env('MAIN_URL') . 'images/' . $blog->image)
            : asset('assets/images/logo.webp');

        $schema = json_encode([
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => $blogTitle,
            'image'         => [$image],
            'datePublished' => optional($blog->created_at)->toIso8601String(),
            'dateModified'  => optional($blog->updated_at)->toIso8601String(),
            'author'        => ['@type' => 'Organization', 'name' => 'DARTE'],
            'publisher'     => [
                '@type' => 'Organization',
                'name'  => 'DARTE',
                'logo'  => ['@type' => 'ImageObject', 'url' => asset('assets/images/logo.webp')],
            ],
            'description'   => $description,
        ]);

        return (object) [
            'meta_title'       => $title,
            'meta_description' => $description,
            'meta_keyword'     => $keyword,
            'og_title'         => $title,
            'og_description'   => $description,
            'og_image'         => $image,
            'schema_code'      => '<script type="application/ld+json">' . $schema . '</script>',
        ];
    }

    /**
     * Build dynamic SEO meta for the Shop/Category listing page.
     *
     * @param  \App\Models\Category|null  $activeCategory
     * @return object
     */
    public function buildShopMeta($activeCategory = null): object
    {
        if ($activeCategory) {
            $title       = $activeCategory->category_name . ' — Shop | DARTE';
            $description = 'Browse our ' . $activeCategory->category_name . ' collection at DARTE. Premium apparel crafted for style.';
            $keywords    = $activeCategory->category_name . ', DARTE apparel, clothing, premium ' . strtolower($activeCategory->category_name);
        } else {
            $title       = 'Shop Premium Apparel & Clothing | DARTE';
            $description = 'Explore the full DARTE collection — premium clothing, apparel, and accessories. Free shipping on orders above ₹1999.';
            $keywords    = 'DARTE shop, apparel, buy clothing online, premium apparel India, fashion wear, trendy apparel';
        }

        return (object) [
            'meta_title'       => $title,
            'meta_description' => $description,
            'meta_keyword'     => $keywords,
            'og_title'         => $title,
            'og_description'   => $description,
            'og_image'         => asset('assets/images/logo.webp'),
            'schema_code'      => null,
        ];
    }

    /**
     * Organization JSON-LD schema for site-wide pages.
     */
    private function getOrganizationSchema(): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            'name'     => 'DARTE',
            'url'      => config('app.url'),
            'logo'     => asset('assets/images/logo.webp'),
            'sameAs'   => [],
            'contactPoint' => [
                '@type'       => 'ContactPoint',
                'contactType' => 'customer support',
                'areaServed'  => 'IN',
                'availableLanguage' => 'en',
            ],
        ];

        return '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
