<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
// Model
use App\Models\User;
use App\Models\orders;
use App\Models\order_details;

class ManagementOrderController extends Controller
{
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
            'seo_title' => "Quản Lý Đơn Hàng - Theo Dõi & Cập Nhật Trạng Thái | Fashion Houses",
            'seo_desc' => "Dễ dàng theo dõi, kiểm tra trạng thái đơn hàng và lịch sử mua sắm của bạn tại Fashion Houses. Cập nhật nhanh chóng & hỗ trợ tận tâm!",
            'seo_keyword' => "quản lý đơn hàng, theo dõi đơn hàng, trạng thái đơn hàng, lịch sử mua sắm, kiểm tra đơn hàng, Fashion Houses",
            'canonical' => $domain . '/quan-ly-tai-khoan',
        ];

        /** === Xây dựng breadcrumb === */
        $breadcrumbItems = [
            ['title' => 'Trang chủ', 'url' => '/', 'class' => 'otherssite'],
            ['title' => "Quản lý đơn hàng", 'url' => '', 'class' => 'thissite']
        ];

        /** === Chuẩn bị dữ liệu === */
        $data = InForAccount();
        $user_id = $data['data']['us_id'];

        // Lấy danh sách đơn hàng (chuyển về dạng mảng)
        $page = request()->get('page', 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $orders = orders::where('orders.order_user_id', $user_id)
            ->orderBy('orders.order_create_time', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->toArray(); // Chuyển thành mảng

        // Lấy danh sách chi tiết đơn hàng theo danh sách mã đơn hàng (chuyển về mảng)
        $orderCodes = array_column($orders, 'order_code');
        $orderDetails = order_details::whereIn('ordetail_order_code', $orderCodes)->get()->toArray();

        // Lấy danh sách sản phẩm theo mã sản phẩm trong đơn hàng (chuyển về mảng)
        $productCodes = array_unique(array_column($orderDetails, 'ordetail_product_code'));
        $products = product::whereIn('product_code', $productCodes)->get()->toArray();

        // Chuyển danh sách sản phẩm thành mảng key-value để dễ truy xuất
        $productMap = [];
        foreach ($products as $product) {
            $productMap[$product['product_code']] = $product;
        }

        // Gán dữ liệu sản phẩm vào từng chi tiết đơn hàng
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

        // Tổng số đơn hàng để hiển thị phân trang
        // Tổng toàn bộ đơn hàng
        $CountOrderAll = orders::where('orders.order_user_id', '=', $user_id)->count();
        // Tổng số đơn hàng đang xử lý
        $Count_OrderIsProcessing = orders::where([
            ['orders.order_user_id', '=', $user_id],
            ['orders.order_status', '=', 1],
        ])->count();
        // Tổng số đơn hàng đang giao
        $Count_OrderIsBeingDelivered = orders::where([
            ['orders.order_user_id', '=', $user_id],
            ['orders.order_status', '=', 2],
        ])->count();
        // Tổng số đơn hàng bị hủy
        $Count_OrderHasBeenCancelled = orders::where([
            ['orders.order_user_id', '=', $user_id],
            ['orders.order_status', '=', 3],
        ])->count();
        // Tổng số đơn hàng đã giao
        $Count_OrderHasBeenDelivered = orders::where([
            ['orders.order_user_id', '=', $user_id],
            ['orders.order_status', '=', 4],
        ])->count();
        // Tổng số đơn hàng hoàn tất
        $Count_OrderCompleted = orders::where([
            ['orders.order_user_id', '=', $user_id],
            ['orders.order_status', '=', 5],
        ])->count();

        /** === Chuẩn bị mảng dữ liệu trả về view === */
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'breadcrumbItems' => $breadcrumbItems,
            'Category' => $categoryTree,
            'dataOrder' => $dataOrder,
            'CountOrderAll' => $CountOrderAll,
            'Count_OrderIsProcessing' => $Count_OrderIsProcessing,
            'Count_OrderIsBeingDelivered' => $Count_OrderIsBeingDelivered,
            'Count_OrderHasBeenCancelled' => $Count_OrderHasBeenCancelled,
            'Count_OrderHasBeenDelivered' => $Count_OrderHasBeenDelivered,
            'Count_OrderCompleted' => $Count_OrderCompleted,
        ];

        /** === Debug kiểm tra dữ liệu === */
        // dd($dataAll);

        /** === Trả về view với dữ liệu === */
        return view('management_order', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

    public function ChangeStatusOrder(Request $request)
    {
        try {
            $ordercode = $request->get('ordercode', 0);
            $status = $request->get('status', 0);

            if (!$ordercode || !$status) {
                return apiResponse("error", "Thiếu ID sản phẩm hoặc đánh giá", [], false, 400);
            }

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
                return apiResponse("success", "Xác nhận đơn hàng thành công", [], false, 500);
            }

            if ($status == 2) {
                //Luồng thông báo cho người dùng đơn hàng đang giao
                $order->update([

                ]);
                return apiResponse("success", "Hủy đơn hàng thành công", [], false, 500);
            }

            if ($status == 3) {
                //Luồng thông báo cho người dùng đơn hàng đã hủy và 
                $order->update([

                ]);
                return apiResponse("success", "Hủy đơn hàng thành công", [], false, 500);
            }

        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }
}
