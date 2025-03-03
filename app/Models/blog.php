<?php

namespace App\Models;

// HasFactory	    Hỗ trợ tạo dữ liệu giả bằng Factory.
// Authenticatable	Cho phép Model User hoạt động với hệ thống đăng nhập Laravel.
// Notifiable	    Cho phép Model User nhận thông báo qua email, Slack, hoặc database.

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class blog extends Authenticatable
{
    use HasFactory;

    protected $table = 'blog'; // Tên bảng trong database
    public $timestamps = false;
    protected $primaryKey = 'blog_id';
    protected $fillable = [
        'blog_admin_id',
        'blog_meta_h1',
        'blog_title',
        'blog_cate',
        'blog_content',
        'blog_meta_title',
        'blog_meta_description',
        'blog_meta_keyword',
        'blog_tags',
        'blog_create_time',
        'blog_update_time',
    ]; // Các cột có thể gán dữ liệu hàng loạt

}
