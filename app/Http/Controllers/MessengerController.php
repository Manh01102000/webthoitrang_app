<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function index(Request $request)
    {
        // Lấy dữ liệu
        $data = InForAccount();
        /** === Khai báo thư viện sử dụng === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        /** === Xây dựng SEO === */
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Hỗ Trợ Khách Hàng - Chat Trực Tuyến | Fashion House",
            'seo_desc' => "Liên hệ Fashion House qua chat trực tuyến để được tư vấn nhanh chóng. Đội ngũ hỗ trợ 24/7 sẵn sàng giúp bạn giải đáp thắc mắc về sản phẩm và đơn hàng.",
            'seo_keyword' => "hỗ trợ khách hàng, chat trực tuyến, tư vấn thời trang, liên hệ Fashion House, hỗ trợ mua sắm, giải đáp thắc mắc, chăm sóc khách hàng",
            'canonical' => $domain . '/tro-chuyen',
        ];
        /** === Xây dựng breadcrumb === */
        $breadcrumbItems = [
            ['title' => 'Trang chủ', 'url' => '/', 'class' => 'otherssite'],
            [
                'title' => "Trò chuyện",
                'url' => '',
                'class' => 'thissite'
            ]
        ];
        /** === Chuẩn bị dữ liệu cho view === */
        $categoryTree = getCategoryTree();
        /** === Tổng hợp toàn bộ dữ liệu === */
        $dataAll = [
            'data' => $data,
            'breadcrumbItems' => $breadcrumbItems,
            'Category' => $categoryTree,
        ];
        /** === Trả về view với dữ liệu === */
        return view('messenger', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }
}
