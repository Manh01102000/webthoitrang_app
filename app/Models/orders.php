<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $table = 'orders'; // Tên bảng trong database
    public $timestamps = false;
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'order_code',
        'order_user_id',
        'order_user_phone',
        'order_user_email',
        'order_address_ship',
        'order_total_price',
        'order_status',
        'order_admin_accept',
        'order_admin_accept_time',
        'order_money_received',
        'order_bill_pdf',
        'order_create_time',
        'order_update_time',
        'order_paymentMethod',
        'order_name_bank',
        'order_account_bank',
        'order_account_holder',
        'order_content_bank',
    ]; // Các cột có thể gán dữ liệu hàng loạt
}
