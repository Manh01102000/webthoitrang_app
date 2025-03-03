<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('use_id');
            // Tên user
            $table->string('use_name')->nullable();
            // Quyền truy cập
            $table->integer('use_role')->default('0');
            // Email tài khoản
            $table->string('use_email_account')->nullable();
            // Số điện thoại tài khoản (nếu có)
            $table->string('use_phone_account')->nullable();
            // Số điện thoại liên hệ
            $table->string('use_phone')->nullable();
            // Email liên hệ
            $table->string('use_email_contact')->nullable();
            // Mật khẩu tài khoản
            $table->string('use_pass')->nullable();
            // Tài khoản xác thực
            $table->integer('use_authentic')->default('0');
            // Mã OTP
            $table->integer('use_otp')->default('0');
            // Đăng nhập
            $table->integer('is_login')->default('0');
            // Thời gian đăng nhập
            $table->integer('last_login')->default('0');
            // Tỉnh thành 
            $table->integer('use_city')->default('0');
            // Quận huyện
            $table->integer('use_district')->default('0');
            // Địa chỉ
            $table->string('address')->nullable();
            // Ảnh đại diện
            $table->string('use_logo')->nullable();
            // Ngày sinh
            $table->integer('birthday')->default('0');
            // Giới tính
            $table->integer('gender')->default('0');
            // Hôn nhân
            $table->integer('use_honnhan')->default('0');
            // Lượt xem tài khoản
            $table->integer('use_view_count')->default('0');
            // Thời gian tạo tài khoản
            $table->integer('use_create_time')->default('0');
            // Cập nhật thời gian tài khoản
            $table->integer('use_update_time')->default('0');
            // Đánh dấu ẩn hiện tài khoản
            $table->integer('use_show')->default('0');
            // Địa chỉ IP
            $table->integer('use_ip_address')->default('0');
            // Lat
            $table->string('use_lat')->nullable();
            // Long
            $table->string('use_long')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
