<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    protected $table = 'comments';
    //
    public $timestamps = false;
    // 
    protected $primaryKey = 'comment_id';
    // 
    protected $fillable = [
        'comment_user_id',
        'comment_parents_id',
        'comment_content_id',
        'comment_type',
        'comment_content',
        'comment_share',
        'comment_views',
        'comment_image',
        'createdAt',
        'updatedAt',
    ];
}
