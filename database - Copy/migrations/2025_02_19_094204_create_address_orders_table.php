<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('address_orders', function (Blueprint $table) {
            $table->bigIncrements('address_orders_id');
            // id người liên hệ
            $table->integer('address_orders_user_id')->default('0');
            // tên người liên hệ
            $table->string('address_orders_user_name')->nullable();
            // số điện thoại người liên hệ
            $table->string('address_orders_user_phone')->nullable();
             // email người liên hệ
             $table->string('address_orders_user_email')->nullable();
            // tỉnh/thành phố
            $table->integer('address_orders_city')->default('0');
            // Quận/huyện
            $table->integer('address_orders_district')->default('0');
            // Xã/huyện
            $table->integer('address_orders_commune')->default('0');
            // địa chỉ chi tiết
            $table->string('address_orders_detail')->nullable();
            // đặt làm mặc định
            $table->integer('address_orders_default')->default('0');
            // thời gian liên hệ
            $table->integer('address_orders_created_at')->default('0');
            // cập nhật thời gian liên hệ
            $table->integer('address_orders_updated_at')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_orders');
    }
}
;
