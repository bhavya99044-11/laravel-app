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
        Schema::table('product_carts', function (Blueprint $table) {
            if(Schema::hasColumn('product_carts', 'color_id')) {

                $table->dropColumn('color_id','size_id');

            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_carts', function (Blueprint $table) {
            //
        });
    }
};
