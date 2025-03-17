<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment_replie extends Model
{
    /** @use HasFactory<\Database\Factories\CommentReplieFactory> */
    use HasFactory;
    protected $table = 'comment_replies';
    //
    public $timestamps = false;
    // 
    protected $primaryKey = 'reply_id';
    // 
    protected $fillable = [
        'comment_id',
        'admin_id',
        'content',
        'comment_image',
        'created_at',
        'updated_at',
    ];
}
