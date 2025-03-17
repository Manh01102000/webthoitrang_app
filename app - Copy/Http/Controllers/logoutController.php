<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
class LogoutController extends Controller
{
    public function index(Request $request)
    {
        // Bắt đầu session
        session_start();

        // Xóa tất cả các biến trong session
        session_unset();

        // Hủy session
        session_destroy();

        // Xóa cookies
        setcookie('UID', '', -1, '/'); // Đặt thời gian hết hạn trong quá khứ
        setcookie('PASSWORD', '', -1, '/');
        setcookie('UT', '', -1, '/');
        setcookie('PHPSESPASS', '', -1, '/');
        setcookie('PHPSESSID', '', -1, '/');
        setcookie('jwt_token', '', -1, '/');

        // Xóa giá trị cookie khỏi biến $_COOKIE (nếu cần)
        unset($_COOKIE["UID"]);
        unset($_COOKIE["PASSWORD"]);
        unset($_COOKIE["UT"]);
        unset($_COOKIE["PHPSESPASS"]);
        unset($_COOKIE["PHPSESSID"]);
        unset($_COOKIE["jwt_token"]);

        return redirect("/");
    }
}
