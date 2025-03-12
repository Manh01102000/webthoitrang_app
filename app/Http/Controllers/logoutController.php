<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
class LogoutController extends Controller
{
    public function index()
    {
        // Bắt đầu session
        session_start();

        // Xóa tất cả các biến trong session
        session_unset();

        // Hủy session
        session_destroy();

        // Xóa cookies
        setcookie('UID', '', time() - 3600, '/'); // Đặt thời gian hết hạn trong quá khứ
        setcookie('PASSWORD', '', time() - 3600, '/');
        setcookie('UT', '', time() - 3600, '/');
        setcookie('PHPSESPASS', '', time() - 3600, '/');
        setcookie('PHPSESSID', '', time() - 3600, '/');

        // Xóa giá trị cookie khỏi biến $_COOKIE (nếu cần)
        unset($_COOKIE["UID"]);
        unset($_COOKIE["PASSWORD"]);
        unset($_COOKIE["UT"]);
        unset($_COOKIE["PHPSESPASS"]);
        unset($_COOKIE["PHPSESSID"]);

        // Xóa token
        // Lấy token từ request header
        $token = JWTAuth::getToken();

        // Nếu có token, thực hiện vô hiệu hóa nó
        if ($token) {
            JWTAuth::invalidate($token);
        }
        return redirect("/");
    }
}
