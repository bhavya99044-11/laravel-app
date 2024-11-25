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
        Schema::table('product_reviews', function (Blueprint $table) {
          $table->foreignId('product_review_id')->references('id')->on('product_reviews')->index('product_reviews_product_review_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            $table->dropIndex('product_reviews_product_review_id');
            $table->dropForeign(['product_review_id']);
            $table->dropColumn('product_review_id');
        });
    }
};
