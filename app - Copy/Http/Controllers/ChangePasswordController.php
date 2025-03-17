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
// ChangePasswordRepositoryInterface
use App\Repositories\ChangePassword\ChangePasswordRepositoryInterface;

class ChangePasswordController extends Controller
{
    protected $changePasswordRepo;

    public function __construct(ChangePasswordRepositoryInterface $changePasswordRepo)
    {
        $this->changePasswordRepo = $changePasswordRepo;
    }
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
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $emp_oldpassword = $request->get('emp_oldpassword');
            /** === Lấy dữ liệu từ repository === */
            $response = $this->changePasswordRepo->checkPasswordOld($user, $emp_oldpassword);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
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
            $emp_password = $request->get('emp_password');
            /** === Lấy dữ liệu từ repository === */
            $response = $this->changePasswordRepo->checkPasswordNew($user, $emp_password);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }

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
            $emp_password = $request->get('emp_password');
            /** === Lấy dữ liệu từ repository === */
            $response = $this->changePasswordRepo->changePassword($user, $emp_password);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }

        } catch (JWTException $e) {
            return response()->json(['message' => 'Lỗi xác thực token!'], 401);
        }
    }
}
