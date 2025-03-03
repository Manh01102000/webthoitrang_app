<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('manage_discounts', function (Blueprint $table) {
            $table->bigIncrements('discount_id');
            // id admin nhập mã giảm giá
            $table->integer('discount_admin_id')->default('0');
            // mã sản phẩm
            $table->string('discount_product_code')->nullable();
            // Tên chương trình giảm giá
            $table->string('discount_name')->nullable();
            // Mô tả chương trình giảm giá
            $table->text('discount_description')->nullable();
            // 1: hiển thị / 0: ẩn loại giảm giá
            $table->integer('discount_active')->default('0');
            // loại giảm giá 1:giảm %, 2: giảm tiền mặt
            $table->integer('discount_type')->default('0');
            // Giá giảm
            $table->text('discount_price')->nullable();
            // Ngày bắt đầu áp dụng
            $table->integer('discount_start_time')->default('0');
            // Ngày kết thúc áp dụng
            $table->integer('discount_end_time')->default('0');
            // Ngày tạo
            $table->integer('discount_create_time')->default('0');
            // Ngày cập nhật
            $table->integer('discount_update_time')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_discounts');
    }
}
;
