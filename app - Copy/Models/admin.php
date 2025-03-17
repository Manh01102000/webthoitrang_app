<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'admin';
    public $timestamps = false;
    protected $primaryKey = 'admin_id';

    protected $hidden = ['password']; // Đổi từ 'admin_pass' thành 'password'

    protected $fillable = [
        'admin_name',
        'admin_type',
        'admin_account',
        'admin_phone',
        'password', // Đổi từ 'admin_pass' thành 'password'
        'admin_city',
        'admin_district',
        'address',
        'admin_logo',
        'birthday',
        'gender',
        'admin_honnhan',
        'admin_create_time',
        'admin_update_time',
        'admin_show',
        'admin_ip_address',
        'admin_lat',
        'admin_long',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->password; // Laravel sẽ dùng cột password thay vì admin_pass
    }
}
