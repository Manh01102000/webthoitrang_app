<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('review_id');
            // id người đánh giá
            $table->integer('review_user_id')->default('0');
            // id sản phẩm đánh giá
            $table->integer('review_product_id')->default('0');
            // số sao đánh giá (1-5)
            $table->integer('review_product_rating')->default('0');
            // thời gian đánh giá
            $table->integer('review_created_at')->default('0');
            // cập nhật thời gian đánh giá
            $table->integer('review_updated_at')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
