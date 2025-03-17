<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// import OrderRepositoryInterface
use App\Repositories\Order\OrderRepositoryInterface;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function ConfirmOrder(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            // Nhận dữ liệu từ request
            $arr_cart_id = $request->get('arr_cart_id');
            $arr_unitprice = $request->get('arr_unitprice');
            $arr_total_price = $request->get('arr_total_price');
            $arr_feeship = $request->get('arr_feeship', '');
            // Kiểm tra dữ liệu đầu vào
            if (!$arr_cart_id || !$arr_total_price || !$arr_unitprice) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }
            // Chuyển đổi dữ liệu thành mảng
            $arr_cart_id = explode(',', $arr_cart_id);
            $arr_total_price = explode(',', $arr_total_price);
            $arr_unitprice = explode(',', $arr_unitprice);
            $arr_feeship = explode(',', $arr_feeship);
            /** === Lấy dữ liệu từ repository === */
            $response = $this->orderRepository->confirmOrder($user_id, $arr_cart_id, $arr_unitprice, $arr_total_price, $arr_feeship);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            \Log::error("Lỗi khi thêm đơn hàng: " . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => $user_id ?? null
            ]);
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }

    public function ConfirmOrderBuyNow(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            // Nhận dữ liệu từ request
            $unitprice = $request->get('unitprice');
            $total_price = $request->get('total_price');
            $feeship = $request->get('feeship', '');
            $product_code = $request->get('product_code', '');
            $product_amount = $request->get('product_amount', '');
            $product_classification = $request->get('product_classification', '');
            // Kiểm tra dữ liệu đầu vào
            if (!$total_price || !$unitprice || !$product_code || !$product_amount || !$product_classification) {
                return apiResponse("error", "Thiếu dữ liệu truyền lên", [], false, 400);
            }
            /** === Lấy dữ liệu từ repository === */
            $response = $this->orderRepository->confirmOrderBuyNow($user_id, $unitprice, $total_price, $feeship, $product_code, $product_amount, $product_classification);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            \Log::error("Lỗi khi thêm đơn hàng: " . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => $user_id ?? null
            ]);
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }
}
