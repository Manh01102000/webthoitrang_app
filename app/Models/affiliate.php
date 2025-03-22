<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affiliate extends Model
{
    use HasFactory;
    protected $table = 'affiliates'; // Tên bảng trong database
    public $timestamps = false;
    protected $primaryKey = 'affiliate_id';
    protected $fillable = [
        'affiliate_user_id',
        'affiliate_code',
        'affiliate_commission_rate',
        'affiliate_total_earnings',
        'affiliate_balance',
        'payment_method',
        'account_name',
        'account_number',
        'bank_name',
        'bank_branch',
        'affiliate_create_time',
        'affiliate_update_time',
    ]; // Các cột có thể gán dữ liệu hàng loạt
}
