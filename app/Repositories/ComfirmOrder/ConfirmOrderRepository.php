<?php
namespace App\Repositories\ComfirmOrder;

use App\Repositories\ComfirmOrder\ConfirmOrderRepositoryInterface;
// 
use Illuminate\Support\Facades\DB;
// Validator
use Illuminate\Support\Facades\Validator;
// Model
use App\Models\address_order;
use App\Models\orders;
use App\Models\order_details;
use App\Models\order_confirm;
use App\Models\cart;

class ConfirmOrderRepository implements ConfirmOrderRepositoryInterface
{
    public function AddDataInforship(array $data)
    {
        try {
            // Lưu dữ liệu vào DB
            address_order::create([
                'address_orders_user_name' => $data['address_orders_user_name'],
                'address_orders_user_phone' => $data['address_orders_user_phone'],
                'address_orders_user_email' => $data['address_orders_user_email'],
                'address_orders_city' => $data['address_orders_city'],
                'address_orders_district' => $data['address_orders_district'],
                'address_orders_commune' => $data['address_orders_commune'],
                'address_orders_detail' => $data['address_orders_detail'],
                'address_orders_default' => $data['address_orders_default'],
                'address_orders_user_id' => $data['user_id']
            ]);
            return [
                'success' => true,
                'message' => "Thêm thông tin vận chuyển thành công",
                'httpCode' => 200,
                'data' => null,
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
    public function SetShipDefalt(array $data)
    {
        try {

            $user_id = $data['user_id'];
            $userType = $data['userType'];
            $address_orders_id = $data['address_orders_id'];
            // Lưu dữ liệu vào DB
            // Đặt tất cả địa chỉ của user này về 0 trước
            address_order::where('address_orders_user_id', $user_id)
                ->update(['address_orders_default' => 0]);

            // Cập nhật địa chỉ được chọn thành mặc định (1)
            address_order::where('address_orders_id', $address_orders_id)
                ->update(['address_orders_default' => 1]);

            return [
                'success' => true,
                'message' => "Cập nhật địa chỉ mặc định thành công",
                'httpCode' => 200,
                'data' => null,
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
    public function PayMent(array $data)
    {
        try {
            $user_id = $data['user_id'];
            $userType = $data['userType'];
            $arr_cart_id = $data['arr_cart_id'];
            $arr_product_code = explode(',', $data['arr_product_code']);
            $arr_product_amount = explode(',', $data['arr_product_amount']);
            $arr_product_classification = explode(',', $data['arr_product_classification']);
            $arr_product_totalprice = explode(',', $data['arr_product_totalprice']);
            $arr_product_feeship = explode(',', $data['arr_product_feeship']);
            $arr_product_unitprice = explode(',', $data['arr_product_unitprice']);

            $array_insert = [];
            foreach ($arr_product_code as $key => $value) {
                $array_insert[] = [
                    'ordetail_order_code' => $data['order_code'],
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
            DB::transaction(function () use ($data, $user_id, $arr_cart_id, $array_insert) {
                // Lưu dữ liệu bảng đơn hàng
                orders::create([
                    'order_code' => $data['order_code'],
                    'order_user_id' => $user_id,
                    'order_user_phone' => $data['address_orders_user_phone'],
                    'order_user_email' => $data['address_orders_user_email'],
                    'order_address_ship' => $data['address_orders_detail'],
                    'order_total_price' => $data['total_all_payment'],
                    'order_create_time' => time(),
                    'order_update_time' => time(),
                    'order_paymentMethod' => $data['payment_type'],
                    'order_name_bank' => $data['bank_name'],
                    'order_branch_bank' => $data['bank_branch'],
                    'order_account_bank' => $data['account_number'],
                    'order_account_holder' => $data['account_owner'],
                    'order_content_bank' => $data['bank_content_tranfer'],
                    'order_user_note' => $data['payment_note'],
                ]);
                // Lưu dữ liệu bảng chi tiết đơn hàng
                order_details::insert($array_insert);
                // Xóa giỏ hàng
                if (!empty($arr_cart_id)) {
                    $arr_cart_id = explode(',', $data['arr_cart_id']);
                    cart::whereIn('cart_id', $arr_cart_id)->delete();
                }
                // Xóa xác nhận đơn hàng
                if (!empty($data['arr_confirm_id'])) {
                    $arr_confirm_id = explode(',', $data['arr_confirm_id']);
                    order_confirm::whereIn('order_confirm_id', $arr_confirm_id)->delete();
                }
            });
            return [
                'success' => true,
                'message' => "Đặt hàng thành công",
                'httpCode' => 200,
                'data' => null,
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