<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\city;
use App\Models\distric;
use App\Models\commune;
use App\Models\order_confirm;
use App\Models\address_order;

class ConfirmOrderController extends Controller
{
    public function index()
    {
        // ======= 1. Khai báo thư viện sử dụng =======
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];

        // ======= 2. Lấy dữ liệu địa lý (Tỉnh, Huyện, Xã) =======
        $cities = Cache::rememberForever('cities', function () {
            return City::all()->toArray();
        });

        $districs = distric::all()->toArray();
        $communes = commune::all()->toArray();
        // ======= 3. Lấy thông tin người dùng từ cookie & giải mã =======
        $UID_ENCRYPT = $_COOKIE['UID'] ?? 0;
        $UT_ENCRYPT = $_COOKIE['UT'] ?? 0;
        $key = base64_decode(getenv('KEY_ENCRYPT'));
        $user_id = decryptData($UID_ENCRYPT, $key);
        $userType = decryptData($UT_ENCRYPT, $key);

        // Nếu không xác định được người dùng, có thể redirect về trang giỏ hàng
        if (!$user_id || !$userType) {
            return redirect('/gio-hang')->with('error', 'Không xác định được người dùng.');
        }
        // ======= 4. Lấy dữ liệu thông tin nhận hàng =======
        $dbaddressorder = address_order::where('address_orders_user_id', $user_id)
            ->select([
                'address_orders_id',
                'address_orders_user_name',
                'address_orders_user_phone',
                'address_orders_user_email',
                'address_orders_city',
                'address_orders_district',
                'address_orders_commune',
                'address_orders_detail',
                'address_orders_default',
            ])
            ->get();
        $address_order = $dbaddressorder ? $dbaddressorder->toArray() : [];
        // ======= 5. Lấy thông tin sản phẩm trong bảng xác nhận đơn hàng =======
        $dbconfirm = order_confirm::leftJoin('products', 'products.product_code', '=', 'order_confirms.conf_product_code')
            ->leftJoin('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
            ->where('order_confirms.conf_user_id', $user_id)
            ->select([
                'products.product_name',
                'products.product_code',
                'products.product_create_time',
                'products.product_brand',
                'products.product_images',
                'order_confirms.conf_product_amount',
                'order_confirms.conf_product_classification',
                'order_confirms.conf_code_order',
                'order_confirms.order_confirm_id',
                'order_confirms.conf_total_price',
                'order_confirms.conf_unitprice',
                'order_confirms.conf_feeship',
            ])
            ->get();

        $dataconfirm = $dbconfirm ? $dbconfirm->toArray() : [];
        // ======= 6. Tổng hợp toàn bộ dữ liệu =======
        $dataAll = [
            'data' => InForAccount(),
            'Category' => getCategoryTree(),
            'datacity' => $cities,
            'datadistrict' => $districs,
            'datacommune' => $communes,
            'dataconfirm' => $dataconfirm,
            'address_order' => $address_order
        ];
        // ======= 7. Cấu hình SEO =======
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Xác Nhận Đơn Hàng - Fashion Houses",
            'seo_desc' => "Cảm ơn bạn đã đặt hàng tại Fashion Houses! Kiểm tra chi tiết đơn hàng và xác nhận giao dịch thành công. Chúng tôi sẽ sớm giao hàng đến bạn.",
            'seo_keyword' => "Fashion Houses xác nhận đơn hàng, đơn hàng thành công, trạng thái đơn hàng, theo dõi đơn hàng, mua sắm thời trang, đơn hàng Fashion Houses, giao dịch thành công, thời trang cao cấp.",
            'canonical' => $domain . '/xac-nhan-don-hang',
        ];

        // ======= 8. Trả về View =======
        return view('confirmOrder', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

}
