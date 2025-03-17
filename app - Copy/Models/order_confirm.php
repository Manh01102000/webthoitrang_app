<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_confirm extends Model
{
    /** @use HasFactory<\Database\Factories\OrderConfirmFactory> */
    use HasFactory;
    protected $table = 'order_confirms'; // Tên bảng trong database
    public $timestamps = false;
    protected $primaryKey = 'order_confirm_id';
    protected $fillable = [
        'conf_code_order',
        'conf_cart_id',
        'conf_user_id',
        'conf_product_code',
        'conf_product_amount',
        'conf_product_classification',
        'conf_total_price',
        'conf_unitprice',
        'conf_feeship',
        'conf_create_time',
        'conf_update_time',
    ]; // Các cột có thể gán dữ liệu hàng loạt
}
