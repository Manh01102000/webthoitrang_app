<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Models\city;
use App\Models\distric;
use App\Models\commune;
use App\Models\cart;
use App\Models\order_confirm;
use App\Models\address_order;
use App\Models\orders;
use App\Models\order_details;


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
        // kèm lấy bản ghi được sét default
        $defaultAddress = null;
        foreach ($address_order as $address) {
            if ($address['address_orders_default'] == 1) {
                $defaultAddress = $address;
                break; // Dừng ngay khi tìm thấy
            }
        }
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
                'order_confirms.conf_cart_id',
            ])
            ->get();
        if ($dbconfirm->isEmpty()) { 
            return redirect('/gio-hang')->with('error', 'Không xác định được đơn hàng.');
        }
        $dataconfirm = $dbconfirm->toArray();
        $order_code = 'A' . mt_rand(11111, 99999);
        // ======= 6. Tổng hợp toàn bộ dữ liệu =======
        $dataAll = [
            'data' => InForAccount(),
            'Category' => getCategoryTree(),
            'datacity' => $cities,
            'datadistrict' => $districs,
            'datacommune' => $communes,
            'dataconfirm' => $dataconfirm,
            'address_order' => $address_order,
            'address_default' => $defaultAddress,
            'order_code' => $order_code
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

    public function AddDataInforship(Request $request)
    {
        try {
            // Tạo validator
            $validator = Validator::make($request->all(), [
                'address_orders_user_name' => 'required|string|max:255',
                'address_orders_user_phone' => 'required|string|max:15',
                'address_orders_user_email' => 'nullable|email|max:255',
                'address_orders_city' => 'required|string|max:255',
                'address_orders_district' => 'required|string|max:255',
                'address_orders_commune' => 'required|string|max:255',
                'address_orders_detail' => 'required|string|max:500',
            ]);

            // Nếu validation thất bại, trả về lỗi
            if ($validator->fails()) {
                return apiResponse("error", "Dữ liệu không hợp lệ", $validator->errors(), false, 422);
            }

            // ======= Lấy thông tin người dùng từ cookie & giải mã =======
            $UID_ENCRYPT = $_COOKIE['UID'] ?? null;
            $UT_ENCRYPT = $_COOKIE['UT'] ?? null;

            if (!$UID_ENCRYPT || !$UT_ENCRYPT) {
                return apiResponse("error", "Không tìm thấy thông tin người dùng", [], false, 401);
            }

            $key = base64_decode(getenv('KEY_ENCRYPT'));
            if (!$key) {
                return apiResponse("error", "Lỗi hệ thống: không thể giải mã dữ liệu", [], false, 500);
            }

            $user_id = decryptData($UID_ENCRYPT, $key);
            $userType = decryptData($UT_ENCRYPT, $key);

            if (!is_numeric($user_id) || !is_numeric($userType)) {
                return apiResponse("error", "Dữ liệu người dùng không hợp lệ", [], false, 401);
            }

            // Lưu dữ liệu vào DB
            address_order::create(
                $validator->validated() + [
                    'address_orders_default' => 0,
                    'address_orders_user_id' => $user_id
                ]
            );

            return apiResponse("success", "Thêm thông tin vận chuyển thành công", [], true, 200);
        } catch (\Exception $e) {
            \Log::error("Lỗi khi thêm thông tin vận chuyển: " . $e->getMessage());
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }

    public function SetShipDefalt(Request $request)
    {
        try {
            // Tạo validator
            $address_orders_id = $request->get('address_orders_id');
            // Nếu validation thất bại, trả về lỗi
            if ($address_orders_id == 0) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 403);
            }

            // ======= Lấy thông tin người dùng từ cookie & giải mã =======
            $UID_ENCRYPT = $_COOKIE['UID'] ?? null;
            $UT_ENCRYPT = $_COOKIE['UT'] ?? null;

            if (!$UID_ENCRYPT || !$UT_ENCRYPT) {
                return apiResponse("error", "Không tìm thấy thông tin người dùng", [], false, 401);
            }

            $key = base64_decode(getenv('KEY_ENCRYPT'));
            if (!$key) {
                return apiResponse("error", "Lỗi hệ thống: không thể giải mã dữ liệu", [], false, 500);
            }

            $user_id = decryptData($UID_ENCRYPT, $key);
            $userType = decryptData($UT_ENCRYPT, $key);

            if (!is_numeric($user_id) || !is_numeric($userType)) {
                return apiResponse("error", "Dữ liệu người dùng không hợp lệ", [], false, 401);
            }

            // Lưu dữ liệu vào DB
            // Đặt tất cả địa chỉ của user này về 0 trước
            address_order::where('address_orders_user_id', $user_id)
                ->update(['address_orders_default' => 0]);

            // Cập nhật địa chỉ được chọn thành mặc định (1)
            address_order::where('address_orders_id', $address_orders_id)
                ->update(['address_orders_default' => 1]);

            return apiResponse("success", "Cập nhật địa chỉ mặc định thành công", [], true, 200);
        } catch (\Exception $e) {
            \Log::error("Lỗi khi Cập nhật địa chỉ mặc định: " . $e->getMessage());
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }

    public function PayMent(Request $request)
    {
        try {
            // Tạo validator
            $validator = Validator::make($request->all(), [
                "order_code" => 'required',
                "address_orders_user_name" => 'required',
                "address_orders_detail" => 'required',
                "address_orders_user_phone" => 'required',
                "address_orders_user_email" => 'required',
                "arr_confirm_id" => 'required',
                "arr_cart_id" => 'required',
                "arr_product_code" => 'required',
                "arr_product_amount" => 'required',
                "arr_product_classification" => 'required',
                "arr_product_totalprice" => 'required',
                "arr_product_feeship" => 'required',
                "arr_product_unitprice" => 'required',
                "total_all_payment" => 'required',
                "payment_type" => 'required',
                "account_number" => 'required',
                "bank_name" => 'required',
                "account_owner" => 'required',
                "bank_branch" => 'required',
                "bank_content_tranfer" => 'required',
            ]);

            // Nếu validation thất bại, trả về lỗi
            if ($validator->fails()) {
                return apiResponse("error", "Dữ liệu không hợp lệ", $validator->errors(), false, 422);
            }

            // Lấy thông tin người dùng từ cookie
            $UID_ENCRYPT = request()->cookie('UID');
            $UT_ENCRYPT = request()->cookie('UT');

            if (!$UID_ENCRYPT || !$UT_ENCRYPT) {
                return apiResponse("error", "Không tìm thấy thông tin người dùng", [], false, 401);
            }

            $key = base64_decode(env('KEY_ENCRYPT'));
            if (!$key) {
                return apiResponse("error", "Lỗi hệ thống: không thể giải mã dữ liệu", [], false, 500);
            }

            $user_id = decryptData($UID_ENCRYPT, $key);
            $userType = decryptData($UT_ENCRYPT, $key);

            if (!is_numeric($user_id) || !is_numeric($userType)) {
                return apiResponse("error", "Dữ liệu người dùng không hợp lệ", [], false, 401);
            }

            $arr_product_code = explode(',', $validator->validated()['arr_product_code']);
            $arr_product_amount = explode(',', $validator->validated()['arr_product_amount']);
            $arr_product_classification = explode(',', $validator->validated()['arr_product_classification']);
            $arr_product_totalprice = explode(',', $validator->validated()['arr_product_totalprice']);
            $arr_product_feeship = explode(',', $validator->validated()['arr_product_feeship']);
            $arr_product_unitprice = explode(',', $validator->validated()['arr_product_unitprice']);

            $array_insert = [];
            foreach ($arr_product_code as $key => $value) {
                $array_insert[] = [
                    'ordetail_order_code' => $validator->validated()['order_code'],
                    'ordetail_product_code' => $value,
                    'ordetail_product_amount' => $arr_product_amount[$key],
                    'ordetail_product_classification' => $arr_product_classification[$key],
                    'ordetail_product_totalprice' => $arr_product_totalprice[$key],
                    'ordetail_product_unitprice' => $arr_product_unitprice[$key],
                    'ordetail_product_feeship' => $arr_product_feeship[$key],
                    'ordetail_created_at' => time(),
                    'ordetail_updated_at' => time(),
                ];
            }

            // DB::transaction
            // ✅ Đảm bảo tính toàn vẹn dữ liệu
            // ✅ Nếu có lỗi xảy ra, tất cả thay đổi sẽ bị rollback (hủy bỏ), không bị mất dữ liệu
            // ✅ Tránh trường hợp giỏ hàng bị xóa trước khi đơn hàng được tạo thành công
            DB::transaction(function () use ($validator, $user_id, $array_insert) {
                // Lưu dữ liệu bảng đơn hàng
                orders::create([
                    'order_code' => $validator->validated()['order_code'],
                    'order_user_id' => $user_id,
                    'order_user_phone' => $validator->validated()['address_orders_user_phone'],
                    'order_user_email' => $validator->validated()['address_orders_user_email'],
                    'order_address_ship' => $validator->validated()['address_orders_detail'],
                    'order_total_price' => $validator->validated()['total_all_payment'],
                    'order_create_time' => time(),
                    'order_update_time' => time(),
                    'order_paymentMethod' => $validator->validated()['payment_type'],
                    'order_name_bank' => $validator->validated()['bank_name'],
                    'order_branch_bank' => $validator->validated()['bank_branch'],
                    'order_account_bank' => $validator->validated()['account_number'],
                    'order_account_holder' => $validator->validated()['account_owner'],
                    'order_content_bank' => $validator->validated()['bank_content_tranfer'],
                    'order_user_note' => request()->get('payment_note'),
                ]);
                // Lưu dữ liệu bảng chi tiết đơn hàng
                order_details::insert($array_insert);
                // Xóa giỏ hàng
                if (!empty($validator->validated()['arr_cart_id'])) {
                    $arr_cart_id = explode(',', $validator->validated()['arr_cart_id']);
                    cart::whereIn('cart_id', $arr_cart_id)->delete();
                }
                // Xóa xác nhận đơn hàng
                if (!empty($validator->validated()['arr_confirm_id'])) {
                    $arr_confirm_id = explode(',', $validator->validated()['arr_confirm_id']);
                    order_confirm::whereIn('order_confirm_id', $arr_confirm_id)->delete();
                }
            });
            return apiResponse("success", "Đặt hàng thành công", [], true, 200);
        } catch (\Exception $e) {
            \Log::error("Lỗi khi đặt hàng: " . $e->getMessage());
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }

}
