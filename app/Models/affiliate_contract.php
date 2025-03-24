<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affiliate_contract extends Model
{
    use HasFactory;
    protected $table = 'affiliate_contracts'; // Tên bảng trong database
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'contract_affiliate_id',
        'contract_company_name',
        'contract_partner_name',
        'company_sign_name',
        'partner_sign_name',
        'company_sign_date',
        'partner_sign_date',
        'contract_payment_date',
        'contract_payment_method',
        'contract_payment_minimum',
        'terminate_date_min',
        'contract_create_time',
        'contract_update_time',
    ]; // Các cột có thể gán dữ liệu hàng loạt
}
