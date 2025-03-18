<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
// JWT
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
//
use App\Repositories\ManagerAccount\ManagerAccountRepositoryInterface;

class managerAccountController extends Controller
{
    protected $ManagerAccountRepository;
    public function __construct(ManagerAccountRepositoryInterface $ManagerAccountRepository)
    {
        $this->ManagerAccountRepository = $ManagerAccountRepository;
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
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
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
                $data = [
                    'user_id' => $user_id,
                    'userType' => $userType,
                    'avatar' => $avatar,
                    'emp_email_contact' => $emp_email_contact,
                    'emp_name' => $emp_name,
                    'emp_address' => $emp_address,
                    'emp_phone' => $emp_phone,
                    'emp_birth' => $emp_birth,
                    'ip_address' => $ip_address,
                ];
                $response = $this->ManagerAccountRepository->AccountUpdate($data);
                if ($response['success']) {
                    return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
                } else {
                    return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
                }
            }
            return apiResponse('success', 'Thiếu dữ liệu truyền lên', [], true, 400);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Lỗi xác thực token!'], 401);
        }
    }
}
