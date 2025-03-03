<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class managerAccountController extends Controller
{
    public function index()
    {
        // kiểm tra xem có dùng thư viện hay không
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        // SEO 
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Quản Lý Tài Khoản - Fashion Houses",
            'seo_desc' => "Quản lý thông tin cá nhân, theo dõi đơn hàng, cập nhật địa chỉ giao hàng và bảo mật tài khoản của bạn tại Fashion Houses. Trải nghiệm mua sắm thời trang dễ dàng và an toàn!",
            'seo_keyword' => "Fashion Houses tài khoản, quản lý tài khoản, cập nhật thông tin cá nhân, bảo mật tài khoản, theo dõi đơn hàng, địa chỉ giao hàng, lịch sử mua sắm, tài khoản khách hàng, thời trang trực tuyến.",
            'canonical' => $domain . '/quan-ly-tai-khoan',
        ];
        // LÂY DỮ LIỆU
        $data = InForAccount();
        // lấy dữ liệu danh mục theo từng cấp
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'datacity' => '',
            'datadistrict' => '',
            'datacommune' => '',
        ];
        // dd($dataAll);
        // Trả về view
        return view('manager_account', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

    public function AccountUpdate(Request $request)
    {
        $data_mess = [
            'result' => false,
            'data' => '',
            'message' => "Thiếu dữ liệu truyền lên",
        ];
        // Lấy UID từ cookie
        $UID_ENCRYPT = !empty($_COOKIE['UID']) ? $_COOKIE['UID'] : 0;
        //key mã hóa (dùng cho giải mã và mã hóa)
        $key = base64_decode(getenv('KEY_ENCRYPT')); // Sinh key 32 byte rồi mã hóa Base64
        $use_id = decryptData($UID_ENCRYPT, $key);
        $avatar = $request->file('avatar');
        $emp_email_contact = $request->get('emp_email_contact');
        $emp_name = $request->get('emp_name');
        $emp_address = $request->get('emp_address');
        $emp_phone = $request->get('emp_phone');
        $emp_birth = $request->get('emp_birth');
        $ip_address = client_ip();

        if (
            isset($use_id) && $use_id != "" &&
            isset($emp_email_contact) && $emp_email_contact != "" &&
            isset($emp_name) && $emp_name != "" &&
            isset($emp_address) && $emp_address != "" &&
            isset($emp_phone) && $emp_phone != "" &&
            isset($emp_birth) && $emp_birth != ""
        ) {
            $select = User::where('use_id', $use_id)->first();

            if (!empty($select)) {
                $select = $select->toArray();
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
                $post = User::where('use_id', $use_id)->update([
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
                // 
                $data_mess = [
                    'result' => true,
                    'data' => $post,
                    'message' => "Cập nhật thông tin thành công",
                ];
                return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
            } else {
                $data_mess = [
                    'result' => false,
                    'data' => '',
                    'message' => "Không tìm thấy người dùng",
                ];
                return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
            }

        }
        return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
    }
}
