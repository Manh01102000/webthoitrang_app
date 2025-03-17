<?php

namespace App\Http\Controllers;
use App\Models\blog;
use App\Models\categoryblog;

class NewsController extends Controller
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
            'seo_title' => "Tin Tức Mới Nhất Về Các Nhà Thời Trang Hàng Đầu - Fashion Houses",
            'seo_desc' => "Khám phá những tin tức mới nhất về các nhà thời trang nổi tiếng, các bộ sưu tập mới, xu hướng thời trang và sự kiện quan trọng trong ngành. Cập nhật thông tin từ Fashion Houses ngay hôm nay!",
            'seo_keyword' => "Fashion Houses, tin tức thời trang, xu hướng thời trang, các nhà thiết kế nổi tiếng, bộ sưu tập thời trang, sự kiện thời trang, thông tin thời trang, thời trang cao cấp, tin tức ngành thời trang.",
            'canonical' => $domain . '/tin-tuc',
        ];
        /** === Xây dựng breadcrumb === */
        $breadcrumbItems = [
            ['title' => 'Trang chủ', 'url' => '/', 'class' => 'otherssite'],
            [
                'title' => "Tin tức",
                'url' => '',
                'class' => 'thissite'
            ]
        ];
        /** === Chuẩn bị dữ liệu cho view === */
        $datablog = blog::all();
        $data = InForAccount();
        $categoryTree = getCategoryTree();
        /** === Tổng hợp toàn bộ dữ liệu === */
        $dataAll = [
            'data' => $data,
            'breadcrumbItems' => $breadcrumbItems,
            'Category' => $categoryTree,
            'datablog' => $datablog,
        ];
        /** === Trả về view với dữ liệu === */
        return view('news', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }
}
