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
        Schema::create('coupon_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique();
            $table->integer('discount_percentage_price');
            $table->string('coupon_type');
            $table->unsignedInteger('min_cart_value')->nullable();
            $table->unsignedInteger('max_uses')->nullable();
            $table->unsignedInteger('coupon_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('description');
            $table->timestamp('start_date');
            $table->timestamp('expiry_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupan_discounts');
    }
};
