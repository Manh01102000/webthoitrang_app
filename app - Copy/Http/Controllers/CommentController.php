<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// MODEL
use App\Models\comment;
// CommentRepositoryInterface
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentController extends Controller
{
    protected $CommentRepository;
    public function __construct(CommentRepositoryInterface $CommentRepository)
    {
        $this->CommentRepository = $CommentRepository;
    }

    // thả ở trên bình luận
    public function SubmitEmoji(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            $content_id = $request->get('data_id'); // ID sản phẩm hoặc bài viết
            $content_type = $request->get('data_type'); // 1: sản phẩm, 2: bài viết
            $dataemoji = $request->get('dataemoji'); // Emoji thả

            if (empty($content_id) || empty($content_type) || empty($dataemoji)) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }

            $data = [
                'user_id' => $user_id,
                'userType' => $userType,
                'content_id' => $content_id,
                'content_type' => $content_type,
                'dataemoji' => $dataemoji,
            ];
            /** === Lấy dữ liệu từ repository === */
            $response = $this->CommentRepository->SubmitEmoji($data);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }

        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

    // Luồng thả cảm xúc ở phía dưới bình luận
    public function SubmitEmojiComment(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            // ===============Lấy dữ liệu từ font-end=======================
            $data_id = $request->get('data_id');
            $data_type = $request->get('data_type');
            $dataemoji = $request->get('dataemoji');

            if (!$data_id || !$data_type || !$dataemoji) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }

            $data = [
                'user_id' => $user_id,
                'userType' => $userType,
                'data_id' => $data_id,
                'data_type' => $data_type,
                'dataemoji' => $dataemoji,
            ];
            /** === Lấy dữ liệu từ repository === */
            $response = $this->CommentRepository->SubmitEmojiComment($data);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }

        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

    // Luồng thêm bình luận
    public function AddComment(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            // Nhận dữ liệu từ request
            $data_id = $request->get('data_id');
            $data_type = $request->get('data_type'); // 1: sản phẩm, 2: bài viết
            $data_comment_text = $request->get('data_comment_text'); // Nội dung bình luận
            $data_file = $request->file('data_file'); // File ảnh (nếu có)
            $data_parents_id = $request->get('data_parents_id') ?? 0; // ID bình luận cha

            if (empty($data_id) || empty($data_type)) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }
            $data = [
                'user_id' => $user_id,
                'userType' => $userType,
                'data_id' => $data_id,
                'data_type' => $data_type,
                'data_comment_text' => $data_comment_text,
                'data_file' => $data_file,
                'data_parents_id' => $data_parents_id,
            ];
            /** === Lấy dữ liệu từ repository === */
            $response = $this->CommentRepository->AddComment($data);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

    // Luồng thêm bình luận
    public function DeleteComment(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            // Nhận dữ liệu từ request
            $comment_id = $request->get('comment_id', 0);

            if (!$comment_id) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }

            // Tìm bình luận theo ID
            $comment = Comment::where('comment_id', $comment_id)->first();

            if (!$comment) {
                return apiResponse("error", "Bình luận không tồn tại", [], false, 404);
            }

            // Kiểm tra xem bình luận có thuộc về user hay không
            if ($comment->user_id !== $user_id) {
                return apiResponse("error", "Bạn không có quyền xóa bình luận này", [], false, 403);
            }

            // Xóa bình luận
            $comment->delete();

            return apiResponse("success", "Xóa bình luận thành công", [], true, 200);

        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

    // Lấy thêm bình luận
    public function LoadMoreComment(Request $request)
    {
        try {
            // ======= Lấy thông tin người dùng từ cookie & giải mã =======
            $UID_ENCRYPT = $_COOKIE['UID'] ?? null;
            $UT_ENCRYPT = $_COOKIE['UT'] ?? null;
            $user_id = 0;
            if ($UID_ENCRYPT && $UT_ENCRYPT) {
                $key = base64_decode(getenv('KEY_ENCRYPT'));
                $user_id = decryptData($UID_ENCRYPT, $key);
            }

            /** === Lấy thông tin bình luận === */
            $product_id = $request->get('product_id');
            if (!$product_id) {
                return apiResponse("error", "Thiếu product_id", [], false, 400);
            }

            $page = $request->get('page', 1);
            $limit = 10;
            $offset = ($page - 1) * $limit;

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
            return apiResponse("success", "Lấy danh sách bình luận thành công", [
                'comments' => (!empty($parentComments)) ? $parentComments : [],
                'user_id' => $user_id,
            ]);
        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

    //Load thêm bình luận 
    public function LoadMoreReplies(Request $request)
    {
        try {
            // ======= Lấy thông tin người dùng từ cookie & giải mã =======
            $UID_ENCRYPT = $_COOKIE['UID'] ?? null;
            $UT_ENCRYPT = $_COOKIE['UT'] ?? null;
            $user_id = 0;
            if ($UID_ENCRYPT && $UT_ENCRYPT) {
                $key = base64_decode(getenv('KEY_ENCRYPT'));
                $user_id = decryptData($UID_ENCRYPT, $key);
            }
            // ======= END Lấy thông tin người dùng từ cookie & giải mã =======
            $parentCommentId = $request->get('comment_id');
            $page = $request->get('page', 1);
            $limit = 5;
            $offset = ($page - 1) * $limit;

            if (!$parentCommentId) {
                return apiResponse("error", "Thiếu ID bình luận", [], false, 400);
            }

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

            return apiResponse("success", "Tải thêm phản hồi thành công", [
                'comments' => $childComments,
                'has_more' => $nextChildExists,
                'user_id' => $user_id,
            ], true, 200);

        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }
}
