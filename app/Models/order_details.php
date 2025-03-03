<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDetailFactory> */
    use HasFactory;

    protected $table = 'order_details'; // Tên bảng trong database
    public $timestamps = false;
    protected $primaryKey = 'ordetail_id';
    protected $fillable = [
        'ordetail_order_code',
        'ordetail_product_code',
        'ordetail_product_amount',
        'ordetail_product_classification',
        'ordetail_product_totalprice',
        'ordetail_product_unitprice',
        'ordetail_product_feeship',
        'ordetail_created_at',
        'ordetail_updated_at',
    ];
}
