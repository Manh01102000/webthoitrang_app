<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ManagementOrderController extends Controller
{
    public function index()
    {
        // kiểm tra xem có dùng thư viện hay không
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        // SEO 
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Quản Lý Đơn Hàng - Theo Dõi & Cập Nhật Trạng Thái | Fashion Houses",
            'seo_desc' => "Dễ dàng theo dõi, kiểm tra trạng thái đơn hàng và lịch sử mua sắm của bạn tại Fashion Houses. Cập nhật nhanh chóng & hỗ trợ tận tâm!",
            'seo_keyword' => "quản lý đơn hàng, theo dõi đơn hàng, trạng thái đơn hàng, lịch sử mua sắm, kiểm tra đơn hàng, Fashion Houses",
            'canonical' => $domain . '/quan-ly-tai-khoan',
        ];
        // LÂY DỮ LIỆU
        $data = InForAccount();
        // lấy dữ liệu danh mục theo từng cấp
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'datacity' => '',
            'datadistrict' => '',
            'datacommune' => '',
        ];
        // dd($dataAll);
        // Trả về view
        return view('management_order', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

}
