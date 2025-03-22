<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            // Mã đơn hàng
            $table->string('order_code')->nullable();
            // id người mua
            $table->integer('order_user_id')->default('0');
            // Liên kết với bảng affiliates
            $table->foreignId('order_affiliate_id')->references('affiliate_id')->on('affiliates');
            // Số điện thoại người mua
            $table->string('order_user_phone')->nullable();
            // Email người mua
            $table->string('order_user_email')->nullable();
            // địa điểm giao hàng
            $table->string('order_address_ship')->nullable();
            // ghi chú
            $table->text('order_user_note')->nullable();
            // Tổng số tiền sản phẩm
            $table->integer('order_total_price')->default('0');
            // Trạng thái duyệt đơn hàng (1: đơn chờ duyệt, 2: đơn đang hoạt động, 3: đơn hoàn thành, 4: đơn hết hạn, 5: đơn bị hủy)
            $table->integer('order_status')->default('0');
            // 0: chưa gửi admin, 1: admin đã nhận và đang chờ duyệt, 2: admin đã duyệt, 3 admin từ chối
            $table->integer('order_admin_accept')->default('0');
            // Thời gian admin duyệt đơn
            $table->integer('order_admin_accept_time')->default('0');
            // số tiền chuyên viên nhận
            $table->integer('order_money_received')->default('0');
            // Hóa đơn (dạng PDF)
            $table->string('order_bill_pdf')->nullable();
            // Thời gian tạo đơn hàng
            $table->integer('order_create_time')->default('0');
            // Thời gian cập nhật đơn hàng
            $table->integer('order_update_time')->default('0');
            // (1: thanh toán toàn bộ, 2: thanh toán 10%, 3: momo)
            $table->integer('order_paymentMethod')->default('0');
            // Tên ngân hàng
            $table->string('order_name_bank')->nullable();
            // Chi nhánh ngân hàng
            $table->string('order_branch_bank')->nullable();
            // Tài khoản ngân hàng
            $table->string('order_account_bank')->nullable();
            // Chủ sở hữu
            $table->string('order_account_holder')->nullable();
            // Nội dung chuyển khoản
            $table->string('order_content_bank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
}
;
