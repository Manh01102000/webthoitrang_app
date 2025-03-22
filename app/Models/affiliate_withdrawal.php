<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affiliate_withdrawal extends Model
{
    use HasFactory;
    protected $table = 'affiliate_withdrawals'; // Tên bảng trong database
    public $timestamps = false;
    protected $primaryKey = 'withdrawal_id';
    protected $fillable = [
        'affiliate_id',
        'withdrawal_amount',
        'withdrawal_status',
        'withdrawal_method',
        'withdrawal_account',
        'withdrawal_account_name',
        'withdrawal_requested_at',
        'withdrawal_processed_at',
        'withdrawal_create_time',
        'withdrawal_update_time',
    ]; // Các cột có thể gán dữ liệu hàng loạt
}
