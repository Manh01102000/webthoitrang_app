<?php
namespace App\Repositories\Register;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterRepository implements RegisterRepositoryInterface
{
    public function checkAccountRegister(string $account)
    {
        try {
            $check = User::where('users.use_email_account', $account)
                ->select('users.*')
                ->get();

            return [
                'success' => true,
                'message' => "Lấy dữ liệu thành công",
                'httpCode' => 200,
                'data' => ($check->count() > 0) ? 1 : 0,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi kiểm tra tài khoản: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }

    public function accountRegister(array $data)
    {
        try {
            $user = User::create([
                'use_name' => $data['emp_name'],
                'use_email_account' => $data['emp_account'],
                'use_role' => 1,
                'use_email_contact' => $data['emp_account'],
                'password' => Hash::make($data['emp_password']),
                'use_phone' => $data['emp_phone'],
                'use_authentic' => 0,
                'use_otp' => 0,
                'use_show' => 1,
                'birthday' => $data['emp_birth'],
                'use_create_time' => time(),
                'use_update_time' => time(),
                'last_login' => time(),
                'use_ip_address' => $data['ip_address'],
            ]);

            // Tạo JWT token
            $token = JWTAuth::fromUser($user);
            // Trả dữ liệu về controller
            return [
                'success' => true,
                'message' => "Đăng ký tài khoản thành công",
                'httpCode' => 201,
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
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
