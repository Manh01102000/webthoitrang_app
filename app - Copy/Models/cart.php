<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    protected $table = 'carts'; // Tên bảng trong database
    public $timestamps = false;
    protected $primaryKey = 'cart_id ';
    protected $fillable = [
        'cart_user_id',
        'cart_product_code',
        'cart_product_amount',
        'cart_product_classification',
        'cart_create_time',
        'cart_update_time',
    ]; // Các cột có thể gán dữ liệu hàng loạt
}
