<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model
use App\Models\product;
use App\Models\User;
use App\Models\orders;
use App\Models\order_details;
// 
use App\Repositories\ManagementOrder\ManagementOrderRepositoryInterface;

class ManagementOrderController extends Controller
{
    protected $ManagementOrderRepository;
    public function __construct(ManagementOrderRepositoryInterface $ManagementOrderRepository)
    {
        $this->ManagementOrderRepository = $ManagementOrderRepository;
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
        $response = $this->ManagementOrderRepository->getUserOrders($user_id, $page, $limit, $offset);
        $dataOrder = [];
        if ($response['success']) {
            $dataOrder = $response['data']['dataOrder'];
        }
        // Tổng số đơn hàng để hiển thị phân trang
        $responseCount = $this->ManagementOrderRepository->getOrderStatistics($user_id);
        // Tổng toàn bộ đơn hàng
        $CountOrderAll = [];
        // Tổng số đơn hàng đang xử lý
        $Count_OrderIsProcessing = [];
        // Tổng số đơn hàng đang giao
        $Count_OrderIsBeingDelivered = [];
        // Tổng số đơn hàng bị hủy
        $Count_OrderHasBeenCancelled = [];
        // Tổng số đơn hàng đã giao
        $Count_OrderHasBeenDelivered = [];
        // Tổng số đơn hàng hoàn tất
        $Count_OrderCompleted = [];
        if ($responseCount['success']) {
            $dataOrder = $responseCount['data'];
            $CountOrderAll = $dataOrder['CountOrderAll'];
            $Count_OrderIsProcessing = $dataOrder['Count_OrderIsProcessing'];
            $Count_OrderIsBeingDelivered = $dataOrder['Count_OrderIsBeingDelivered'];
            $Count_OrderHasBeenCancelled = $dataOrder['Count_OrderHasBeenCancelled'];
            $Count_OrderHasBeenDelivered = $dataOrder['Count_OrderHasBeenDelivered'];
            $Count_OrderCompleted = $dataOrder['Count_OrderCompleted'];
        }
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
            $data = [
                'ordercode' => $ordercode,
                'status' => $status,
            ];
            $response = $this->ManagementOrderRepository->ChangeStatusOrder($data);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }
}
