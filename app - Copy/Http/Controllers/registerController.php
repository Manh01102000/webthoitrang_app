<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// MODEL
use App\Models\User;
// JWT
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
// import repository interface
use App\Repositories\Register\RegisterRepositoryInterface;

class RegisterController extends Controller
{
    protected $registerRepository;

    public function __construct(RegisterRepositoryInterface $registerRepository)
    {
        $this->registerRepository = $registerRepository;
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
        $account_check = $request->get('account_check');

        if (!$account_check) {
            return response()->json([
                'success' => false,
                'message' => "Thiếu dữ liệu truyền lên",
                'httpCode' => 400,
                'data' => null,
            ]);
        }
        /** === Lấy dữ liệu từ repository === */
        $response = $this->registerRepository->checkAccountRegister($account_check);
        if ($response['success']) {
            return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
        } else {
            return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
        }
    }

    public function AccountRegister(Request $request)
    {
        $data = [
            'emp_account' => $request->get('emp_account'),
            'emp_name' => $request->get('emp_name'),
            'emp_password' => $request->get('emp_password'),
            'emp_phone' => $request->get('emp_phone'),
            'emp_birth' => $request->get('emp_birth'),
            'ip_address' => client_ip(),
        ];
        if (in_array(null, $data, true)) {
            return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
        }
        try {
            /** === Lấy dữ liệu từ repository === */
            $response = $this->registerRepository->accountRegister($data);
            if ($response['success']) {
                $expire_time = time() + (1 * 24 * 60 * 60);
                $user = $response['data']['user'];
                // Lấy dữ liệu đẩy vào cookie
                $cookie_last_id = $user->use_id;
                $cookie_password = $user->password;
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
                return apiResponseWithCookie("success", $response['message'], $response['data'], 'jwt_token', $response['data']['token'], $expire_time, true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }

        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

}