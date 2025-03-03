<?php

namespace App\Models;

// HasFactory	    Hỗ trợ tạo dữ liệu giả bằng Factory.
// Authenticatable	Cho phép Model User hoạt động với hệ thống đăng nhập Laravel.
// Notifiable	    Cho phép Model User nhận thông báo qua email, Slack, hoặc database.

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users'; // Tên bảng trong database
    public $timestamps = false;
    protected $primaryKey = 'use_id';

    protected $fillable = [
        'use_name',
        'use_role',
        'use_phone_account',
        'use_phone',
        'use_email_account',
        'use_email_contact',
        'use_pass',
        'use_authentic',
        'use_otp',
        'is_login',
        'last_login',
        'use_city',
        'use_district',
        'address',
        'use_logo',
        'birthday',
        'gender',
        'use_honnhan',
        'use_view_count',
        'use_create_time',
        'use_update_time',
        'use_show',
        'use_ip_address',
        'use_lat',
        'use_long',
    ]; // Các cột có thể gán dữ liệu hàng loạt

}
