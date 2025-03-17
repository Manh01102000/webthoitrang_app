<?php
namespace App\Repositories\Order;

use App\Models\cart;
use App\Models\order_confirm;
use Exception;
use Illuminate\Support\Facades\Log;

class OrderRepository implements OrderRepositoryInterface
{
    public function confirmOrder($user_id, $arr_cart_id, $arr_unitprice, $arr_total_price, $arr_feeship = '')
    {
        try {

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
            // trả response về controller
            return $this->successResponse("Xác nhận đơn hàng thành công!");
        } catch (Exception $e) {
            Log::error("Lỗi khi xác nhận đơn hàng: " . $e->getMessage(), ['user_id' => $user_id ?? null]);
            return $this->errorResponse("Lỗi server, vui lòng thử lại sau.", 500);
        }
    }

    public function confirmOrderBuyNow($user_id, $unitprice, $total_price, $feeship, $product_code, $product_amount, $product_classification)
    {
        try {
            // XÓA TẤT CẢ CÁC SẢN PHẨM CŨ CỦA NGƯỜI DÙNG TRONG BẢNG XÁC NHẬN ĐƠN HÀNG
            order_confirm::where('conf_user_id', $user_id)->delete();

            $code_order = 'M' . mt_rand(11111, 99999);

            $orders = [
                'conf_code_order' => $code_order,
                'conf_user_id' => $user_id,
                'conf_product_code' => $product_code,
                'conf_product_amount' => $product_amount ?? 0,
                'conf_product_classification' => $product_classification,
                'conf_total_price' => $total_price ?? 0,
                'conf_unitprice' => $unitprice ?? 0,
                'conf_feeship' => $feeship ?? 0,
                'conf_create_time' => time(),
                'conf_update_time' => time(),
            ];

            // Thêm sản phẩm mới vào bảng xác nhận đơn hàng
            order_confirm::insert($orders);
            // trả response về controller
            return $this->successResponse("Xác nhận đơn hàng thành công!");
        } catch (Exception $e) {
            Log::error("Lỗi khi xác nhận đơn hàng: " . $e->getMessage(), ['user_id' => $user_id ?? null]);
            return $this->errorResponse("Lỗi server, vui lòng thử lại sau.", 500);
        }
    }

    /**
     * Trả về phản hồi thành công
     */
    private function successResponse($message, $data = [])
    {
        return [
            'success' => true,
            'message' => $message,
            'httpCode' => 200,
            'data' => $data,
        ];
    }

    /**
     * Trả về phản hồi thất bại
     */
    private function errorResponse($message, $httpCode = 500)
    {
        return [
            'success' => false,
            'message' => $message,
            'httpCode' => $httpCode,
            'data' => null,
        ];
    }
}
