<?php

namespace App\Repositories\ChangePassword;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRepository implements ChangePasswordRepositoryInterface
{
    public function checkPasswordOld($user, $emp_oldpassword)
    {
        try {
            $user_id = $user->use_id;
            if (!$user_id) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy người dùng!',
                    'httpCode' => 401,
                    'data' => null,
                ];
            }

            $select = User::where('use_id', $user_id)->first();

            if ($select && Hash::check($emp_oldpassword, $select->password)) {
                return [
                    'success' => true,
                    'message' => "Mật khẩu trùng khớp",
                    'httpCode' => 200,
                    'data' => 2,
                ];
            } else {
                return [
                    'success' => true,
                    'message' => "Mật khẩu cũ không đúng",
                    'httpCode' => 200,
                    'data' => 1,
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Lỗi server: ' . $e->getMessage(),
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }

    public function checkPasswordNew($user, $emp_password)
    {
        try {
            $user_id = $user->use_id;
            if (!$user_id) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy người dùng!',
                    'httpCode' => 401,
                    'data' => null,
                ];
            }

            $select = User::where('use_id', $user_id)->first();

            if ($select && Hash::check($emp_password, $select->password)) {
                return [
                    'success' => true,
                    'message' => "Mật khẩu trùng khớp với mật khẩu cũ",
                    'httpCode' => 200,
                    'data' => 1,
                ];
            } else {
                return [
                    'success' => true,
                    'message' => "Mật khẩu mới",
                    'httpCode' => 200,
                    'data' => 2,
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Lỗi server: ' . $e->getMessage(),
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }

    public function changePassword($user, $emp_password)
    {
        try {
            $user_id = $user->use_id;
            if (!$user_id) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy người dùng!',
                    'httpCode' => 401,
                    'data' => null,
                ];
            }

            $select = User::where('use_id', $user_id)->first();

            if (!empty($select)) {
                // Cập nhật mật khẩu
                User::where('use_id', $user_id)->update([
                    'password' => Hash::make($emp_password),
                    'use_update_time' => time(),
                ]);

                return [
                    'success' => true,
                    'message' => "Cập nhật mật khẩu thành công",
                    'httpCode' => 200,
                    'data' => true,
                ];
            } else {
                return [
                    'success' => false,
                    'message' => "Không tìm thấy người dùng",
                    'httpCode' => 404,
                    'data' => null,
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Lỗi server: ' . $e->getMessage(),
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }
}
