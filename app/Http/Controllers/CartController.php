<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\order_confirm;

class CartController extends Controller
{
    public function index()
    {
        /** === 1. Lấy thông tin người dùng từ cookie & giải mã === */
        $UID_ENCRYPT = $_COOKIE['UID'] ?? 0;
        $UT_ENCRYPT = $_COOKIE['UT'] ?? 0;
        $key = base64_decode(getenv('KEY_ENCRYPT'));
        $user_id = decryptData($UID_ENCRYPT, $key);
        $userType = decryptData($UT_ENCRYPT, $key);

        /** === 2. Lấy dữ liệu giỏ hàng từ database === */
        $dbcart = cart::leftJoin('products', 'products.product_code', '=', 'carts.cart_product_code')
            ->leftJoin('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code') // Chuyển sang leftJoin để tránh mất sản phẩm không có giảm giá
            ->where('carts.cart_user_id', $user_id)
            ->select(
                'products.product_code',
                'products.product_name',
                'products.product_create_time',
                'products.product_brand',
                'products.product_sizes',
                'products.product_colors',
                'products.product_classification',
                'products.product_stock',
                'products.product_price',
                'products.product_images',
                'products.product_ship',
                'products.product_feeship',
                'products.product_sold',
                'manage_discounts.discount_product_code',
                'manage_discounts.discount_active',
                'manage_discounts.discount_type',
                'manage_discounts.discount_start_time',
                'manage_discounts.discount_end_time',
                'manage_discounts.discount_price',
                'carts.cart_product_amount',
                'carts.cart_product_classification',
                'carts.cart_product_code',
                'carts.cart_id',
            )
            ->get();


        $datacart = $dbcart ? $dbcart->toArray() : [];

        /** === 3. Chuẩn bị dữ liệu SEO === */
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Giỏ Hàng Của Bạn - Fashion Houses",
            'seo_desc' => "Xem lại các sản phẩm thời trang trong giỏ hàng của bạn tại Fashion Houses. Hoàn tất đơn hàng để sở hữu những thiết kế mới nhất từ các nhà mốt hàng đầu!",
            'seo_keyword' => "Fashion Houses giỏ hàng, sản phẩm thời trang, mua sắm thời trang, thanh toán đơn hàng, thời trang cao cấp, giỏ hàng trực tuyến, xu hướng thời trang, đặt hàng thời trang.",
            'canonical' => $domain . '/gio-hang',
        ];

        /** === 4. Chuẩn bị dữ liệu giao diện (UI) === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        $data = InForAccount();
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'datacity' => '',
            'datadistrict' => '',
            'datacommune' => '',
            'datacart' => $datacart
        ];

        /** === 5. Trả về view 'cart' với dữ liệu === */
        return view('cart', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

    public function AddToCart(Request $request)
    {
        try {
            $product_amount = $request->get('product_amount');
            $product_code = $request->get('product_code');
            $product_size = $request->get('product_size');
            $product_color = $request->get('product_color');

            if (!$product_code || !$product_amount) {
                return apiResponse("error", "Thiếu mã sản phẩm hoặc số lượng", [], false, 400);
            }

            $product_classification = trim($product_size . ',' . $product_color);

            // Lấy cookie
            $UID_ENCRYPT = $_COOKIE['UID'] ?? 0;
            $UT_ENCRYPT = $_COOKIE['UT'] ?? 0;
            $key = base64_decode(getenv('KEY_ENCRYPT'));
            $user_id = decryptData($UID_ENCRYPT, $key);
            $userType = decryptData($UT_ENCRYPT, $key);

            if (!$user_id || !$userType) {
                return apiResponse("error", "Không xác định được người dùng", [], false, 400);
            }

            // Kiểm tra sản phẩm trong giỏ hàng
            $dataCart = cart::where([
                ['cart_product_code', $product_code],
                ['cart_user_id', $user_id],
                ['cart_product_classification', $product_classification]
            ])->first();

            if ($dataCart) {
                // Nếu có -> Cập nhật số lượng
                cart::where('cart_id', $dataCart->cart_id)->update([
                    'cart_product_amount' => $dataCart->cart_product_amount + (int) $product_amount,
                    'cart_update_time' => time()
                ]);
                return apiResponse("success", "Cập nhật dữ liệu giỏ hàng thành công", [], true, 200);
            }

            // Nếu chưa có -> Thêm mới
            cart::create([
                'cart_user_id' => $user_id,
                'cart_product_code' => $product_code,
                'cart_product_amount' => (int) $product_amount,
                'cart_product_classification' => $product_classification,
                'cart_create_time' => time(),
                'cart_update_time' => time()
            ]);

            return apiResponse("success", "Thêm dữ liệu giỏ hàng thành công", [], true, 200);
        } catch (\Exception $e) {
            \Log::error("Có lỗi xảy ra khi thêm giỏ hàng - " . $e->getMessage());
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

    public function updateCartCountBuy(Request $request)
    {
        try {
            // Nhận dữ liệu từ request
            $cart_product_amount = (int) $request->get('cart_product_amount');
            $cart_id = (int) $request->get('cart_id');

            // Kiểm tra dữ liệu đầu vào (tránh lỗi null hoặc giá trị không hợp lệ)
            if (!$cart_product_amount || !$cart_id) {
                return apiResponse("error", "Thiếu ID giỏ hàng hoặc số lượng", [], false, 400);
            }

            // Lấy thông tin người dùng từ cookie
            $UID_ENCRYPT = $_COOKIE['UID'] ?? null;
            $UT_ENCRYPT = $_COOKIE['UT'] ?? null;

            if (!$UID_ENCRYPT || !$UT_ENCRYPT) {
                return apiResponse("error", "Không xác định được người dùng", [], false, 400);
            }

            $key = base64_decode(getenv('KEY_ENCRYPT'));
            $user_id = decryptData($UID_ENCRYPT, $key);
            $userType = decryptData($UT_ENCRYPT, $key);

            if (!$user_id || !$userType) {
                return apiResponse("error", "Không xác định được người dùng", [], false, 400);
            }

            // Kiểm tra giỏ hàng có tồn tại và thuộc về user không
            $cart = cart::where('cart_id', $cart_id)
                ->where('cart_user_id', $user_id)
                ->first();

            if (!$cart) {
                return apiResponse("error", "Giỏ hàng không tồn tại hoặc không thuộc về bạn", [], false, 403);
            }

            // Chỉ cập nhật nếu số lượng thay đổi
            if ($cart->cart_product_amount != $cart_product_amount) {
                $cart->where('cart_id', $cart->cart_id)->update([
                    'cart_product_amount' => $cart_product_amount,
                    'cart_update_time' => time()
                ]);
            }

            return apiResponse("success", "Cập nhật giỏ hàng thành công", [], true, 200);
        } catch (\Exception $e) {
            \Log::error("Lỗi khi cập nhật giỏ hàng: " . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => $user_id ?? null
            ]);
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }

    public function ConfirmOrder(Request $request)
    {
        try {
            // Nhận dữ liệu từ request
            $arr_cart_id = $request->get('arr_cart_id');
            $arr_unitprice = $request->get('arr_unitprice');
            $arr_total_price = $request->get('arr_total_price');
            $arr_feeship = $request->get('arr_feeship', '');

            // Kiểm tra dữ liệu đầu vào
            if (!$arr_cart_id || !$arr_total_price || !$arr_unitprice) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }

            // Lấy thông tin người dùng từ cookie
            $UID_ENCRYPT = $_COOKIE['UID'] ?? null;
            $UT_ENCRYPT = $_COOKIE['UT'] ?? null;

            if (!$UID_ENCRYPT || !$UT_ENCRYPT) {
                return apiResponse("error", "Không xác định được người dùng", [], false, 400);
            }

            $key = base64_decode(getenv('KEY_ENCRYPT'));
            $user_id = decryptData($UID_ENCRYPT, $key);
            $userType = decryptData($UT_ENCRYPT, $key);

            if (!$user_id || !$userType) {
                return apiResponse("error", "Không xác định được người dùng", [], false, 400);
            }

            // Chuyển đổi dữ liệu thành mảng
            $arr_cart_id = explode(',', $arr_cart_id);
            $arr_total_price = explode(',', $arr_total_price);
            $arr_unitprice = explode(',', $arr_unitprice);
            $arr_feeship = explode(',', $arr_feeship);

            // XÓA TẤT CẢ CÁC SẢN PHẨM CŨ CỦA NGƯỜI DÙNG TRONG BẢNG XÁC NHẬN ĐƠN HÀNG
            order_confirm::where('conf_user_id', $user_id)->delete();

            // Lấy dữ liệu giỏ hàng trong một truy vấn
            $carts = Cart::whereIn('cart_id', $arr_cart_id)
                ->where('cart_user_id', $user_id)
                ->select([
                    'cart_id',
                    'cart_product_code',
                    'cart_product_amount',
                    'cart_product_classification',
                ])
                ->get()
                ->keyBy('cart_id');

            $orders = [];
            foreach ($arr_cart_id as $key => $cart_id) {
                if (!isset($carts[$cart_id])) {
                    continue;
                }

                $cart = $carts[$cart_id];
                $code_order = 'M' . mt_rand(11111, 99999);

                $orders[] = [
                    'conf_code_order' => $code_order,
                    'conf_cart_id' => $cart_id,
                    'conf_user_id' => $user_id,
                    'conf_product_code' => $cart->cart_product_code,
                    'conf_product_amount' => $cart->cart_product_amount,
                    'conf_product_classification' => $cart->cart_product_classification,
                    'conf_total_price' => $arr_total_price[$key] ?? 0,
                    'conf_unitprice' => $arr_unitprice[$key] ?? 0,
                    'conf_feeship' => $arr_feeship[$key] ?? 0,
                    'conf_create_time' => time(),
                    'conf_update_time' => time(),
                ];
            }

            // Thêm sản phẩm mới vào bảng xác nhận đơn hàng
            if (!empty($orders)) {
                order_confirm::insert($orders);
            }

            return apiResponse("success", "Xác nhận đơn hàng thành công", [], true, 200);
        } catch (\Exception $e) {
            \Log::error("Lỗi khi thêm đơn hàng: " . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => $user_id ?? null
            ]);
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }
}
