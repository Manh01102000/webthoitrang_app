<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    public $timestamps = false;
    // 
    protected $primaryKey = 'contact_id';
    protected $fillable = [
        'contact_user_id',
        'contact_user_name',
        'contact_user_phone',
        'contact_description',
        'contact_created_at',
        'contact_updated_at',
    ];
}
