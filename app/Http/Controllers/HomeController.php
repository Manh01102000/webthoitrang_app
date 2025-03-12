<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use App\Models\product;
use App\Models\User; // Import Model User
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Home()
    {
        /** === Khai báo thư viện sử dụng === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        /** === Xây dựng SEO === */
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp | Mới Nhất " . date('Y'),
            'seo_desc' => "Tạo tài khoản Fashion Houses ngay hôm nay để nhận ưu đãi độc quyền, cập nhật xu hướng thời trang mới nhất và mua sắm dễ dàng hơn. Đăng ký miễn phí!",
            'seo_keyword' => "đăng ký tài khoản, Fashion Houses, tạo tài khoản mua sắm, thời trang trực tuyến, shop quần áo online, ưu đãi thời trang, xu hướng thời trang",
            'canonical' => $domain
        ];

        /** === Chuẩn bị dữ liệu === */
        $data = InForAccount();
        // ==================Lấy sản phẩm bán chạy===============
        $topProducts = Cache::remember('top_products', 300, function () {
            return Product::leftJoin('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
                ->where('products.product_active', 1)
                ->where(function ($query) {
                    $query->where('manage_discounts.discount_active', 1)
                        ->orWhereNull('manage_discounts.discount_active'); // Nếu không có giảm giá thì vẫn giữ lại sản phẩm
                })
                ->select(
                    'products.product_id',
                    'products.product_code',
                    'products.product_name',
                    'products.product_alias',
                    'products.product_create_time',
                    'products.product_brand',
                    'products.product_sizes',
                    'products.product_colors',
                    'products.product_classification',
                    'products.product_stock',
                    'products.product_price',
                    'products.product_images',
                    'manage_discounts.discount_product_code',
                    'manage_discounts.discount_active',
                    'manage_discounts.discount_type',
                    'manage_discounts.discount_start_time',
                    'manage_discounts.discount_end_time',
                    'manage_discounts.discount_price',

                ) // Chỉ lấy dữ liệu cần dùng
                ->orderByDesc('product_sold')
                ->limit(12)
                ->get()->toArray();
        });

        // ==================Lấy sản phẩm mới về===============
        $newProducts = Cache::remember('new_products', 300, function () {
            return Product::leftJoin('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
                ->where('products.product_active', 1)
                ->where(function ($query) {
                    $query->where('manage_discounts.discount_active', 1)
                        ->orWhereNull('manage_discounts.discount_active'); // Nếu không có giảm giá thì vẫn giữ lại sản phẩm
                })
                ->select(
                    'products.product_id',
                    'products.product_code',
                    'products.product_name',
                    'products.product_alias',
                    'products.product_create_time',
                    'products.product_brand',
                    'products.product_sizes',
                    'products.product_colors',
                    'products.product_classification',
                    'products.product_stock',
                    'products.product_price',
                    'products.product_images',
                    'manage_discounts.discount_product_code',
                    'manage_discounts.discount_active',
                    'manage_discounts.discount_type',
                    'manage_discounts.discount_start_time',
                    'manage_discounts.discount_end_time',
                    'manage_discounts.discount_price',

                ) // Chỉ lấy dữ liệu cần dùng
                ->orderByDesc('product_create_time')
                ->limit(12)
                ->get()->toArray();
        });

        // =========Lấy Sản phẩm Giảm Giá Sốc (Giảm Giá Cao Nhất)==========
        $hotDealProducts = Cache::remember('hot_deal_products', 300, function () {
            return Product::join('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
                ->where('products.product_active', 1)
                ->where('manage_discounts.discount_active', 1)
                ->select(
                    'products.product_id',
                    'products.product_code',
                    'products.product_name',
                    'products.product_alias',
                    'products.product_create_time',
                    'products.product_brand',
                    'products.product_sizes',
                    'products.product_colors',
                    'products.product_classification',
                    'products.product_stock',
                    'products.product_price',
                    'products.product_images',
                    'manage_discounts.discount_product_code',
                    'manage_discounts.discount_active',
                    'manage_discounts.discount_type',
                    'manage_discounts.discount_start_time',
                    'manage_discounts.discount_end_time',
                    'manage_discounts.discount_price',
                ) // Chỉ lấy dữ liệu cần dùng
                ->orderByDesc('manage_discounts.discount_price')
                ->limit(12)
                ->get()->toArray();
        });

        // ==================Lấy sản phẩm Flash Sale (Giảm Giá Trong Thời Gian Ngắn)===============
        $flashSaleProducts = Cache::remember('flash_sale_products', 300, function () {
            $products = Product::join('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
                ->where('products.product_active', 1)
                ->where('manage_discounts.discount_active', 1)
                ->where('manage_discounts.discount_start_time', '<=', now())
                ->where('manage_discounts.discount_end_time', '>=', now())
                ->select(
                    'products.product_id',
                    'products.product_code',
                    'products.product_name',
                    'products.product_alias',
                    'products.product_create_time',
                    'products.product_brand',
                    'products.product_sizes',
                    'products.product_colors',
                    'products.product_classification',
                    'products.product_stock',
                    'products.product_price',
                    'products.product_images',
                    'manage_discounts.discount_product_code',
                    'manage_discounts.discount_active',
                    'manage_discounts.discount_type',
                    'manage_discounts.discount_start_time',
                    'manage_discounts.discount_end_time',
                    'manage_discounts.discount_price',
                ) // Chỉ lấy dữ liệu cần dùng
                ->orderByDesc('manage_discounts.discount_price')
                ->limit(12)
                ->get()
                ->toArray();

            // Nếu có sản phẩm Flash Sale, return luôn
            if (!empty($products)) {
                return $products;
            }

            // Nếu không có Flash Sale, lấy sản phẩm có giảm giá cao nhất
            return Product::join('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
                ->where('products.product_active', 1)
                ->where('manage_discounts.discount_active', 1)
                ->select(
                    'products.product_id',
                    'products.product_code',
                    'products.product_name',
                    'products.product_alias',
                    'products.product_create_time',
                    'products.product_brand',
                    'products.product_sizes',
                    'products.product_colors',
                    'products.product_classification',
                    'products.product_stock',
                    'products.product_price',
                    'products.product_images',
                    'manage_discounts.discount_product_code',
                    'manage_discounts.discount_active',
                    'manage_discounts.discount_type',
                    'manage_discounts.discount_start_time',
                    'manage_discounts.discount_end_time',
                    'manage_discounts.discount_price',
                ) // Chỉ lấy dữ liệu cần dùng
                ->orderByDesc('manage_discounts.discount_price')
                ->limit(10)
                ->get()
                ->toArray();
        });

        // ===================Lấy danh mục theo từng cấp=============
        $categoryTree = Cache::remember('category_tree', 3600, function () {
            return getCategoryTree();
        });

        // ===================Chuẩn bị dữ liệu tổng hợp=============
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'datacity' => '',
            'datadistrict' => '',
            'datacommune' => '',
            'topProducts' => $topProducts,
            'newProducts' => $newProducts,
            'hotDealProducts' => $hotDealProducts,
            'flashSaleProducts' => $flashSaleProducts,
        ];

        // =============== TRẢ VỀ VIEW =====================
        return view('home', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

}