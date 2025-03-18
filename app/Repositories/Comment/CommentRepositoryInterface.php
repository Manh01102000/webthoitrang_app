<?php
namespace App\Repositories\Comment;

interface CommentRepositoryInterface
{

    public function SubmitEmoji(array $data);
    public function SubmitEmojiComment(array $data);
    public function AddComment(array $data);
    public function DeleteComment(array $data);
    public function LoadMoreComment(array $data);
    public function LoadMoreReplies(array $data);
}
