<?php
namespace App\Repositories\Login;
use App\Repositories\Login\LoginRepositoryInterface;
// Model
use App\Models\User;
// Hash
use Illuminate\Support\Facades\Hash;
class LoginRepository implements LoginRepositoryInterface
{
    public function login($emp_account, $emp_password)
    {
        try {
            // Kiểm tra user có tồn tại không
            $user = User::where('use_email_account', $emp_account)->first();

            if (!$user || !Hash::check($emp_password, $user->password)) {
                return [
                    'success' => true,
                    'message' => "Tài khoản hoặc mật khẩu không chính xác",
                    'httpCode' => 200,
                    'data' => [
                        'user' => $user
                    ],
                ];
            }
            // Trả về thông tin user để Controller xử lý tiếp
            return [
                'success' => true,
                'message' => "Đăng nhập thành công",
                'httpCode' => 200,
                'data' => [
                    'user' => $user
                ],
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi đăng ký tài khoản: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }
}