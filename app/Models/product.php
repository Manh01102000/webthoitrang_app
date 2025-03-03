<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory; // kích hoạt factory cho model
    protected $table = 'products';
    public $timestamps = false;
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_code',
        'product_admin_id',
        'product_name',
        'product_active',
        'product_description',
        'product_unit',
        'category',
        'category_code',
        'category_children_code',
        'product_brand',
        'product_price',
        'product_sizes',
        'product_stock',
        'product_classification',
        'product_colors',
        'product_code_colors',
        'product_images',
        'product_videos',
        'product_ship',
        'product_feeship',
        'product_sold',
        'product_create_time',
        'product_update_time',
    ];
}
