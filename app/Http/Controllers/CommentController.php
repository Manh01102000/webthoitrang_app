<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use App\Models\comment;
use App\Models\comment_emoji;
use App\Models\comment_replie;
use App\Models\content_emojis;
use App\Models\User;

class CommentController extends Controller
{

    // thả ở trên bình luận
    public function SubmitEmoji(Request $request)
    {
        try {
            $content_id = $request->get('data_id'); // ID sản phẩm hoặc bài viết
            $content_type = $request->get('data_type'); // 1: sản phẩm, 2: bài viết
            $dataemoji = $request->get('dataemoji'); // Emoji thả

            if (empty($content_id) || empty($content_type) || empty($dataemoji)) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }

            // ======= Lấy thông tin người dùng từ cookie & giải mã =======
            $UID_ENCRYPT = $_COOKIE['UID'] ?? null;
            $UT_ENCRYPT = $_COOKIE['UT'] ?? null;

            if (!$UID_ENCRYPT || !$UT_ENCRYPT) {
                return apiResponse("error", "Không tìm thấy thông tin người dùng", [], false, 401);
            }

            $key = base64_decode(getenv('KEY_ENCRYPT'));
            if (!$key) {
                return apiResponse("error", "Lỗi hệ thống: không thể giải mã dữ liệu", [], false, 500);
            }

            $user_id = decryptData($UID_ENCRYPT, $key);
            $userType = decryptData($UT_ENCRYPT, $key);

            if (!is_numeric($user_id) || !is_numeric($userType)) {
                return apiResponse("error", "Dữ liệu người dùng không hợp lệ", [], false, 401);
            }

            DB::transaction(function () use ($content_id, $content_type, $dataemoji, $user_id) {
                content_emojis::updateOrCreate(
                    ['user_id' => $user_id, 'content_id' => $content_id, 'content_type' => $content_type],
                    ['emoji' => $dataemoji]
                );
            });

            return apiResponse("success", "Thả Emoji thành công", [], true, 200);

        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

    // Luồng thả cảm xúc ở phía dưới bình luận
    public function SubmitEmojiComment(Request $request)
    {
        try {
            $data_id = $request->get('data_id');
            $data_type = $request->get('data_type');
            $dataemoji = $request->get('dataemoji');

            if (!$data_id || !$data_type || !$dataemoji) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }

            // ======= Lấy thông tin người dùng từ cookie & giải mã =======
            $UID_ENCRYPT = $_COOKIE['UID'] ?? null;
            $UT_ENCRYPT = $_COOKIE['UT'] ?? null;

            if (!$UID_ENCRYPT || !$UT_ENCRYPT) {
                return apiResponse("error", "Không tìm thấy thông tin người dùng", [], false, 401);
            }

            $key = base64_decode(getenv('KEY_ENCRYPT'));
            if (!$key) {
                return apiResponse("error", "Lỗi hệ thống: không thể giải mã dữ liệu", [], false, 500);
            }

            $user_id = decryptData($UID_ENCRYPT, $key);
            $userType = decryptData($UT_ENCRYPT, $key);

            if (!is_numeric($user_id) || !is_numeric($userType)) {
                return apiResponse("error", "Dữ liệu người dùng không hợp lệ", [], false, 401);
            }

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

            return apiResponse("success", "Thả Emoji thành công", [], true, 200);

        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

    // Luồng thêm bình luận
    public function AddComment(Request $request)
    {
        try {
            // Nhận dữ liệu từ request
            $data_id = $request->get('data_id');
            $data_type = $request->get('data_type'); // 1: sản phẩm, 2: bài viết
            $data_comment_text = $request->get('data_comment_text'); // Nội dung bình luận
            $data_file = $request->file('data_file'); // File ảnh (nếu có)
            $data_parents_id = $request->get('data_parents_id') ?? 0; // ID bình luận cha

            if (empty($data_id) || empty($data_type)) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }

            // ======= Lấy thông tin người dùng từ cookie & giải mã =======
            $UID_ENCRYPT = $_COOKIE['UID'] ?? null;
            $UT_ENCRYPT = $_COOKIE['UT'] ?? null;

            if (!$UID_ENCRYPT || !$UT_ENCRYPT) {
                return apiResponse("error", "Không tìm thấy thông tin người dùng", [], false, 401);
            }

            $key = base64_decode(getenv('KEY_ENCRYPT'));
            if (!$key) {
                return apiResponse("error", "Lỗi hệ thống: không thể giải mã dữ liệu", [], false, 500);
            }

            $user_id = decryptData($UID_ENCRYPT, $key);
            $userType = decryptData($UT_ENCRYPT, $key);

            if (!is_numeric($user_id) || !is_numeric($userType)) {
                return apiResponse("error", "Dữ liệu người dùng không hợp lệ", [], false, 401);
            }

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

            return apiResponse("success", "Bình luận đã được thêm thành công", [
                'comment' => $comment,
                'user' => $dataUser,
            ], true, 200);


        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

}
