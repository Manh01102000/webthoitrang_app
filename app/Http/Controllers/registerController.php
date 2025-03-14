<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// MODEL
use App\Models\User;
// JWT
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RegisterController extends Controller
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
            'seo_title' => "Đăng Ký Tài Khoản | Fashion Houses - Mua Sắm Thời Trang Đẳng Cấp",
            'seo_desc' => "Tạo tài khoản Fashion Houses ngay hôm nay để nhận ưu đãi độc quyền, cập nhật xu hướng thời trang mới nhất và mua sắm dễ dàng hơn. Đăng ký miễn phí!",
            'seo_keyword' => "đăng ký tài khoản, Fashion Houses, tạo tài khoản mua sắm, thời trang trực tuyến, shop quần áo online, ưu đãi thời trang, xu hướng thời trang",
            'canonical' => $domain . '/dang-ky-tai-khoan'
        ];
        // Kiểm tra xem có cookie đăng nhập không nếu có thì về trang chủ
        if (isset($_COOKIE['UID']) && isset($_COOKIE['UT'])) {
            return redirect("/");
        }
        // 
        // LÂY DỮ LIỆU
        $data = InForAccount();
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'datacity' => '',
            'datadistrict' => '',
            'datacommune' => '',
        ];
        // Trả về view 'example'
        return view('register', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

    public function CheckAccountRegister(Request $request)
    {
        $data_mess = [
            'result' => false,
            'data' => '',
            'message' => "Có lỗi xảy ra",
        ];
        $account_check = $request->get('account_check');
        if (isset($account_check) && $account_check != "") {
            $check = DB::table('users')
                ->where('users.use_email_account', $account_check)
                ->select('users.*')
                ->get();
            $data_mess = [
                'result' => true,
                'data' => ($check->count() > 0) ? 1 : 0,
                'message' => "Lấy dữ liệu thành công",
            ];
        }
        return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
    }

    public function AccountRegister(Request $request)
    {
        $emp_account = $request->get('emp_account');
        $emp_name = $request->get('emp_name');
        $emp_password = $request->get('emp_password');
        $emp_phone = $request->get('emp_phone');
        $emp_birth = $request->get('emp_birth');
        $ip_address = client_ip();

        if (!$emp_account || !$emp_name || !$emp_password || !$emp_phone || !$emp_birth) {
            return apiResponse("success", "Thiếu dữ liệu truyền lên", [], false, 400);
        }

        try {
            // Tạo user mới
            $user = User::create([
                'use_name' => $emp_name,
                'use_email_account' => $emp_account,
                'use_role' => 1,
                'use_email_contact' => $emp_account,
                'use_pass' => md5($emp_password), // Bảo mật hơn md5()
                'use_phone' => $emp_phone,
                'use_authentic' => 0,
                'use_otp' => 0,
                'use_show' => 1,
                'birthday' => $emp_birth,
                'use_create_time' => time(),
                'use_update_time' => time(),
                'last_login' => time(),
                'use_ip_address' => $ip_address,
            ]);

            // Lấy ID & password đã mã hóa
            $cookie_last_id = $user->use_id;
            $cookie_password = $user->use_pass;
            $cookie_ut = 1;

            // Key mã hóa
            $key = base64_decode(getenv('KEY_ENCRYPT'));
            $UT_ENCRYPT = encryptData($cookie_ut, $key);
            $UID_ENCRYPT = encryptData($cookie_last_id, $key);
            $PHPSESPASS_ENCRYPT = encryptData($cookie_password, $key);

            // Set cookie (tồn tại 1 ngày)
            $expire_time = time() + (1 * 24 * 60 * 60);
            setcookie('UT', $UT_ENCRYPT, $expire_time, '/');
            setcookie('UID', $UID_ENCRYPT, $expire_time, '/');
            setcookie('PHPSESPASS', $PHPSESPASS_ENCRYPT, $expire_time, '/');

            // Tạo JWT token
            $token = JWTAuth::fromUser($user);
            // setcookie('jwt_token', $token, $expire_time, '/', '', true, true);
            setcookie('jwt_token', $token, $expire_time, '/', null, false, true);

            // Trả về dữ liệu thành công
            return apiResponse("success", "Đăng ký tài khoản thành công", [
                'data' => $user,
                'token' => $token,
            ], true, 200);

        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }
}