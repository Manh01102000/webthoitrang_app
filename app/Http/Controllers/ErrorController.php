<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\product;

class ErrorController extends Controller
{
    public function notFound()
    {
        /** === Khai báo thư viện sử dụng === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        /** === Xây dựng SEO === */
        $domain = env('DOMAIN_WEB');
        $seo_title = "404 - Trang không tồn tại | Fashion House";
        $seo_description = "Oops! Trang bạn tìm kiếm không tồn tại. Khám phá các sản phẩm thời trang mới nhất tại Fashion House.";
        $seo_keywords = "trang 404, lỗi 404, sản phẩm thời trang, quần áo đẹp, thời trang cao cấp";
        $canonical = $domain . '/404';
        $robots = 'noindex, follow';
        $dataSeo = [
            'seo_title' => $seo_title,
            'seo_desc' => $seo_description,
            'seo_keyword' => $seo_keywords,
            'canonical' => $canonical,
            'robots' => $robots,
        ];
        /** === Chuẩn bị dữ liệu === */
        $data = InForAccount();

        // Lấy danh sách sản phẩm gợi ý (ví dụ: lấy 6 sản phẩm mới nhất)
        $DBProducts = Product::orderBy('product_create_time', 'desc')->limit(6)->get();
        $suggestedProducts = (!$DBProducts) ? [] : $DBProducts->toArray();
        // ===================Lấy danh mục theo từng cấp=============
        $categoryTree = Cache::remember('category_tree', 3600, function () {
            return getCategoryTree();
        });

        // ===================Chuẩn bị dữ liệu tổng hợp=============
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'suggestedProducts' => $suggestedProducts,
        ];
        // =============== TRẢ VỀ VIEW =====================
        return response()->view('errors.404', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ], 404);
    }
}
