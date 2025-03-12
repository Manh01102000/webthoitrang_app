<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCommentEmojisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comment_emojis', function (Blueprint $table) {
            $table->bigIncrements('emoji_id');
            // id user
            $table->integer('emoji_user_id')->default('0');
            // id comment
            $table->integer('emoji_comment_id')->default('0');
            // 1:like, 2:yêu thích, 3:Haha, 4:Wow, 5: Buồn, 6:Phẫn nộ
            $table->integer('emoji_comment_type')->default('0');
            // Thời gian gửi emoji
            $table->integer('emoji_create_time')->default('0');
            // Thời gian cập gửi emoji
            $table->integer('emoji_update_time')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_emojis');
    }
}
;
