<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Option A: Add product_image to product_order_items (web's own table)
        Schema::table('product_order_items', function (Blueprint $table) {
            $table->string('product_image')->nullable()->after('product_name');
        });

        // Option B: Add product_image to product_slots (dash/admin system table)
        Schema::table('product_slots', function (Blueprint $table) {
            $table->string('product_image')->nullable()->after('product_name');
        });
    }

    public function down(): void
    {
        Schema::table('product_order_items', function (Blueprint $table) {
            $table->dropColumn('product_image');
        });

        Schema::table('product_slots', function (Blueprint $table) {
            $table->dropColumn('product_image');
        });
    }
};
