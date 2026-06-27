<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Billing details
            $table->string('billing_name')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_door_no')->nullable();
            $table->string('billing_street')->nullable();
            $table->string('billing_area')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_pincode')->nullable();

            // Shipping details
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_door_no')->nullable();
            $table->string('shipping_street')->nullable();
            $table->string('shipping_area')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_pincode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'billing_name', 'billing_phone', 'billing_door_no', 'billing_street', 'billing_area', 'billing_city', 'billing_state', 'billing_pincode',
                'shipping_name', 'shipping_phone', 'shipping_door_no', 'shipping_street', 'shipping_area', 'shipping_city', 'shipping_state', 'shipping_pincode'
            ]);
        });
    }
};
