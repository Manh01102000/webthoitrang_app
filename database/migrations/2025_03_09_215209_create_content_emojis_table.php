<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentEmojisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('content_emojis', function (Blueprint $table) {
            $table->bigIncrements('id');
            // id user
            $table->integer('user_id')->default('0');
            // id comment
            $table->integer('content_id')->default('0');
              // 1 là sản phẩm, 2:tin tức
              $table->integer('content_type')->default('0');
            // 1:like, 2:yêu thích, 3:Haha, 4:Wow, 5: Buồn, 6:Phẫn nộ
            $table->integer('emoji')->default('0');
            // Thời gian gửi emoji
            $table->integer('create_time')->default('0');
            // Thời gian cập gửi emoji
            $table->integer('update_time')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_emojis');
    }
}
;
