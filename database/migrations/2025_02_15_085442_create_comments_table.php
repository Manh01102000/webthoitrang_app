<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('comment_id');
            // id người đánh giá
            $table->integer('comment_user_id');
            // id sản phẩm đánh giá
            $table->string('comment_product_id');
            // Nội dung bình luận
            $table->string('comment_content')->nullable();
            // ảnh comment
            $table->string('comment_image')->nullable();
            // Thời gian đánh giá
            $table->integer('createdAt')->default('0');
            // Cập nhật thời gian đánh giá
            $table->integer('updatedAt')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
}
;
