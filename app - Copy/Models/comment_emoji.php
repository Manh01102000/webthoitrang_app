<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment_emoji extends Model
{
    /** @use HasFactory<\Database\Factories\CommentEmojiFactory> */
    use HasFactory;
    protected $table = 'comment_emojis';
    //
    public $timestamps = false;
    // 
    protected $primaryKey = 'emoji_id';
    // 
    protected $fillable = [
        'emoji_comment_user',
        'emoji_comment_id',
        'emoji_comment_type',
        'emoji_comment_createAt',
        'emoji_comment_updateAt',
    ];
}
