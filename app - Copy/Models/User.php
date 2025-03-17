<?php

namespace App\Models;

// HasFactory	    Hỗ trợ tạo dữ liệu giả bằng Factory.
// Authenticatable	Cho phép Model User hoạt động với hệ thống đăng nhập Laravel.
// Notifiable	    Cho phép Model User nhận thông báo qua email, Slack, hoặc database.

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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
        'password',
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

    // Ẩn các trường nhạy cảm (không cho vào JWT)
    protected $hidden = ['use_pass', 'use_otp', 'use_ip_address'];
    // 🔹 Bổ sung 2 phương thức để sử dụng JWT
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Sử dụng ID user làm JWT identifier
    }
    public function getJWTCustomClaims()
    {
        return []; // Có thể thêm claims tùy chỉnh nếu cần
    }
}
