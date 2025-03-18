<?php
namespace App\Repositories\ManagerAccount;
use App\Repositories\ManagerAccount\ManagerAccountRepositoryInterface;
// Model
use App\Models\User;
class ManagerAccountRepository implements ManagerAccountRepositoryInterface
{
    public function AccountUpdate(array $data)
    {
        try {
            $user_id = $data['user_id'];
            $userType = $data['userType'];
            $avatar = $data['avatar'];
            $emp_email_contact = $data['emp_email_contact'];
            $emp_name = $data['emp_name'];
            $emp_address = $data['emp_address'];
            $emp_phone = $data['emp_phone'];
            $emp_birth = $data['emp_birth'];
            $ip_address = $data['ip_address'];

            $select = User::where('use_id', $user_id)->first();
            // Cập nhật ảnh đại diện
            $use_logo = '';
            if (!empty($avatar)) {
                $originalName = $avatar->getClientOriginalName(); // "doodles-5654738.png"
                $extension = $avatar->getClientOriginalExtension(); // "png"
                $mimeType = $avatar->getClientMimeType(); // "image/png"
                $size = $avatar->getSize(); // Dung lượng file (bytes)
                $tempPath = $avatar->getPathname(); // "C:\xampp\tmp\php2F3F.tmp"
                $use_logo = UploadAvatar($tempPath, $select['use_name'], $select['use_create_time'], $extension);
            }
            // Cập nhật thông tin tài khoản
            $user = User::where('use_id', $user_id)->update([
                'use_name' => $emp_name,
                'use_email_contact' => $emp_email_contact,
                'use_phone' => $emp_phone,
                'birthday' => $emp_birth,
                'address' => $emp_address,
                'use_update_time' => time(),
                'use_logo' => $use_logo,
                'last_login' => time(),
                'use_ip_address' => $ip_address,
            ]);
            return [
                'success' => true,
                'message' => "Cập nhật thông tin thành công",
                'httpCode' => 200,
                'data' => [
                    'user' => $user,
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