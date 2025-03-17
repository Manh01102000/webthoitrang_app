<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class content_emojis extends Model
{
    /** @use HasFactory<\Database\Factories\ContentEmojisFactory> */
    use HasFactory;
    protected $table = 'content_emojis';
    //
    public $timestamps = false;
    // 
    protected $primaryKey = 'id';
    // 
    protected $fillable = [
        'user_id',
        'content_id',
        'content_type',
        'emoji',
        'create_time',
        'update_time',
    ];
}
