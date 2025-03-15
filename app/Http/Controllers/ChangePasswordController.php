<?php

namespace App\Http\Controllers;
// Imports
use Illuminate\Http\Request;
// Model
use App\Models\User;
// JWT
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class ChangePasswordController extends Controller
{
    public function index()
    {
        /** === Khai báo thư viện sử dụng === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];

        /** === Xây dựng SEO === */
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Đổi Mật Khẩu Tài Khoản - Fashion Houses",
            'seo_desc' => "Bảo mật tài khoản của bạn tại Fashion Houses bằng cách đổi mật khẩu an toàn. Cập nhật mật khẩu mới để đảm bảo an toàn khi mua sắm trực tuyến.",
            'seo_keyword' => "Fashion Houses đổi mật khẩu, cập nhật mật khẩu, bảo mật tài khoản, đổi mật khẩu an toàn, tài khoản thời trang, bảo vệ thông tin, bảo mật mua sắm trực tuyến.",
            'canonical' => $domain . '/quan-ly-tai-khoan',
        ];

        /** === Lấy dữ liệu tài khoản === */
        $data = InForAccount();

        /** === Lấy dữ liệu danh mục theo từng cấp === */
        $categoryTree = getCategoryTree();

        /** === Xây dựng breadcrumb === */
        $breadcrumbItems = [
            ['title' => 'Trang chủ', 'url' => '/', 'class' => 'otherssite'],
            [
                'title' => "Thay đổi mật khẩu",
                'url' => '',
                'class' => 'thissite'
            ]
        ];

        /** === Chuẩn bị dữ liệu cho dataAll === */
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'breadcrumbItems' => $breadcrumbItems,
        ];

        /** === Trả về view với dữ liệu === */
        return view('change_password', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

    public function check_password_old(Request $request)
    {
        $data_mess = [
            'result' => false,
            'data' => '',
            'message' => "Thiếu dữ liệu truyền lên",
        ];
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            $emp_oldpassword = $request->get('emp_oldpassword');
            if (
                isset($user_id) && $user_id != "" &&
                isset($emp_oldpassword) && $emp_oldpassword != ""
            ) {
                $select = User::where([['use_id', $user_id], ['use_pass', md5($emp_oldpassword)]])->first();
                if (!empty($select)) {
                    return response()->json([
                        'result' => true,
                        'data' => 2,
                        'message' => "Mật khẩu trùng khớp",
                    ], 200);
                } else {
                    return response()->json([
                        'result' => true,
                        'data' => 1,
                        'message' => "Mật khẩu cũ không đúng",
                    ], 200);
                }
            }
            return response()->json($data_mess, 400);

        } catch (JWTException $e) {
            return response()->json(['message' => 'Lỗi xác thực token!'], 401);
        }
    }

    public function check_password_new(Request $request)
    {
        $data_mess = [
            'result' => false,
            'data' => '',
            'message' => "Thiếu dữ liệu truyền lên",
        ];
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            $emp_password = $request->get('emp_password');
            if (
                isset($user_id) && $user_id != "" &&
                isset($emp_password) && $emp_password != ""
            ) {
                $select = User::where([['use_id', $user_id], ['use_pass', md5($emp_password)]])->first();
                if (!empty($select)) {
                    return response()->json([
                        'result' => true,
                        'data' => 1,
                        'message' => "Mật khẩu trùng khớp với mật khẩu cũ",
                    ], 200);
                } else {
                    return response()->json([
                        'result' => true,
                        'data' => 2,
                        'message' => "Mật khẩu mới",
                    ], 200);
                }
            }
            return response()->json($data_mess, 400);

        } catch (JWTException $e) {
            return response()->json(['message' => 'Lỗi xác thực token!'], 401);
        }
    }

    public function ChangePassword(Request $request)
    {
        $data_mess = [
            'result' => false,
            'data' => '',
            'message' => "Thiếu dữ liệu truyền lên",
        ];
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            $emp_password = $request->get('emp_password');
            if (
                isset($user_id) && $user_id != "" &&
                isset($emp_password) && $emp_password != ""
            ) {
                $select = User::where('use_id', $user_id)->first();
                if (!empty($select)) {
                    // Cập nhật mật khẩu tài khoản
                    $post = User::where('use_id', $user_id)->update([
                        'use_pass' => md5($emp_password),
                        'use_update_time' => time(),
                    ]);
                    return response()->json([
                        'result' => true,
                        'data' => $post,
                        'message' => "Cập nhật mật khẩu thành công",
                    ], 200);
                } else {
                    return response()->json([
                        'result' => false,
                        'data' => '',
                        'message' => "Không tìm thấy người dùng",
                    ], 200);
                }
            }
            return response()->json($data_mess, 400);

        } catch (JWTException $e) {
            return response()->json(['message' => 'Lỗi xác thực token!'], 401);
        }
    }
}
