<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

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
            [
                'title' => "Quản lý đơn hàng",
                'url' => '',
                'class' => 'thissite'
            ]
        ];
        /** === Chuẩn bị dữ liệu === */
        $data = InForAccount();
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'breadcrumbItems' => $breadcrumbItems,
            'Category' => $categoryTree,
        ];
        /** === Trả về view với dữ liệu === */
        return view('management_order', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

}
