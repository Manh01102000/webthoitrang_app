<?php
use App\Models\User;
use App\Models\admin;
use App\Models\category;
use App\Models\cart;
// Lấy cache
use Illuminate\Support\Facades\Cache;
// Lưu log
use Illuminate\Support\Facades\Log;

// Hàm mã hóa và giải mã sử dụng thuật toán đối xứng AES-256-CBC (AES 256 byte)
// 🔒 Hàm mã hóa dữ liệu
function encryptData($data, $key)
{
    // Tạo IV ngẫu nhiên (16 byte)
    $iv = random_bytes(16);
    // Mã hóa dữ liệu
    $encrypted = openssl_encrypt($data, "AES-256-CBC", $key, 0, $iv);
    // Gộp IV + dữ liệu mã hóa rồi mã hóa tiếp bằng Base64
    return base64_encode($iv . $encrypted);
}

// 🔓 Hàm giải mã dữ liệu
function decryptData($data, $key)
{
    // Giải mã Base64 để lấy lại dữ liệu gốc
    $data = base64_decode($data);
    // Lấy IV từ 16 byte đầu tiên
    $iv = substr($data, 0, 16);
    // Lấy phần dữ liệu mã hóa sau IV
    $encrypted = substr($data, 16);
    // Giải mã dữ liệu
    return openssl_decrypt($encrypted, "AES-256-CBC", $key, 0, $iv);
}

// Hàm Lấy link ảnh avatar
if (!function_exists('geturlimageAvatar')) {
    function geturlimageAvatar($time_stamp)
    {
        $month = date('m', $time_stamp);
        $year = date('Y', $time_stamp);
        $day = date('d', $time_stamp);
        $dir = "pictures/" . $year . "/" . $month . "/" . $day . "/"; // Full Path
        is_dir($dir) || @mkdir($dir, 0777, true) || die("Can't Create folder");
        return $dir;
    }
}

// Hàm Lấy link ảnh avatar admin
if (!function_exists('geturlimageAvatarAdmin')) {
    function geturlimageAvatarAdmin($time_stamp)
    {
        $month = date('m', $time_stamp);
        $year = date('Y', $time_stamp);
        $day = date('d', $time_stamp);
        $dir = "pictures/admin/" . $year . "/" . $month . "/" . $day . "/"; // Full Path
        is_dir($dir) || @mkdir($dir, 0777, true) || die("Can't Create folder");
        return $dir;
    }
}
// Hàm xóa dấu
if (!function_exists('remove_accent')) {
    function remove_accent($mystring)
    {
        $marTViet = array(
            "à",
            "á",
            "ạ",
            "ả",
            "ã",
            "â",
            "ầ",
            "ấ",
            "ậ",
            "ẩ",
            "ẫ",
            "ă",
            "ằ",
            "ắ",
            "ặ",
            "ẳ",
            "ẵ",
            "è",
            "é",
            "ẹ",
            "ẻ",
            "ẽ",
            "ê",
            "ề",
            "ế",
            "ệ",
            "ể",
            "ễ",
            "ì",
            "í",
            "ị",
            "ỉ",
            "ĩ",
            "ò",
            "ó",
            "ọ",
            "ỏ",
            "õ",
            "ô",
            "ồ",
            "ố",
            "ộ",
            "ổ",
            "ỗ",
            "ơ",
            "ờ",
            "ớ",
            "ợ",
            "ở",
            "ỡ",
            "ù",
            "ú",
            "ụ",
            "ủ",
            "ũ",
            "ư",
            "ừ",
            "ứ",
            "ự",
            "ử",
            "ữ",
            "ỳ",
            "ý",
            "ỵ",
            "ỷ",
            "ỹ",
            "đ",
            "À",
            "Á",
            "Ạ",
            "Ả",
            "Ã",
            "Â",
            "Ầ",
            "Ấ",
            "Ậ",
            "Ẩ",
            "Ẫ",
            "Ă",
            "Ằ",
            "Ắ",
            "Ặ",
            "Ẳ",
            "Ẵ",
            "È",
            "É",
            "Ẹ",
            "Ẻ",
            "Ẽ",
            "Ê",
            "Ề",
            "Ế",
            "Ệ",
            "Ể",
            "Ễ",
            "Ì",
            "Í",
            "Ị",
            "Ỉ",
            "Ĩ",
            "Ò",
            "Ó",
            "Ọ",
            "Ỏ",
            "Õ",
            "Ô",
            "Ồ",
            "Ố",
            "Ộ",
            "Ổ",
            "Ỗ",
            "Ơ",
            "Ờ",
            "Ớ",
            "Ợ",
            "Ở",
            "Ỡ",
            "Ù",
            "Ú",
            "Ụ",
            "Ủ",
            "Ũ",
            "Ư",
            "Ừ",
            "Ứ",
            "Ự",
            "Ử",
            "Ữ",
            "Ỳ",
            "Ý",
            "Ỵ",
            "Ỷ",
            "Ỹ",
            "Đ",
            "'"
        );

        $marKoDau = array(
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "e",
            "e",
            "e",
            "e",
            "e",
            "e",
            "e",
            "e",
            "e",
            "e",
            "e",
            "i",
            "i",
            "i",
            "i",
            "i",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "u",
            "u",
            "u",
            "u",
            "u",
            "u",
            "u",
            "u",
            "u",
            "u",
            "u",
            "y",
            "y",
            "y",
            "y",
            "y",
            "d",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "E",
            "E",
            "E",
            "E",
            "E",
            "E",
            "E",
            "E",
            "E",
            "E",
            "E",
            "I",
            "I",
            "I",
            "I",
            "I",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "U",
            "U",
            "U",
            "U",
            "U",
            "U",
            "U",
            "U",
            "U",
            "U",
            "U",
            "Y",
            "Y",
            "Y",
            "Y",
            "Y",
            "D",
            ""
        );

        return str_replace($marTViet, $marKoDau, $mystring);
    }
}
// Hàm lấy client_ip
if (!function_exists('client_ip')) {
    function client_ip()
    {
        $array = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];
        foreach ($array as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }
}
// Hàm chuyển title sang dạng slug, alias
if (!function_exists('replaceTitle')) {
    function replaceTitle($title)
    {
        $title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');
        $title = remove_accent($title);
        $title = str_replace('/', '', $title);
        $title = preg_replace('/[^\00-\255]+/u', '', $title);

        if (preg_match("/[\p{Han}]/simu", $title)) {
            $title = str_replace(' ', '-', $title);
        } else {
            $arr_str = array("&lt;", "&gt;", "/", " / ", "\\", "&apos;", "&quot;", "&amp;", "lt;", "gt;", "apos;", "quot;", "amp;", "&lt", "&gt", "&apos", "&quot", "&amp", "&#34;", "&#39;", "&#38;", "&#60;", "&#62;");

            $title = str_replace($arr_str, " ", $title);
            $title = preg_replace('/\p{P}|\p{S}/u', ' ', $title);
            $title = preg_replace('/[^0-9a-zA-Z\s]+/', ' ', $title);

            //Remove double space
            $array = array(
                '    ' => ' ',
                '   ' => ' ',
                '  ' => ' ',
            );
            $title = trim(strtr($title, $array));
            $title = str_replace(" ", "-", $title);
            $title = urlencode($title);
            // remove cac ky tu dac biet sau khi urlencode
            $array_apter = array("%0D%0A", "%", "&", "---");
            $title = str_replace($array_apter, "-", $title);
            $title = strtolower($title);
        }
        return $title;
    }
}
//Hàm lấy thời gian
if (!function_exists('lay_tgian')) {
    function lay_tgian($tgian)
    {
        // Lấy chênh lệch thời gian tính bằng giây
        $tg = time() - $tgian; // Get the difference in seconds
        $thoi_gian = '';

        if ($tg > 0) {
            if ($tg < 60) {
                $thoi_gian = $tg . ' giây';
            } else if ($tg >= 60 && $tg < 3600) {
                $thoi_gian = floor($tg / 60) . ' phút';
            } else if ($tg >= 3600 && $tg < 86400) {
                $thoi_gian = floor($tg / 3600) . ' giờ';
            } else if ($tg >= 86400 && $tg < 2592000) {
                $thoi_gian = floor($tg / 86400) . ' ngày';
            } else if ($tg >= 2592000 && $tg < 77760000) {
                $thoi_gian = floor($tg / 2592000) . ' tháng';
            } else if ($tg >= 77760000 && $tg < 933120000) {
                $thoi_gian = floor($tg / 77760000) . ' năm';
            }
        } else {
            $thoi_gian = '1 giây';
        }

        return $thoi_gian;
    }
}
//Hàm lấy thời gian
if (!function_exists('timeAgo')) {
    function timeAgo($timestamp)
    {
        $now = time(); // Lấy thời gian hiện tại dưới dạng timestamp (giây)
        $secondsAgo = $now - $timestamp;

        if ($secondsAgo < 60) {
            return "$secondsAgo giây trước";
        } else if ($secondsAgo < 3600) {
            $minutesAgo = floor($secondsAgo / 60);
            return "$minutesAgo phút trước";
        } else if ($secondsAgo < 86400) {
            $hoursAgo = floor($secondsAgo / 3600);
            return "$hoursAgo giờ trước";
        } else if ($secondsAgo < 604800) {
            $daysAgo = floor($secondsAgo / 86400);
            return "$daysAgo ngày trước";
        } else if ($secondsAgo < 2592000) {
            $weeksAgo = floor($secondsAgo / 604800);
            return "$weeksAgo tuần trước";
        } else if ($secondsAgo < 31536000) {
            $monthsAgo = floor($secondsAgo / 2592000);
            return "$monthsAgo tháng trước";
        } else {
            $yearsAgo = floor($secondsAgo / 31536000);
            return "$yearsAgo năm trước";
        }
    }
}
//
// link chi tiet ung vien
function rewriteUV($id, $name)
{
    $alias = replaceTitle($name);
    if ($alias == '') {
        $alias = 'nguoi-ngoai-quoc';
    }
    return "/" . $alias . "-us" . $id;
}
// Lấy dữ liệu NTD Hoặc UV
function InForAccount()
{
    $UID_ENCRYPT = !empty($_COOKIE['UID']) ? $_COOKIE['UID'] : 0;
    $UT_ENCRYPT = !empty($_COOKIE['UT']) ? $_COOKIE['UT'] : 0;
    //key mã hóa (dùng cho giải mã và mã hóa)
    $key = base64_decode(getenv('KEY_ENCRYPT')); // Sinh key 32 byte rồi mã hóa Base64
    $user_id = decryptData($UID_ENCRYPT, $key);
    $userType = decryptData($UT_ENCRYPT, $key);
    // Kiểm tra xem tài khoản là ứng viên hay NTD
    $dataAccount = [
        'islogin' => 0,
        'data' => [
            'us_name' => '',
            'us_logo' => '',
            'us_link' => '',
            'us_account' => '',
            'us_active' => 0,
            'us_id' => '',
            'active_account' => '',
            'use_create_time' => '',
            'us_show' => '',
        ],
        'type' => '',
    ];

    if ($user_id && $user_id > 0) {
        // gọi đến API Lấy dữ liệu ứng viên

        $dataUser = User::where('use_id', $user_id)->first();
        if ($dataUser) {
            // Lấy sô sản phẩm trong giỏ hàng
            $totalCarts = Cart::where('cart_user_id', $user_id)->count();
            // end
            $dataUser = $dataUser->toArray();
            $linkaccount = rewriteUV($user_id, $dataUser['use_name']);
            $emailTK = $dataUser['use_email_account'];
            $authentic = $dataUser['use_authentic'];
            $use_show = $dataUser['use_show'];
            $use_phone = $dataUser['use_phone'];
            $use_email_contact = $dataUser['use_email_contact'];
            $use_address = $dataUser['address'];
            $sex = $dataUser['gender'];
            $birthday = $dataUser['birthday'];
            $use_create_time = $dataUser['use_create_time'];
            $dataall = [
                'us_name' => $dataUser['use_name'],
                'us_logo' => !empty($dataUser['use_logo']) ? geturlimageAvatar($dataUser['use_create_time']) . $dataUser['use_logo'] : '',
                'us_link' => $linkaccount,
                'us_account' => $emailTK,
                'use_phone' => $use_phone,
                'use_email_contact' => $use_email_contact,
                'use_address' => $use_address,
                'use_sex' => $sex,
                'use_birthday' => $birthday,
                'use_create_time' => $use_create_time,
                'us_active' => $authentic,
                'us_id' => $user_id,
                'us_show' => $use_show,
                'totalCarts' => $totalCarts,
            ];
            $dataAccount = [
                'islogin' => 1,
                'data' => $dataall,
                'type' => $userType,
            ];
        }
    }
    return $dataAccount;
}
// Lấy dữ liệu admin
function InForAccountAdmin($admin_id)
{
    // Kiểm tra xem tài khoản là ứng viên hay NTD
    $dataAccount = [
        'islogin' => 0,
        'data' => [
            'us_name' => '',
            'us_logo' => '',
            'us_link' => '',
            'us_account' => '',
            'us_active' => 0,
            'us_id' => '',
            'active_account' => '',
            'use_create_time' => '',
            'us_show' => '',
        ],
        'type' => '',
    ];

    if ($admin_id && $admin_id > 0) {
        // gọi đến API Lấy dữ liệu ứng viên

        $dataUser = admin::where('admin_id', $admin_id)->first();
        if ($dataUser) {
            $dataUser = $dataUser->toArray();
            $admin_account = $dataUser['admin_account'];
            $admin_show = $dataUser['admin_show'];
            $admin_phone = $dataUser['admin_phone'];
            $admin_email_contact = $dataUser['admin_email_contact'];
            $admin_address = $dataUser['address'];
            $sex = $dataUser['gender'];
            $birthday = $dataUser['birthday'];
            $admin_create_time = $dataUser['admin_create_time'];
            $dataall = [
                'admin_name' => $dataUser['admin_name'],
                'admin_logo' => $dataUser['admin_logo'] != '' && $dataUser['admin_logo'] != 'NULL' ? geturlimageAvatarAdmin($dataUser['admin_create_time']) . $dataUser['admin_logo'] : '',
                'admin_account' => $admin_account,
                'admin_phone' => $admin_phone,
                'admin_email_contact' => $admin_email_contact,
                'admin_address' => $admin_address,
                'admin_sex' => $sex,
                'admin_birthday' => $birthday,
                'admin_create_time' => $admin_create_time,
                'admin_show' => $admin_show,
            ];
            $dataAccount = [
                'islogin' => 1,
                'data' => $dataall,
                'type' => $dataUser['admin_type'],
            ];
        }
    }
    return $dataAccount;
}

// Lấy dữ liệu danh mục
if (!function_exists('InForCategory')) {
    function InForCategory()
    {
        $category = Cache::rememberForever('category', function () {
            return category::all()->toArray();
        });

        return $category;
    }
}

// Lấy dữ liệu danh mục con (dùng đệ quy: kỹ thuật mà một hàm tự gọi lại chính nó cho đến khi đạt điều kiện dừng)

if (!function_exists('getCategoryTree')) {
    function getCategoryTree($parent_id = 0)
    {
        $categories = Cache::rememberForever('category', function () {
            return category::all()->toArray();
        });

        $tree = [];
        foreach ($categories as $category) {
            if ($category['cat_parent_code'] == $parent_id) {
                $category['children'] = getCategoryTree($category['cat_id']); // Lấy danh mục con
                $tree[] = $category;
            }
        }

        return $tree;
    }
}

if (!function_exists('getCategoryCode')) {
    function getCategoryCode($parent_id = 0)
    {
        $categories = Cache::rememberForever('category', function () {
            return category::all()->toArray();
        });

        $tree = [];
        foreach ($categories as $category) {
            if ($category['cat_parent_code'] == $parent_id) {
                $tree[] = $category;
            }
        }

        return $tree;
    }
}

if (!function_exists('getCategoryChildrenCode')) {
    function getCategoryChildrenCode($parent_id = 0)
    {

        // Lấy danh mục từ cache hoặc database
        $categories = Cache::rememberForever('category', function () {
            return category::all()->toArray();
        });

        // Tìm danh mục con cấp 1
        $tree = array_filter($categories, function ($category) use ($parent_id) {
            return $category['cat_parent_code'] == $parent_id;
        });

        // Lấy danh sách mã danh mục cấp 1
        $childCodes = array_column($tree, 'cat_code');

        // Tìm danh mục con cấp 2
        $tree2 = array_filter($categories, function ($category) use ($childCodes) {
            return in_array($category['cat_parent_code'], $childCodes);
        });

        return $tree2;
    }
}

// Hàm lấy chuỗi cuối cùng
if (!function_exists('getLastWord')) {

    function getLastWord($fullName)
    {
        $fullName = trim($fullName); // Loại bỏ khoảng trắng thừa
        $lastSpace = strrpos($fullName, ' '); // Tìm vị trí dấu cách cuối cùng

        if ($lastSpace !== false) {
            return substr($fullName, $lastSpace + 1); // Lấy phần sau dấu cách cuối cùng
        }

        return $fullName; // Nếu chỉ có 1 từ, trả về nguyên chuỗi
    }
}

// Hàm call data mảng
if (!function_exists('CallApi')) {
    function CallApi($data, $url, $time = 0, $method = 'post')
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($time != 0) {
            curl_setopt($curl, CURLOPT_TIMEOUT, $time);
        }
        if ($method = 'get') {
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

        } else if ($method = 'post') {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        }
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

        return $response;
    }
}

// Hàm call data json
if (!function_exists('CallApiJson')) {

    // Hàm call với data là json
    function CallApiJson($data, $url, $time = 0)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        if ($time != 0) {
            curl_setopt($curl, CURLOPT_TIMEOUT, $time);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}

// Làm upload avatar
if (!function_exists('UploadAvatar')) {
    function UploadAvatar($img_temp, $name, $time, $type)
    {
        $path = "pictures/";
        $year = date('Y', $time);
        $month = date('m', $time);
        $day = date('d', $time);
        $folderPath = "$path$year/$month/$day";
        $img = '';
        // Tạo thư mục nếu chưa tồn tại, kiểm tra lỗi khi tạo
        if (!is_dir($folderPath) && !mkdir($folderPath, 0777, true) && !is_dir($folderPath)) {
            return $img; // Trả về false nếu không thể tạo thư mục
        }

        // Kiểm tra file tạm có tồn tại không
        if (!file_exists($img_temp)) {
            return $img;
        }

        // Xử lý tên file an toàn hơn
        $image = replaceTitle($name) . '-' . time();
        $path_to = "$folderPath/$image.$type";

        if (move_uploaded_file($img_temp, $path_to)) {
            return "$image.$type";
        }

        return $img;
    }
}

// Làm lấy link video, ảnh sản phẩm
if (!function_exists('getUrlImageVideoProduct')) {
    function getUrlImageVideoProduct($time, $type = 1)
    {
        try {
            if (!is_numeric($time) || $time <= 0) {
                throw new InvalidArgumentException("Invalid timestamp provided.");
            }
            $dir = "";
            if ($type == 1) {
                // Định dạng đường dẫn thư mục
                $dir = sprintf(
                    "upload/product/images/%s/%s/%s/",
                    date('Y', $time),
                    date('m', $time),
                    date('d', $time)
                );
            } else if ($type == 2) {
                // Định dạng đường dẫn thư mục
                $dir = sprintf(
                    "upload/product/videos/%s/%s/%s/",
                    date('Y', $time),
                    date('m', $time),
                    date('d', $time)
                );
            }
            if (!is_dir($dir) && !mkdir($dir, 0777, true) && !is_dir($dir)) {
                throw new RuntimeException("Failed to create directory: $dir");
            }

            return $dir;
        } catch (Exception $e) {
            Log::error("Error in getUrlImageVideoProduct: " . $e->getMessage());
            return false;
        }
    }
}

function productSizes()
{
    $product_sizes = [
        'Chọn kích thước',
        'XS',
        'S',
        'M',
        'L',
        'XL',
        'XXL',
    ];
    return $product_sizes;
}

if (!function_exists('FindCategoryByCatId')) {
    function FindCategoryByCatId($id)
    {
        $array = Cache::get('category', []); // Mặc định về mảng rỗng nếu cache không có

        if (empty($array)) {
            return null; // Trả về null nếu không có dữ liệu
        }

        $category = array_filter($array, function ($item) use ($id) {
            return $item['cat_id'] == $id;
        });

        return reset($category) ?: null; // Lấy phần tử đầu tiên hoặc null nếu không có
    }
}

// Hàm render phân trang
if (!function_exists('renderPagination')) {
    function renderPagination($count, $page, $pageSize, $baseUrl = '')
    {
        // Tính tổng số trang
        $totalPages = ceil($count / $pageSize);

        // Nếu chỉ có 1 trang hoặc không có bản ghi, không cần phân trang
        if ($totalPages <= 1)
            return '';

        // Xác định các giới hạn
        $page = max(1, min((int) $page, $totalPages)); // Giới hạn page trong khoảng [1, totalPages]

        // Xử lý base URL (loại bỏ tham số ?page nếu có)
        $cleanBaseUrl = preg_replace('/[\?&]?page=\d+/', '', $baseUrl);
        $separator = strpos($cleanBaseUrl, '?') !== false ? '&' : '?';

        // HTML kết quả
        $html = '<div class="pagination-wrapper"><ul class="pagination">';

        // Nút "Trước"
        if ($page > 1) {
            $html .= '<li><a href="' . $cleanBaseUrl . $separator . 'page=' . ($page - 1) . '" class="prev">Trước</a></li>';
        } else {
            $html .= '<li class="disabled"><span>Trước</span></li>';
        }

        // Hiển thị số trang với dấu "..."
        $maxVisiblePages = 5;
        $delta = floor($maxVisiblePages / 2);
        $startPage = max(1, $page - $delta);
        $endPage = min($totalPages, $page + $delta);

        if ($endPage - $startPage < $maxVisiblePages - 1) {
            if ($page <= $delta) {
                $endPage = min($totalPages, $maxVisiblePages);
            } else {
                $startPage = max(1, $totalPages - $maxVisiblePages + 1);
            }
        }

        // Trang đầu tiên nếu không có dấu "..."
        if ($startPage > 1) {
            $html .= '<li><a href="' . $cleanBaseUrl . $separator . 'page=1">1</a></li>';
            if ($startPage > 2) {
                $html .= '<li><span>...</span></li>';
            }
        }

        // Các trang giữa
        for ($i = $startPage; $i <= $endPage; $i++) {
            if ($i === $page) {
                $html .= '<li class="active"><span>' . $i . '</span></li>';
            } else {
                $html .= '<li><a href="' . $cleanBaseUrl . $separator . 'page=' . $i . '">' . $i . '</a></li>';
            }
        }

        // Trang cuối nếu không có dấu "..."
        if ($endPage < $totalPages) {
            if ($endPage < $totalPages - 1) {
                $html .= '<li><span>...</span></li>';
            }
            $html .= '<li><a href="' . $cleanBaseUrl . $separator . 'page=' . $totalPages . '">' . $totalPages . '</a></li>';
        }

        // Nút "Sau"
        if ($page < $totalPages) {
            $html .= '<li><a href="' . $cleanBaseUrl . $separator . 'page=' . ($page + 1) . '" class="next">Sau</a></li>';
        } else {
            $html .= '<li class="disabled"><span>Sau</span></li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}

// Hàm trả về kết quả, mã lỗi của api
// Hàm này có thể dùng cho cả trả về thành công & lỗi bằng cách:
// $status: "success" hoặc "error"
// $message: Nội dung phản hồi
// $data: Dữ liệu cần trả về (mặc định là [])
// $httpCode: Mã HTTP (mặc định là 200 OK)
function apiResponse($status, $message, $data = [], $result = true, $httpCode = 200)
{
    return response()->json([
        'status' => $status,
        'message' => $message,
        'data' => $data,
        'result' => $result
    ], $httpCode);
}