<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manage_discount extends Model
{
    /** @use HasFactory<\Database\Factories\ManageDiscountFactory> */
    use HasFactory;
    protected $table = 'manage_discounts';
    public $timestamps = false;
    protected $primaryKey = 'discount_id';
    protected $fillable = [
        'discount_admin_id',
        'discount_product_code',
        'discount_name',
        'discount_description',
        'discount_active',
        'discount_type',
        'discount_price',
        'discount_start_time',
        'discount_end_time',
        'discount_create_time',
        'discount_update_time',
    ];
}
