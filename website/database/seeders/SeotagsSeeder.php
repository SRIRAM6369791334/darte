<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeotagsSeeder extends Seeder
{
    /**
     * Seed the seotags table with static-page SEO data for DARTE.
     *
     * URL Convention:
     *   - Exact page  → '/about'
     *   - Wildcard    → '/shop-details/*'  (matches all product pages)
     */
    public function run(): void
    {
        $now = now();

        $orgSchema = json_encode([
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            'name'     => 'DARTE',
            'url'      => config('app.url'),
            'logo'     => asset('assets/images/logo.webp'),
            'sameAs'   => [],
        ]);

        $websiteSchema = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            'url'             => config('app.url'),
            'name'            => 'DARTE',
            'description'     => 'Premium Leather Bags & Accessories',
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => config('app.url') . '/shop?dzSearch={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ]);

        $pages = [
            // ── Homepage ────────────────────────────────────────────────
            [
                'url'              => '/',
                'meta_title'       => 'DARTE — Premium Leather Bags & Accessories | Shop Online India',
                'meta_keyword'     => 'DARTE, premium leather bags, leather backpacks, leather totes, leather accessories India, buy leather bags online',
                'meta_description' => 'Shop DARTE\'s premium collection of handcrafted leather bags, backpacks, and accessories. Free shipping above ₹1999. Crafted for style and durability.',
                'og_title'         => 'DARTE — Premium Leather Bags & Accessories',
                'og_description'   => 'Discover DARTE — handcrafted leather bags & accessories for the modern individual. Shop our latest collection.',
                'og_image'         => asset('assets/images/logo.webp'),
                'schema_code'      => '<script type="application/ld+json">' . $orgSchema . '</script><script type="application/ld+json">' . $websiteSchema . '</script>',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            // ── Shop (All Products) ─────────────────────────────────────
            [
                'url'              => '/shop',
                'meta_title'       => 'Shop Leather Bags & Accessories | DARTE',
                'meta_keyword'     => 'leather bags shop, buy leather bags, premium leather accessories, DARTE shop, leather backpacks, leather wallets India',
                'meta_description' => 'Browse DARTE\'s full collection of premium leather bags, backpacks, totes & accessories. Filter by category, size & price. Free shipping above ₹1999.',
                'og_title'         => 'Shop Premium Leather Bags | DARTE',
                'og_description'   => 'Explore our complete leather collection. Premium quality, timeless design.',
                'og_image'         => asset('assets/images/logo.webp'),
                'schema_code'      => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            // ── Product Detail Pages (wildcard) ─────────────────────────
            [
                'url'              => '/shop-details/*',
                'meta_title'       => 'Buy Premium Leather Bag | DARTE',
                'meta_keyword'     => 'leather bag, premium leather, buy online India, DARTE products',
                'meta_description' => 'Shop this premium leather product from DARTE. Handcrafted quality, timeless style. Free shipping on orders above ₹1999.',
                'og_title'         => 'Premium Leather Products | DARTE',
                'og_description'   => 'Premium handcrafted leather products from DARTE.',
                'og_image'         => asset('assets/images/logo.webp'),
                'schema_code'      => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            // ── About ───────────────────────────────────────────────────
            [
                'url'              => '/about',
                'meta_title'       => 'About DARTE — Our Story & Craftsmanship',
                'meta_keyword'     => 'about DARTE, leather bag brand India, DARTE story, handcrafted leather brand',
                'meta_description' => 'Discover the DARTE story — a brand built on the love of fine leather craftsmanship. Learn about our values, artisans, and commitment to quality.',
                'og_title'         => 'About DARTE — Craftsmanship & Heritage',
                'og_description'   => 'Learn about DARTE and our commitment to premium leather craftsmanship.',
                'og_image'         => asset('assets/images/logo.webp'),
                'schema_code'      => '<script type="application/ld+json">' . json_encode([
                    '@context' => 'https://schema.org',
                    '@type'    => 'AboutPage',
                    'name'     => 'About DARTE',
                    'url'      => config('app.url') . '/about',
                ]) . '</script>',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            // ── Contact ─────────────────────────────────────────────────
            [
                'url'              => '/contact',
                'meta_title'       => 'Contact DARTE — Get in Touch | Customer Support',
                'meta_keyword'     => 'contact DARTE, customer support, leather bag support India, DARTE contact',
                'meta_description' => 'Reach out to DARTE for product queries, order support, or partnerships. Our team is happy to help you with any questions.',
                'og_title'         => 'Contact DARTE — Customer Support',
                'og_description'   => 'Get in touch with the DARTE team for queries, support, or partnership enquiries.',
                'og_image'         => asset('assets/images/logo.webp'),
                'schema_code'      => '<script type="application/ld+json">' . json_encode([
                    '@context' => 'https://schema.org',
                    '@type'    => 'ContactPage',
                    'name'     => 'Contact DARTE',
                    'url'      => config('app.url') . '/contact',
                ]) . '</script>',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            // ── Blog Listing ─────────────────────────────────────────────
            [
                'url'              => '/blog',
                'meta_title'       => 'Leather Care & Style Tips — DARTE Blog',
                'meta_keyword'     => 'DARTE blog, leather care tips, fashion tips, style guide, leather bag maintenance',
                'meta_description' => 'Explore the DARTE blog for leather care guides, style tips, and fashion inspiration. Stay informed about trends in premium leather accessories.',
                'og_title'         => 'DARTE Blog — Style, Care & Trends',
                'og_description'   => 'Fashion tips, leather care guides, and style inspiration from DARTE.',
                'og_image'         => asset('assets/images/logo.webp'),
                'schema_code'      => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            // ── Privacy Policy ───────────────────────────────────────────
            [
                'url'              => '/privacy-policy',
                'meta_title'       => 'Privacy Policy | DARTE',
                'meta_keyword'     => 'DARTE privacy policy, data privacy, user data protection',
                'meta_description' => 'Read DARTE\'s privacy policy to understand how we collect, use, and protect your personal data.',
                'og_title'         => 'Privacy Policy | DARTE',
                'og_description'   => 'DARTE privacy policy — how we handle your personal information.',
                'og_image'         => asset('assets/images/logo.webp'),
                'schema_code'      => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            // ── Terms & Conditions ───────────────────────────────────────
            [
                'url'              => '/terms-conditions',
                'meta_title'       => 'Terms & Conditions | DARTE',
                'meta_keyword'     => 'DARTE terms conditions, purchase terms, website terms',
                'meta_description' => 'Review DARTE\'s terms and conditions governing the use of our website and purchase of our products.',
                'og_title'         => 'Terms & Conditions | DARTE',
                'og_description'   => 'DARTE terms and conditions for website use and purchases.',
                'og_image'         => asset('assets/images/logo.webp'),
                'schema_code'      => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            // ── Shipping & Refund Policy ─────────────────────────────────
            [
                'url'              => '/shipping-refund-policy',
                'meta_title'       => 'Shipping & Refund Policy | DARTE',
                'meta_keyword'     => 'DARTE shipping policy, refund policy, return policy leather bags',
                'meta_description' => 'Understand DARTE\'s shipping timelines, delivery charges, and our hassle-free return and refund policy for all orders.',
                'og_title'         => 'Shipping & Refund Policy | DARTE',
                'og_description'   => 'DARTE shipping, delivery, and refund policy explained.',
                'og_image'         => asset('assets/images/logo.webp'),
                'schema_code'      => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];

        // Use upsert: insert or update on url conflict
        DB::table('seotags')->upsert($pages, ['url'], [
            'meta_title', 'meta_keyword', 'meta_description',
            'og_title', 'og_description', 'og_image', 'schema_code', 'updated_at',
        ]);

        $this->command->info('✅ Seotags seeded: ' . count($pages) . ' records (upserted).');

        // --- 2. Seed General Site Meta Tags (Site-wide Defaults) ---
        $existingMeta = DB::table('metatags')->first();
        if (!$existingMeta) {
            DB::table('metatags')->insert([
                'title'       => 'DARTE — Premium Handcrafted Leather Bags & Accessories',
                'description' => 'Experience the finest handcrafted leather bags and accessories from DARTE. Timeless designs, sustainable quality, and premium craftsmanship.',
                'keyword'     => 'DARTE, leather bags, backpacks, accessories, premium fashion, handcrafted leather',
                'alttag'      => 'DARTE Premium Leather Products',
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
            $this->command->info('✅ Global Metatags seeded (default site-wide meta).');
        }
    }
}
