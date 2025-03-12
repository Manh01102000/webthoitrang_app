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
            // id bình luận cha
            $table->integer('comment_parents_id')->default('0');
            // id người đánh giá
            $table->integer('comment_user_id')->default('0');
            // id sản phẩm đánh giá
            $table->integer('comment_content_id')->default('0');
            // 1: bình luận sản phẩm, 2: bình luận bài viết
            $table->integer('comment_type')->default('0');
            // Nội dung bình luận
            $table->string('comment_content')->nullable();
            // ảnh comment
            $table->string('comment_image')->nullable();
            // 1: facebook, 2: zalo, 3:mess, 4 sao chép lk
            $table->integer('comment_share')->default('0');
            // lượt xem
            $table->integer('comment_views')->default('0');
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
