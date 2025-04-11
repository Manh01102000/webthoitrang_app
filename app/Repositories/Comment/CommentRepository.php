<?php
namespace App\Repositories\Comment;

use App\Repositories\Comment\CommentRepositoryInterface;
// MODEL
use App\Models\comment;
use App\Models\comment_emoji;
use App\Models\comment_replie;
use App\Models\content_emojis;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CommentRepository implements CommentRepositoryInterface
{
    public function SubmitEmoji(array $data)
    {
        try {
            $user_id = $data['user_id'];
            $userType = $data['userType'];
            $content_id = $data['content_id'];
            $content_type = $data['content_type'];
            $dataemoji = $data['dataemoji'];
            DB::transaction(function () use ($content_id, $content_type, $dataemoji, $user_id) {
                content_emojis::updateOrCreate(
                    ['user_id' => $user_id, 'content_id' => $content_id, 'content_type' => $content_type],
                    ['emoji' => $dataemoji]
                );
            });
            return [
                'success' => true,
                'message' => "Thả Emoji thành công",
                'httpCode' => 200,
                'data' => null,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi đăng ký tài khoản: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }
    public function SubmitEmojiComment(array $data)
    {
        try {
            $user_id = $data['user_id'];
            $userType = $data['userType'];
            $data_id = $data['data_id'];
            $data_type = $data['data_type'];
            $dataemoji = $data['dataemoji'];
            // Kiểm tra xem đã có bình luận chưa
            $comment = Comment::where('comment_user_id', $user_id)
                ->where('comment_content_id', $data_id)
                ->where('comment_type', $data_type)
                ->first();

            if (!$comment) {
                $comment = Comment::create([
                    'comment_user_id' => $user_id,
                    'comment_content_id' => $data_id,
                    'comment_type' => $data_type,
                    'comment_views' => 1,
                    'createdAt' => time(),
                    'updatedAt' => time(),
                ]);
            }

            DB::transaction(function () use ($comment, $user_id, $dataemoji) {
                $comment_id = $comment->comment_id;

                // Kiểm tra xem user đã thả emoji nào chưa
                $comment_emoji = comment_emoji::where('emoji_comment_user', $user_id)
                    ->where('emoji_comment_id', $comment_id)
                    ->first();

                if ($comment_emoji) {
                    // Nếu user đã thả emoji, cập nhật emoji mới
                    $comment_emoji->where('emoji_comment_id', $comment_id)->update([
                        'emoji_comment_type' => $dataemoji,
                        'emoji_comment_updateAt' => time(),
                    ]);
                } else {
                    // Nếu chưa có, tạo mới
                    comment_emoji::create([
                        'emoji_comment_user' => $user_id,
                        'emoji_comment_id' => $comment_id,
                        'emoji_comment_type' => $dataemoji,
                        'emoji_comment_createAt' => time(),
                        'emoji_comment_updateAt' => time(),
                    ]);
                }
            });

            return [
                'success' => true,
                'message' => "Thả Emoji thành công",
                'httpCode' => 200,
                'data' => null,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi đăng ký tài khoản: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }
    public function AddComment(array $data)
    {
        try {
            $user_id = $data['user_id'];
            $userType = $data['userType'];
            $data_id = $data['data_id'];
            $data_type = $data['data_type'];
            $data_comment_text = $data['data_comment_text'];
            $data_file = $data['data_file'];
            $data_parents_id = $data['data_parents_id'];

            // Xử lý upload file (nếu có)
            $imagePath = null;
            if ($data_file) {
                $originalName = $data_file->getClientOriginalName(); // "doodles-5654738.png"
                $extension = $data_file->getClientOriginalExtension(); // "png"
                $mimeType = $data_file->getClientMimeType(); // "image/png"
                $size = $data_file->getSize(); // Dung lượng file (bytes)
                $tempPath = $data_file->getPathname(); // "C:\xampp\tmp\php2F3F.tmp"
                $imagePath = UploadImageVideoComment($tempPath, $originalName, time(), $extension, 'product');
            }

            // ======= Lưu bình luận vào DB =======
            $comment = DB::transaction(function () use ($data_id, $data_type, $data_comment_text, $imagePath, $data_parents_id, $user_id) {
                return comment::create([
                    'comment_user_id' => $user_id,
                    'comment_parents_id' => $data_parents_id,
                    'comment_content_id' => $data_id,
                    'comment_type' => $data_type, //1:sản phẩm, 2:bài viết
                    'comment_content' => $data_comment_text,
                    'comment_share' => 0,
                    'comment_views' => 1,
                    'comment_image' => $imagePath,
                    'createdAt' => time(),
                    'updatedAt' => time(),
                ]);
            });
            $dataUser = User::where('use_id', $user_id)
                ->select([
                    'use_name',
                    'use_logo',
                    'use_create_time',
                ])
                ->first();

            if ($dataUser) {
                $dataUser->use_logo_full = !empty($dataUser->use_logo)
                    ? geturlimageAvatar($dataUser->use_create_time) . $dataUser->use_logo
                    : '';
            }

            return [
                'success' => true,
                'message' => "Bình luận đã được thêm thành công",
                'httpCode' => 200,
                'data' => [
                    'comment' => $comment,
                    'user' => $dataUser,
                ],
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi đăng ký tài khoản: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }
    public function DeleteComment(array $data)
    {
        try {
            $user_id = $data['user_id'];
            $userType = $data['userType'];
            $commentId = $data['comment_id'];
            // Tìm bình luận theo ID
            $comment = Comment::where('comment_id', $commentId)->first();
            if (!$comment) {
                return [
                    'success' => false,
                    'message' => "Bình luận không tồn tại",
                    'httpCode' => 404,
                    'data' => null,
                ];
            }
            // Kiểm tra xem bình luận có thuộc về user hay không
            if ($comment->comment_user_id != $user_id) {
                return [
                    'success' => false,
                    'message' => "Bạn không có quyền xóa bình luận này",
                    'httpCode' => 403,
                    'data' => null,
                ];
            }
            // Xóa bình luận
            $comment->delete();
            return [
                'success' => true,
                'message' => "Xóa bình luận thành công",
                'httpCode' => 200,
                'data' => null,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi đăng ký tài khoản: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }
    public function LoadMoreComment(array $data)
    {
        try {
            $product_id = $data['product_id'];
            $user_id = $data['user_id'];
            $page = $data['page'];
            $offset = $data['offset'];
            $limit = $data['limit'];
            $parentComments = comment::leftJoin('comment_replies as cr', 'comments.comment_id', '=', 'cr.comment_id')
                ->leftJoin('comment_emojis as ce', 'comments.comment_id', '=', 'ce.emoji_comment_id')
                ->leftJoin('users as us', 'comments.comment_user_id', '=', 'us.use_id')
                ->select(
                    // Dữ liệu comment
                    'comments.comment_id',
                    'comments.comment_parents_id',
                    'comments.comment_user_id',
                    'comments.comment_content_id',
                    'comments.comment_type',
                    'comments.comment_content',
                    'comments.comment_share',
                    'comments.comment_views',
                    'comments.comment_image',
                    'comments.createdAt',
                    'comments.updatedAt',
                    // Dữ liệu người dùng
                    'us.use_name',
                    'us.use_logo',
                    'us.use_create_time',
                    // Dữ liệu admin rep
                    'cr.reply_id',
                    'cr.admin_id',
                    'cr.content as reply_content',
                    'cr.comment_image as reply_image',
                    'cr.created_at as reply_createdAt',
                    'cr.updated_at as reply_updatedAt',
                    // Dữ liệu emoji
                    'ce.emoji_id',
                    'ce.emoji_comment_user',
                    'ce.emoji_comment_type'
                )
                ->where('comments.comment_content_id', $product_id)
                ->where('comments.comment_parents_id', "=", 0)
                ->orderBy('comments.createdAt', 'desc')
                ->limit($limit)
                ->offset($offset)
                ->get();

            if (!$parentComments->isEmpty()) {
                $limitchild = 5;

                $parentIds = $parentComments->pluck('comment_id')->toArray();

                // Lấy danh sách bình luận con
                $childComments = Comment::leftJoin('comment_replies as cr', 'comments.comment_id', '=', 'cr.comment_id')
                    ->leftJoin('comment_emojis as ce', 'comments.comment_id', '=', 'ce.emoji_comment_id')
                    ->leftJoin('users as us', 'comments.comment_user_id', '=', 'us.use_id')
                    ->select(
                        'comments.comment_id',
                        'comments.comment_parents_id',
                        'comments.comment_user_id',
                        'comments.comment_content_id',
                        'comments.comment_type',
                        'comments.comment_content',
                        'comments.comment_share',
                        'comments.comment_views',
                        'comments.comment_image',
                        'comments.createdAt',
                        'comments.updatedAt',
                        'us.use_name',
                        'us.use_logo',
                        'us.use_create_time',
                        'cr.reply_id',
                        'cr.admin_id',
                        'cr.content as reply_content',
                        'cr.comment_image as reply_image',
                        'cr.created_at as reply_createdAt',
                        'cr.updated_at as reply_updatedAt',
                        'ce.emoji_id',
                        'ce.emoji_comment_user',
                        'ce.emoji_comment_type'
                    )
                    ->whereIn('comments.comment_parents_id', $parentIds)
                    ->orderBy('comments.createdAt', 'desc')
                    ->get()
                    ->groupBy('comment_parents_id');

                // 🔥 Chuyển danh sách con thành mảng
                $childComments = $childComments->map(function ($replies) use ($limitchild) {
                    return [
                        'data' => $replies->take($limitchild)->toArray(), // Giới hạn 5 bình luận con
                        'has_more' => $replies->count() > $limitchild // Kiểm tra xem có nhiều hơn 5 bình luận không
                    ];
                })->toArray();

                // Chuyển danh sách cha thành mảng
                $parentComments = $parentComments->toArray();

                // Gắn bình luận con vào bình luận cha
                $parentComments = array_map(function ($parent) use ($childComments) {
                    $parentCommentId = $parent['comment_id'];

                    $parent['children'] = $childComments[$parentCommentId]['data'] ?? [];
                    $parent['has_more'] = $childComments[$parentCommentId]['has_more'] ?? false;

                    return $parent;
                }, $parentComments);
            }

            // Dữ liệu trả về
            return [
                'success' => true,
                'message' => "Lấy danh sách bình luận thành công",
                'httpCode' => 200,
                'data' => [
                    'comments' => (!empty($parentComments)) ? $parentComments : [],
                    'user_id' => $user_id,
                ],
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi đăng ký tài khoản: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }
    public function LoadMoreReplies(array $data)
    {
        try {
            $parentCommentId = $data['parentCommentId'];
            $user_id = $data['user_id'];
            $page = $data['page'];
            $offset = $data['offset'];
            $limit = $data['limit'];
            // Lấy danh sách phản hồi con (giữ nguyên JOIN)
            $childComments = comment::leftJoin('comment_replies as cr', 'comments.comment_id', '=', 'cr.comment_id')
                ->leftJoin('comment_emojis as ce', 'comments.comment_id', '=', 'ce.emoji_comment_id')
                ->leftJoin('users as us', 'comments.comment_user_id', '=', 'us.use_id')
                ->select(
                    'comments.comment_id',
                    'comments.comment_parents_id',
                    'comments.comment_user_id',
                    'comments.comment_content_id',
                    'comments.comment_type',
                    'comments.comment_content',
                    'comments.comment_share',
                    'comments.comment_views',
                    'comments.comment_image',
                    'comments.createdAt',
                    'comments.updatedAt',
                    // Dữ liệu người dùng
                    'us.use_name',
                    'us.use_logo',
                    'us.use_create_time',
                    // Dữ liệu admin rep
                    'cr.reply_id',
                    'cr.admin_id',
                    'cr.content as reply_content',
                    'cr.comment_image as reply_image',
                    'cr.created_at as reply_createdAt',
                    'cr.updated_at as reply_updatedAt',
                    // Dữ liệu emoji
                    'ce.emoji_id',
                    'ce.emoji_comment_user',
                    'ce.emoji_comment_type'
                )
                ->where('comments.comment_parents_id', $parentCommentId)
                ->orderBy('comments.createdAt', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get();

            // Kiểm tra xem còn phản hồi nữa không
            $nextChildExists = comment::where('comment_parents_id', $parentCommentId)
                ->offset($offset + $limit)
                ->limit(1)
                ->exists();
            return [
                'success' => true,
                'message' => "Tải thêm phản hồi thành công",
                'httpCode' => 200,
                'data' => [
                    'comments' => $childComments,
                    'has_more' => $nextChildExists,
                    'user_id' => $user_id,
                ],
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi đăng ký tài khoản: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }

}
