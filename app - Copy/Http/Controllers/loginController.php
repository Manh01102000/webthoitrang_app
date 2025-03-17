<?php
namespace App\Http\Controllers;
// import class DB
use Illuminate\Support\Facades\DB;
// import class request
use Illuminate\Http\Request;
// Authen
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
// Model
use App\Models\User;

class LoginController extends Controller
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
            'seo_title' => "Đăng Nhập Fashion Houses - Khám Phá Thế Giới Thời Trang Cao Cấp",
            'seo_desc' => "Đăng nhập vào Fashion Houses để khám phá bộ sưu tập thời trang cao cấp mới nhất. Truy cập tài khoản của bạn và tận hưởng ưu đãi độc quyền, xu hướng thời trang hot nhất năm!",
            'seo_keyword' => "đăng nhập Fashion Houses, thời trang cao cấp, đăng nhập tài khoản thời trang, xu hướng thời trang 2023, Fashion Houses login, thời trang cao cấp online",
            'canonical' => $domain . '/dang-nhap-tai-khoan'
        ];
        // Kiểm tra xem có cookie đăng nhập không nếu có thì về trang chủ
        if (isset($_COOKIE['UID']) && isset($_COOKIE['UT'])) {
            return redirect("/");
        }
        /** === Chuẩn bị dữ liệu === */
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
        try {
            $emp_account = $request->get('emp_account');
            $emp_password = $request->get('emp_password');

            // Kiểm tra dữ liệu đầu vào
            if (empty($emp_account) || empty($emp_password)) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }
            // Kiểm tra thông tin đăng nhập
            $user = User::where('use_email_account', $emp_account)->first();
            if (!$user || !Hash::check($emp_password, $user->password)) {
                return apiResponse("error", "Tài khoản hoặc mật khẩu không chính xác", [], false, 401);
            }
            if ($user) { // Kiểm tra xem Collection có rỗng không

                $cookie_last_id = $user->use_id;  // Lấy ID của user
                $cookie_password = $user->password;  // Lấy mật khẩu đã mã hóa
                $cookie_ut = 1; // Giá trị tùy chỉnh của bạn
                //
                //key mã hóa (dùng cho giải mã và mã hóa)
                $key = base64_decode(getenv('KEY_ENCRYPT')); // Sinh key 32 byte rồi mã hóa Base64
                $UT_ENCRYPT = encryptData($cookie_ut, $key);
                $UID_ENCRYPT = encryptData($cookie_last_id, $key);
                $PHPSESPASS_ENCRYPT = encryptData($cookie_password, $key);
                // Set cookie (tồn tại 1 ngày)
                $expire_time = time() + (1 * 24 * 60 * 60);
                // Lưu vào cookie
                setcookie('UT', $UT_ENCRYPT, $expire_time, '/');
                setcookie('UID', $UID_ENCRYPT, $expire_time, '/');
                setcookie('PHPSESPASS', $PHPSESPASS_ENCRYPT, $expire_time, '/');

                try {
                    // Tạo JWT token
                    $token = JWTAuth::fromUser($user);
                    // Trả về dữ liệu thành công
                    $data_mess = [
                        'data' => $user,  // Trả về đối tượng user đầu tiên
                        'token' => $token,
                    ];
                    // Trả về dữ liệu kèm cookie
                    return apiResponseWithCookie("success", "Đăng nhập tài khoản thành công", $data_mess, 'jwt_token', $token, $expire_time, true, 200);
                } catch (JWTException $e) {
                    // Lỗi tạo token
                    return apiResponse("error", "Không thể tạo token, lỗi: " . $e->getMessage(), [], false, 500);
                }
            } else {
                return apiResponse("error", "Tài khoản hoặc mật khẩu không chính xác", [], false, 500);
            }

        } catch (\Exception $e) {
            // Xử lý lỗi bất ngờ
            return response()->json([
                'result' => false,
                'message' => "Lỗi hệ thống: " . $e->getMessage(),
            ], 500);
        }
    }

    public function debugToken()
    {
        try {
            $token = request()->bearerToken(); // Lấy token từ request
            $payload = JWTAuth::setToken($token)->getPayload();
            return response()->json($payload);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function refreshToken(Request $request)
    {
        try {
            // 1 Lấy token từ Header hoặc Cookie
            $token = $request->bearerToken() ?? $request->cookie('jwt_token');

            // 2 Nếu không có token, báo lỗi
            if (!$token) {
                return response()->json(['message' => 'Token không được cung cấp!'], 401);
            }
            // 1 Nếu token hết hạn, tự động refresh
            $newToken = JWTAuth::refresh($token);
            JWTAuth::setToken($newToken)->authenticate();
            // Set jwt_token (tồn tại 1 ngày) khi có refreshToken
            $expire_time = time() + (1 * 24 * 60 * 60);
            // 2 Gửi token mới trong cookie & header
            $datatoken = [
                'token' => $newToken,
            ];
            setcookie('jwt_token', $newToken, $expire_time, '/', null, false, true);
            // khi nào có https thì mở
            // setcookie('jwt_token', $newToken, $expire_time, '/', null, true, true);
            return apiResponse("success", "Làm mới token thành công", $datatoken, true, 200);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Phiên đăng nhập hết hạn, vui lòng đăng nhập lại!'], 401);
        }
    }
}