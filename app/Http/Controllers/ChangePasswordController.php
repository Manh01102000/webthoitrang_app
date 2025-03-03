<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ChangePasswordController extends Controller
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
            'seo_title' => "Đổi Mật Khẩu Tài Khoản - Fashion Houses",
            'seo_desc' => "Bảo mật tài khoản của bạn tại Fashion Houses bằng cách đổi mật khẩu an toàn. Cập nhật mật khẩu mới để đảm bảo an toàn khi mua sắm trực tuyến.",
            'seo_keyword' => "Fashion Houses đổi mật khẩu, cập nhật mật khẩu, bảo mật tài khoản, đổi mật khẩu an toàn, tài khoản thời trang, bảo vệ thông tin, bảo mật mua sắm trực tuyến.",
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
        return view('change_password', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

    public function check_password_old(Request $request)
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
        $emp_oldpassword = $request->get('emp_oldpassword');
        if (
            isset($use_id) && $use_id != "" &&
            isset($emp_oldpassword) && $emp_oldpassword != ""
        ) {
            $select = User::where([['use_id', $use_id], ['use_pass', md5($emp_oldpassword)]])->first();
            if (!empty($select)) {
                $data_mess = [
                    'result' => true,
                    'data' => 2,
                    'message' => "Mật khẩu trùng khớp",
                ];
                return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
            } else {
                $data_mess = [
                    'result' => true,
                    'data' => 1,
                    'message' => "Mật khẩu cũ không đúng",
                ];
                return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
            }

        }
        return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
    }

    public function check_password_new(Request $request)
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
        $emp_password = $request->get('emp_password');
        if (
            isset($use_id) && $use_id != "" &&
            isset($emp_password) && $emp_password != ""
        ) {
            $select = User::where([['use_id', $use_id], ['use_pass', md5($emp_password)]])->first();
            if (!empty($select)) {
                $data_mess = [
                    'result' => true,
                    'data' => 1,
                    'message' => "Mật khẩu trùng khớp với mật khẩu cũ",
                ];
                return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
            } else {
                $data_mess = [
                    'result' => true,
                    'data' => 2,
                    'message' => "Mật khẩu mới",
                ];
                return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
            }

        }
        return json_encode($data_mess, JSON_UNESCAPED_UNICODE);
    }

    public function ChangePassword(Request $request)
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
        $emp_password = $request->get('emp_password');
        if (
            isset($use_id) && $use_id != "" &&
            isset($emp_password) && $emp_password != ""
        ) {
            $select = User::where('use_id', $use_id)->first();

            if (!empty($select)) {
                // Cập nhật mật khẩu tài khoản
                $post = User::where('use_id', $use_id)->update([
                    'use_pass' => md5($emp_password),
                    'use_update_time' => time(),
                ]);
                // 
                $data_mess = [
                    'result' => true,
                    'data' => $post,
                    'message' => "Cập nhật mật khẩu thành công",
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
