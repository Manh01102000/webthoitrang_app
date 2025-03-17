<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->bigIncrements('reply_id');
            // id comment
            $table->integer('comment_id')->default('0');
            // id admin comment
            $table->string('admin_id')->default('0');
            // Nội dung bình luận
            $table->string('content')->nullable();
            // ảnh comment
            $table->string('comment_image')->nullable();
            // Thời gian trả lời đánh giá
            $table->integer('created_at')->default('0');
            // Cập nhật thời gian trả lời đánh giá
            $table->integer('updated_at')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_replies');
    }
}
