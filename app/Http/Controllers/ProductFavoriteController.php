<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ProductFavoriteController extends Controller
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
            'seo_title' => "Sản Phẩm Yêu Thích - Xu Hướng Thời Trang Hot Nhất | Fashion Houses",
            'seo_desc' => "Khám phá bộ sưu tập sản phẩm yêu thích tại Fashion Houses. Xu hướng thời trang mới nhất, chất liệu cao cấp & thiết kế đẳng cấp. Mua sắm ngay hôm nay!",
            'seo_keyword' => "sản phẩm yêu thích, thời trang hot, xu hướng thời trang, mua sắm online, quần áo đẹp, phong cách thời thượng, Fashion Houses",
            'canonical' => $domain . '/san-pham-yeu-thich',
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
        return view('product_favorite', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }
}
