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
        Schema::create('affiliate_contracts', function (Blueprint $table) {
            $table->bigIncrements('contracts_id');
            // Liên kết với bảng affiliates
            $table->foreignId('contract_affiliate_id')->references('affiliate_id')->on('affiliates');
            $table->string('contract_company_name')->nullable(); // Tên công ty
            $table->string('contract_partner_name')->nullable(); // Tên đối tác
            $table->string('company_sign_name')->nullable(); // Tên công ty ký
            $table->string('partner_sign_name')->nullable(); // Tên đối tác ký
            $table->integer('company_sign_date')->nullable(); // Ngày company ký
            $table->integer('partner_sign_date')->nullable(); // Ngày đối tác dùng ký
            $table->integer('contract_payment_date')->nullable(); // Thời gian thanh toán
            $table->string('contract_payment_method')->nullable(); // Phương thức thanh toán
            $table->string('contract_payment_minimum')->nullable(); // Số tiền thanh toán tối thiểu
            $table->integer('terminate_date_min')->nullable(); // Ngày tối thiểu chấm dứt hợp đồng
            $table->integer('contract_terminate_date')->nullable(); // Ngày chấm dứt hợp đồng
            $table->text('contract_details')->nullable(); // Có thể lưu nội dung hợp đồng
            // Thời gian tạo
            $table->integer('contract_create_time')->default('0');
            // Thời gian cập nhật
            $table->integer('contract_update_time')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_contracts');
    }
};
