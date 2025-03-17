<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class city extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;

    protected $table = 'city';
    //
    public $timestamps = false;
    // 
    protected $primaryKey = 'city_id';
    // 
    protected $fillable = [
        'cit_name',
        'cit_alias',
        'cit_code',
        'cit_order',
        'city_created_at',
        'city_updated_at',
    ];
}
