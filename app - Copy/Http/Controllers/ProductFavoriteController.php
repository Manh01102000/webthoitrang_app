<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ProductFavoriteController extends Controller
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
            'seo_title' => "Sản Phẩm Yêu Thích - Xu Hướng Thời Trang Hot Nhất | Fashion Houses",
            'seo_desc' => "Khám phá bộ sưu tập sản phẩm yêu thích tại Fashion Houses. Xu hướng thời trang mới nhất, chất liệu cao cấp & thiết kế đẳng cấp. Mua sắm ngay hôm nay!",
            'seo_keyword' => "sản phẩm yêu thích, thời trang hot, xu hướng thời trang, mua sắm online, quần áo đẹp, phong cách thời thượng, Fashion Houses",
            'canonical' => $domain . '/san-pham-yeu-thich',
        ];
        /** === Xây dựng breadcrumb === */
        $breadcrumbItems = [
            ['title' => 'Trang chủ', 'url' => '/', 'class' => 'otherssite'],
            [
                'title' => "Sản phẩm yêu thích",
                'url' => '',
                'class' => 'thissite'
            ]
        ];
        /** === Chuẩn bị dữ liệu cho view === */
        $data = InForAccount();
        /** === lấy dữ liệu danh mục theo từng cấp === */
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'breadcrumbItems' => $breadcrumbItems,
            'Category' => $categoryTree,
        ];
        /** === Trả về view với dữ liệu === */
        return view('product_favorite', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }
}
