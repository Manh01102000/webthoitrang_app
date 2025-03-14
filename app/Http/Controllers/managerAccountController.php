<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
// JWT
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class managerAccountController extends Controller
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
            'seo_title' => "Quản Lý Tài Khoản - Fashion Houses",
            'seo_desc' => "Quản lý thông tin cá nhân, theo dõi đơn hàng, cập nhật địa chỉ giao hàng và bảo mật tài khoản của bạn tại Fashion Houses. Trải nghiệm mua sắm thời trang dễ dàng và an toàn!",
            'seo_keyword' => "Fashion Houses tài khoản, quản lý tài khoản, cập nhật thông tin cá nhân, bảo mật tài khoản, theo dõi đơn hàng, địa chỉ giao hàng, lịch sử mua sắm, tài khoản khách hàng, thời trang trực tuyến.",
            'canonical' => $domain . '/quan-ly-tai-khoan',
        ];
        /** === Xây dựng breadcrumb === */
        $breadcrumbItems = [
            ['title' => 'Trang chủ', 'url' => '/', 'class' => 'otherssite'],
            [
                'title' => "Quản lý tài khoản",
                'url' => '',
                'class' => 'thissite'
            ]
        ];
        /** === Chuẩn bị dữ liệu === */
        $data = InForAccount();
        // lấy dữ liệu danh mục theo từng cấp
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'breadcrumbItems' => $breadcrumbItems,
            'Category' => $categoryTree,
        ];
        /** === Trả về view với dữ liệu === */
        return view('manager_account', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

    public function AccountUpdate(Request $request)
    {
        $data_mess = [
            'result' => false,
            'data' => '',
            'message' => "Thiếu dữ liệu truyền lên",
        ];

        try {
            // 🟢 Lấy user từ request
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }

            // 🟢 Nhận dữ liệu từ request
            $avatar = $request->file('avatar');
            $emp_email_contact = $request->get('emp_email_contact');
            $emp_name = $request->get('emp_name');
            $emp_address = $request->get('emp_address');
            $emp_phone = $request->get('emp_phone');
            $emp_birth = $request->get('emp_birth');
            $ip_address = client_ip();

            if (
                isset($emp_email_contact) && $emp_email_contact != "" &&
                isset($emp_name) && $emp_name != "" &&
                isset($emp_address) && $emp_address != "" &&
                isset($emp_phone) && $emp_phone != "" &&
                isset($emp_birth) && $emp_birth != ""
            ) {
                $use_id = $user->use_id;
                $select = User::where('use_id', $use_id)->first();
                // Cập nhật ảnh đại diện
                $use_logo = '';
                if (!empty($avatar)) {
                    $originalName = $avatar->getClientOriginalName(); // "doodles-5654738.png"
                    $extension = $avatar->getClientOriginalExtension(); // "png"
                    $mimeType = $avatar->getClientMimeType(); // "image/png"
                    $size = $avatar->getSize(); // Dung lượng file (bytes)
                    $tempPath = $avatar->getPathname(); // "C:\xampp\tmp\php2F3F.tmp"
                    $use_logo = UploadAvatar($tempPath, $select['use_name'], $select['use_create_time'], $extension);
                }
                // Cập nhật thông tin tài khoản
                User::where('use_id', $use_id)->update([
                    'use_name' => $emp_name,
                    'use_email_contact' => $emp_email_contact,
                    'use_phone' => $emp_phone,
                    'birthday' => $emp_birth,
                    'address' => $emp_address,
                    'use_update_time' => time(),
                    'use_logo' => $use_logo,
                    'last_login' => time(),
                    'use_ip_address' => $ip_address,
                ]);

                return response()->json([
                    'result' => true,
                    'data' => $user,
                    'message' => "Cập nhật thông tin thành công",
                ], 200);
            }

            return response()->json($data_mess, 400);

        } catch (JWTException $e) {
            return response()->json(['message' => 'Lỗi xác thực token!'], 401);
        }
    }
}
