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
            $data = [
                'user_id' => $user_id,
                'userType' => $userType,
                'comment_id' => $comment_id,
            ];
            /** === Lấy dữ liệu từ repository === */
            $response = $this->CommentRepository->DeleteComment($data);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }

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
            $data = [
                'product_id' => $product_id,
                'user_id' => $user_id,
                'page' => $page,
                'offset' => $offset,
                'limit' => $limit,
            ];
            /** === Lấy dữ liệu từ repository === */
            $response = $this->CommentRepository->LoadMoreComment($data);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
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
            $data = [
                'parentCommentId' => $parentCommentId,
                'user_id' => $user_id,
                'page' => $page,
                'offset' => $offset,
                'limit' => $limit,
            ];
            /** === Lấy dữ liệu từ repository === */
            $response = $this->CommentRepository->LoadMoreReplies($data);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }
}
