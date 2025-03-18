<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
// MODEL
use App\Models\city;
use App\Models\distric;
use App\Models\commune;
use App\Models\cart;
use App\Models\order_confirm;
use App\Models\address_order;
use App\Models\orders;
use App\Models\order_details;
// JWT
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
// COOKIE
use Illuminate\Support\Facades\Cookie;
// 
use App\Repositories\ComfirmOrder\ConfirmOrderRepositoryInterface;

class ConfirmOrderController extends Controller
{
    protected $ConfirmOrderRepository;
    public function __construct(ConfirmOrderRepositoryInterface $ConfirmOrderRepository)
    {
        $this->ConfirmOrderRepository = $ConfirmOrderRepository;
    }
    public function index()
    {
        /** === Khai báo thư viện sử dụng === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        /** === Xây dựng SEO === */
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Xác Nhận Đơn Hàng - Fashion Houses",
            'seo_desc' => "Cảm ơn bạn đã đặt hàng tại Fashion Houses! Kiểm tra chi tiết đơn hàng và xác nhận giao dịch thành công. Chúng tôi sẽ sớm giao hàng đến bạn.",
            'seo_keyword' => "Fashion Houses xác nhận đơn hàng, đơn hàng thành công, trạng thái đơn hàng, theo dõi đơn hàng, mua sắm thời trang, đơn hàng Fashion Houses, giao dịch thành công, thời trang cao cấp.",
            'canonical' => $domain . '/xac-nhan-don-hang',
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
                'products.product_id',
                'products.product_name',
                'products.product_alias',
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
        /** === 6. Xây dựng breadcrumb === */
        $breadcrumbItems = [
            ['title' => 'Trang chủ', 'url' => '/', 'class' => 'otherssite'],
            [
                'title' => "Giỏ hàng",
                'url' => '/gio-hang',
                'class' => 'otherssite'
            ],
            [
                'title' => "Xác nhận đơn hàng",
                'url' => '',
                'class' => 'thissite'
            ]
        ];
        // ======= 7. Tổng hợp toàn bộ dữ liệu =======
        $dataAll = [
            'data' => InForAccount(),
            'breadcrumbItems' => $breadcrumbItems,
            'Category' => getCategoryTree(),
            'datacity' => $cities,
            'datadistrict' => $districs,
            'datacommune' => $communes,
            'dataconfirm' => $dataconfirm,
            'address_order' => $address_order,
            'address_default' => $defaultAddress,
            'order_code' => $order_code
        ];


        /** === Trả về view với dữ liệu === */
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
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;

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

            $data = [
                'address_orders_user_name' => $validator->validated()['address_orders_user_name'],
                'address_orders_user_phone' => $validator->validated()['address_orders_user_phone'],
                'address_orders_user_email' => $validator->validated()['address_orders_user_email'],
                'address_orders_city' => $validator->validated()['address_orders_city'],
                'address_orders_district' => $validator->validated()['address_orders_district'],
                'address_orders_commune' => $validator->validated()['address_orders_commune'],
                'address_orders_detail' => $validator->validated()['address_orders_detail'],
                'address_orders_default' => 0,
                'address_orders_user_id' => $user_id
            ];
            /** === Lấy dữ liệu từ repository === */
            $response = $this->ConfirmOrderRepository->AddDataInforship($data);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            \Log::error("Lỗi khi thêm thông tin vận chuyển: " . $e->getMessage());
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }

    public function SetShipDefalt(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            // Tạo validator
            $address_orders_id = $request->get('address_orders_id');
            // Nếu validation thất bại, trả về lỗi
            if ($address_orders_id == 0) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 403);
            }
            $data = [
                'user_id' => $user_id,
                'userType' => $userType,
                'address_orders_id' => $address_orders_id,
            ];
            /** === Lấy dữ liệu từ repository === */
            $response = $this->ConfirmOrderRepository->SetShipDefalt($data);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            \Log::error("Lỗi khi Cập nhật địa chỉ mặc định: " . $e->getMessage());
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }

    public function PayMent(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            // Tạo validator
            $arr_cart_id = $request->get('arr_cart_id', []);
            $payment_note = $request->get('payment_note', '');
            $validator = Validator::make($request->all(), [
                "order_code" => 'required',
                "address_orders_user_name" => 'required',
                "address_orders_detail" => 'required',
                "address_orders_user_phone" => 'required',
                "address_orders_user_email" => 'required',
                "arr_confirm_id" => 'required',
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

            $data = [
                "user_id" => $user_id,
                "userType" => $userType,
                "arr_cart_id" => $arr_cart_id,
                "payment_note" => $payment_note,
                "order_code" => $validator->validated()['order_code'],
                "address_orders_user_name" => $validator->validated()['address_orders_user_name'],
                "address_orders_detail" => $validator->validated()['address_orders_detail'],
                "address_orders_user_phone" => $validator->validated()['address_orders_user_phone'],
                "address_orders_user_email" => $validator->validated()['address_orders_user_email'],
                "arr_confirm_id" => $validator->validated()['arr_confirm_id'],
                "arr_product_code" => $validator->validated()['arr_product_code'],
                "arr_product_amount" => $validator->validated()['arr_product_amount'],
                "arr_product_classification" => $validator->validated()['arr_product_classification'],
                "arr_product_totalprice" => $validator->validated()['arr_product_totalprice'],
                "arr_product_feeship" => $validator->validated()['arr_product_feeship'],
                "arr_product_unitprice" => $validator->validated()['arr_product_unitprice'],
                "total_all_payment" => $validator->validated()['total_all_payment'],
                "payment_type" => $validator->validated()['payment_type'],
                "account_number" => $validator->validated()['account_number'],
                "bank_name" => $validator->validated()['bank_name'],
                "account_owner" => $validator->validated()['account_owner'],
                "bank_branch" => $validator->validated()['bank_branch'],
                "bank_content_tranfer" => $validator->validated()['bank_content_tranfer'],
            ];
            /** === Lấy dữ liệu từ repository === */
            $response = $this->ConfirmOrderRepository->PayMent($data);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            \Log::error("Lỗi khi đặt hàng: " . $e->getMessage());
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }

}
