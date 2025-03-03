<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;
    protected $table = 'admin';
    public $timestamps = false;
    protected $primaryKey = 'admin_id';
    protected $fillable = [
        'admin_name',
        'admin_type',
        'admin_account',
        'admin_phone',
        'admin_pass',
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
}
