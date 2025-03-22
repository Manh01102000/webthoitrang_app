<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affiliate_commission extends Model
{
    use HasFactory;
    protected $table = 'affiliate_commissions'; // Tên bảng trong database
    public $timestamps = false;
    protected $primaryKey = 'commission_id';
    protected $fillable = [
        'commission_affiliate_id',
        'commission_order_id',
        'commission_product_id',
        'commission_amount',
        'commission_create_time',
        'commission_update_time',
    ]; // Các cột có thể gán dữ liệu hàng loạt
}
