<?php
namespace App\Repositories\ManagementOrder;
use App\Repositories\ManagementOrder\ManagementOrderRepositoryInterface;
// Model
use App\Models\orders;
use App\Models\order_details;
use App\Models\product;
class ManagementOrderRepository implements ManagementOrderRepositoryInterface
{
    public function getUserOrders($userId, $page, $limit, $offset)
    {
        try {
            // Lấy danh sách đơn hàng của user
            $orders = Orders::where('order_user_id', $userId)
                ->orderBy('order_create_time', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get()
                ->toArray();

            if (empty($orders)) {
                return [
                    'success' => false,
                    'message' => "Không tìm thấy đơn hàng",
                    'httpCode' => 404,
                    'data' => null,
                ];
            }

            // Lấy danh sách chi tiết đơn hàng
            $orderCodes = array_column($orders, 'order_code');
            $orderDetails = order_details::whereIn('ordetail_order_code', $orderCodes)->get()->toArray();

            // Lấy danh sách sản phẩm
            $productCodes = array_unique(array_column($orderDetails, 'ordetail_product_code'));
            $products = Product::whereIn('product_code', $productCodes)->get()->toArray();

            // Chuyển danh sách sản phẩm thành mảng key-value
            $productMap = [];
            foreach ($products as $product) {
                $productMap[$product['product_code']] = $product;
            }

            // Gán thông tin sản phẩm vào chi tiết đơn hàng
            $dataOrder = [];
            foreach ($orders as $order) {
                $orderDetailsList = [];
                foreach ($orderDetails as $detail) {
                    if ($detail['ordetail_order_code'] == $order['order_code']) {
                        $detail['product'] = $productMap[$detail['ordetail_product_code']] ?? null;
                        $orderDetailsList[] = $detail;
                    }
                }

                $dataOrder[] = [
                    'order' => $order,
                    'details' => $orderDetailsList,
                ];
            }
            return [
                'success' => true,
                'message' => "Lấy dữ liệu thành công",
                'httpCode' => 200,
                'data' => [
                    'dataOrder' => $dataOrder,
                ],
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
    public function getOrderStatistics($userId)
    {
        try {
            // Tổng toàn bộ đơn hàng
            $CountOrderAll = orders::where('orders.order_user_id', '=', $userId)->count();
            // Tổng số đơn hàng đang xử lý
            $Count_OrderIsProcessing = orders::where([
                ['orders.order_user_id', '=', $userId],
                ['orders.order_status', '=', 1],
            ])->count();
            // Tổng số đơn hàng đang giao
            $Count_OrderIsBeingDelivered = orders::where([
                ['orders.order_user_id', '=', $userId],
                ['orders.order_status', '=', 2],
            ])->count();
            // Tổng số đơn hàng bị hủy
            $Count_OrderHasBeenCancelled = orders::where([
                ['orders.order_user_id', '=', $userId],
                ['orders.order_status', '=', 3],
            ])->count();
            // Tổng số đơn hàng đã giao
            $Count_OrderHasBeenDelivered = orders::where([
                ['orders.order_user_id', '=', $userId],
                ['orders.order_status', '=', 4],
            ])->count();
            // Tổng số đơn hàng hoàn tất
            $Count_OrderCompleted = orders::where([
                ['orders.order_user_id', '=', $userId],
                ['orders.order_status', '=', 5],
            ])->count();

            return [
                'success' => true,
                'message' => "Lấy dữ liệu thành công",
                'httpCode' => 200,
                'data' => [
                    'CountOrderAll' => $CountOrderAll ?? [],
                    'Count_OrderIsProcessing' => $Count_OrderIsProcessing ?? [],
                    'Count_OrderIsBeingDelivered' => $Count_OrderIsBeingDelivered ?? [],
                    'Count_OrderHasBeenCancelled' => $Count_OrderHasBeenCancelled ?? [],
                    'Count_OrderHasBeenDelivered' => $Count_OrderHasBeenDelivered ?? [],
                    'Count_OrderCompleted' => $Count_OrderCompleted ?? [],
                ],
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
    public function ChangeStatusOrder(array $data)
    {
        try {
            $status = $data['status'];
            $ordercode = $data['ordercode'];
            $order = orders::where("order_code", $ordercode)->first();
            if (!$order) {
                return apiResponse("error", "Không tìm thấy đơn hàng", [], false, 500);
            }
            if ($status == 1) {
                //Luồng thông báo cho admin để admin xác nhận đơn hàng

                // Cập nhật trạng thái đơn hàng
                $order->update([
                    'order_status' => $status,
                    'order_update_time' => time(),
                ]);
                return [
                    'success' => true,
                    'message' => "Xác nhận đơn hàng thành công",
                    'httpCode' => 200,
                    'data' => null,
                ];
            }

            if ($status == 2) {
                //Luồng thông báo cho người dùng đơn hàng đang giao
                $order->update([

                ]);
                return [
                    'success' => true,
                    'message' => "Đơn hàng đang được giao",
                    'httpCode' => 200,
                    'data' => null,
                ];
            }

            if ($status == 3) {
                //Luồng thông báo cho người dùng đơn hàng đã hủy và 
                $order->update([

                ]);
                return [
                    'success' => true,
                    'message' => "Hủy đơn hàng thành công",
                    'httpCode' => 200,
                    'data' => null,
                ];
            }


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