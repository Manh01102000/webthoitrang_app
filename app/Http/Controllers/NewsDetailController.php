<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\product;
class NewsDetailController extends Controller
{
    public function index(Request $request)
    {
        $product_id = $request->get('id');

        /** === Khai báo thư viện sử dụng === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];

        // ==================Lấy dữ liệu tài khoản==================
        $data = InForAccount();

        // ==================Lấy sản phẩm theo ID==================
        $data = Product::leftJoin('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
            ->where(function ($query) {
                $query->where('manage_discounts.discount_active', 1)
                    ->orWhereNull('manage_discounts.discount_active');
            })
            ->where('products.product_id', $product_id)
            ->select([
                'products.product_id',
                'products.product_code',
                'products.product_name',
                'products.product_alias',
                'products.product_description',
                'products.category',
                'products.category_code',
                'products.category_children_code', // Loại bỏ trùng lặp
                'products.product_create_time',
                'products.product_brand',
                'products.product_sizes',
                'products.product_colors',
                'products.product_classification',
                'products.product_stock',
                'products.product_price',
                'products.product_images',
                'products.product_videos',
                'products.product_ship',
                'products.product_feeship',
                'manage_discounts.discount_product_code',
                'manage_discounts.discount_active',
                'manage_discounts.discount_type',
                'manage_discounts.discount_start_time',
                'manage_discounts.discount_end_time',
                'manage_discounts.discount_price',
            ])
            ->first(); // Chỉ lấy một sản phẩm

        // Nếu không có sản phẩm, redirect về trang chủ
        if (!$data) {
            abort(404);
        }

        // Chuyển về mảng
        $dataProduct = $data->toArray();

        /** === Xây dựng SEO === */
        $domain = env('DOMAIN_WEB');
        $product_name = $dataProduct['product_name'] ?? 'Sản phẩm thời trang cao cấp';

        $seo_title = strlen($product_name) > 50
            ? limitText($product_name, 50) . ' | Mua ngay tại Fashion House'
            : "$product_name | Thời trang cao cấp | Fashion House";

        $seo_description = strlen($product_name) > 100
            ? "Mua ngay " . limitText($product_name, 100) . " tại Fashion House. Ưu đãi hấp dẫn, giao hàng toàn quốc!"
            : "Mua ngay $product_name chính hãng tại Fashion House. Thiết kế đẹp, chất liệu cao cấp, nhiều ưu đãi!";

        $seo_keywords = "$product_name, thời trang cao cấp, shop thời trang, quần áo đẹp, thời trang nam nữ";

        $dataSeo = [
            'seo_title' => $seo_title,
            'seo_desc' => $seo_description,
            'seo_keyword' => $seo_keywords,
            'canonical' => $domain,
        ];

        // ===================Lấy danh mục theo từng cấp=============
        $categoryTree = Cache::remember('category_tree', 3600, function () {
            return getCategoryTree();
        });

        // ===================Chuẩn bị dữ liệu tổng hợp=============
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'ProductDetails' => $dataProduct,
        ];

        // =============== TRẢ VỀ VIEW =====================
        return view('product_detail', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

}