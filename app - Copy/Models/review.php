<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;
    protected $table = 'reviews';
    public $timestamps = false;
    protected $primaryKey = 'review_id';
    protected $fillable = [
        'review_user_id',
        'review_product_id',
        'review_product_rating',
        'review_created_at',
        'review_updated_at',
    ];
}
