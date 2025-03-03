<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use APP\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        // kiểm tra xem có dùng thư viện hay không
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        // 
        $domain = env('DOMAIN_WEB');
        // 
        $dataSeo = [
            'seo_title' => "Đăng Nhập Fashion Houses - Khám Phá Thế Giới Thời Trang Cao Cấp",
            'seo_desc' => "Đăng nhập vào Fashion Houses để khám phá bộ sưu tập thời trang cao cấp mới nhất. Truy cập tài khoản của bạn và tận hưởng ưu đãi độc quyền, xu hướng thời trang hot nhất năm!",
            'seo_keyword' => "đăng nhập Fashion Houses, thời trang cao cấp, đăng nhập tài khoản thời trang, xu hướng thời trang 2023, Fashion Houses login, thời trang cao cấp online",
            'canonical' => $domain . '/dang-nhap-tai-khoan'
        ];
        // Kiểm tra xem có cookie đăng nhập không nếu có thì về trang chủ
        if (isset($_COOKIE['UID']) && isset($_COOKIE['UT'])) {
            return redirect("/");
        }
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
        // Trả về view
        return view('login', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

    public function Accountlogin(Request $request)
    {
        $data_mess = [
            'result' => false,
            'data' => '',
            'message' => "Thiếu dữ liệu truyền lên",
        ];
        $emp_account = $request->get('emp_account');
        $emp_password = $request->get('emp_password');
        if (
            isset($emp_account) && $emp_account != "" &&
            isset($emp_password) && $emp_password != ""
        ) {
            $check = DB::table('users')
                ->where([
                    ['use_email_account', '=', $emp_account],
                    ['use_pass', '=', md5($emp_password)],
                ])
                ->select('users.*')
                ->first();

            if ($check) { // Kiểm tra xem Collection có rỗng không

                $cookie_last_id = $check->use_id;  // Lấy ID của user
                $cookie_password = $check->use_pass;  // Lấy mật khẩu đã mã hóa
                $cookie_ut = 1; // Giá trị tùy chỉnh của bạn
                //
                //key mã hóa (dùng cho giải mã và mã hóa)
                $key = base64_decode(getenv('KEY_ENCRYPT')); // Sinh key 32 byte rồi mã hóa Base64
                $UT_ENCRYPT = encryptData($cookie_ut, $key);
                $UID_ENCRYPT = encryptData($cookie_last_id, $key);
                $PHPSESPASS_ENCRYPT = encryptData($cookie_password, $key);
                // Lưu vào cookie
                setcookie('UT', $UT_ENCRYPT, time() + 7 * 6000, '/');
                setcookie('UID', $UID_ENCRYPT, time() + 7 * 6000, '/');
                setcookie('PHPSESPASS', $PHPSESPASS_ENCRYPT, time() + 7 * 6000, '/');

                // Trả về dữ liệu thành công
                $data_mess = [
                    'result' => true,
                    'data' => $check,  // Trả về đối tượng user đầu tiên
                    'message' => "Đăng nhập tài khoản thành công",
                ];
            } else {
                // Trả về thông báo lỗi nếu không tìm thấy
                $data_mess = [
                    'result' => false,
                    'data' => [],
                    'message' => "Tài khoản hoặc mật khẩu không chính xác",
                ];
            }
        }
        return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
    }
}