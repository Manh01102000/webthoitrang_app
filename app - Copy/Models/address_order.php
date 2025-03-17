<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address_order extends Model
{
    /** @use HasFactory<\Database\Factories\AddressOrderFactory> */
    use HasFactory;
    protected $table = 'address_orders';
    public $timestamps = false;
    protected $primaryKey = 'address_orders_id';
    protected $fillable = [
        'address_orders_user_id',
        'address_orders_user_name',
        'address_orders_user_phone',
        'address_orders_user_email',
        'address_orders_city',
        'address_orders_district',
        'address_orders_commune',
        'address_orders_detail',
        'address_orders_default',
        'address_orders_created_at',
        'address_orders_updated_at',
    ];
}
