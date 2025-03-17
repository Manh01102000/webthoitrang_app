<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash; // ✅ Import Hash đúng
use App\Models\Admin; // Import model Admin
use App\Models\product; // Import model product
use App\Models\manage_discount; // Import model manage_discount

class AdminController extends Controller
{
    public function dashboard()
    {
        // kiểm tra xem có dùng thư viện hay không
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        // 
        $domain = env('DOMAIN_WEB');
        // 
        $dataSeo = [
            'seo_title' => "Fashion Houses Admin – Quản Lý Cửa Hàng Thời Trang Hiệu Quả",
            'seo_desc' => "Fashion Houses Admin giúp bạn quản lý sản phẩm, đơn hàng và khách hàng một cách dễ dàng. Giao diện trực quan, báo cáo chi tiết, tối ưu hiệu suất kinh doanh.",
            'seo_keyword' => "Fashion Houses Admin, quản lý thời trang, quản lý đơn hàng, quản lý sản phẩm, hệ thống admin, phần mềm quản lý cửa hàng, bán hàng thời trang, quản lý khách hàng",
            'canonical' => $domain . '/admin/dashboard'
        ];
        // LÂY DỮ LIỆU
        $data = InForAccountAdmin(session('admin_id'));
        $dataAll = [
            'data' => $data,
        ];
        // Trả về view 'example'
        return view('admin.dashboard', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
            'active' => 1
        ]);
    }

    public function login()
    {
        // kiểm tra xem có dùng thư viện hay không
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        // 
        $domain = env('DOMAIN_WEB');
        // 
        $dataSeo = [
            'seo_title' => "Đăng Nhập Quản Trị Viên - Fashion Houses",
            'seo_desc' => "Truy cập hệ thống quản trị Fashion Houses để quản lý sản phẩm, đơn hàng và tài khoản khách hàng. Đăng nhập ngay để bắt đầu điều hành cửa hàng thời trang của bạn!",
            'seo_keyword' => "Fashion Houses admin, đăng nhập quản trị, quản lý cửa hàng, đăng nhập admin Fashion Houses, quản lý sản phẩm, quản lý đơn hàng, hệ thống quản trị, trang quản lý thời trang.",
            'canonical' => $domain . '/admin/login'
        ];
        // Kiểm tra xem có cookie đăng nhập không nếu có thì về trang chủ
        if (session()->has('admin_id')) {
            return redirect("/admin/dashboard");
        }
        // 
        // LÂY DỮ LIỆU
        // Trả về view
        return view('admin.login', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
        ]);
    }

    public function ManageAccountUser()
    {
        // kiểm tra xem có dùng thư viện hay không
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        // 
        $domain = env('DOMAIN_WEB');
        // 
        $dataSeo = [
            'seo_title' => "Fashion Houses Admin – Danh Sách Người Dùng",
            'seo_desc' => "Fashion Houses Admin giúp bạn quản lý sản phẩm, đơn hàng và khách hàng một cách dễ dàng. Giao diện trực quan, báo cáo chi tiết, tối ưu hiệu suất kinh doanh.",
            'seo_keyword' => "Fashion Houses Admin, quản lý thời trang, quản lý đơn hàng, quản lý sản phẩm, hệ thống admin, phần mềm quản lý cửa hàng, bán hàng thời trang, quản lý khách hàng",
            'canonical' => $domain . '/admin/dashboard'
        ];
        // LÂY DỮ LIỆU
        $data = InForAccountAdmin(session('admin_id'));
        $dataAll = [
            'data' => $data,
        ];
        // Trả về view 'example'
        return view('admin.user_account.manage_account_user', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
            'active' => 3
        ]);
    }

    // Danh sach san pham
    public function ManageProduct(Request $request)
    {
        // ===================== CẤU HÌNH CHUNG =====================
        $admin_id = session('admin_id');
        $domain = env('DOMAIN_WEB');
        $canonical = $domain . '/admin/danh-sach-san-pham';

        // Cấu hình thư viện được sử dụng trong trang
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];

        // Cấu hình dữ liệu SEO cho trang
        $dataSeo = [
            'seo_title' => "Fashion Houses Admin – Danh Sách Sản Phẩm",
            'seo_desc' => "Fashion Houses Admin giúp bạn quản lý sản phẩm, đơn hàng và khách hàng một cách dễ dàng. Giao diện trực quan, báo cáo chi tiết, tối ưu hiệu suất kinh doanh.",
            'seo_keyword' => "Fashion Houses Admin, quản lý thời trang, quản lý đơn hàng, quản lý sản phẩm, hệ thống admin, phần mềm quản lý cửa hàng, bán hàng thời trang, quản lý khách hàng",
            'canonical' => $canonical
        ];

        // ===================== XỬ LÝ PHÂN TRANG =====================
        $page = $request->get('page', 0); // Lấy số trang từ request (mặc định = 1)
        $page_size = 30; // Số bản ghi trên mỗi trang
        $offset = ($page - 1) * $page_size; // Tính toán offset để lấy dữ liệu chính xác

        // ===================== LẤY DỮ LIỆU SẢN PHẨM =====================
        // Tạo query gốc
        $query = Product::join('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
            ->join('admin', 'products.product_admin_id', '=', 'admin.admin_id')
            ->where('products.product_admin_id', $admin_id)
            ->select('products.*', 'manage_discounts.*', 'admin.admin_name as admin_name', 'admin.admin_id as admin_id');

        // Lấy tổng số bản ghi để phục vụ phân trang
        $totalRecords = $query->clone()->count();

        // Lấy dữ liệu sản phẩm theo trang
        $dataProduct = $query->offset($offset)->limit($page_size)->get()->toArray();

        // ===================== DỮ LIỆU PHÂN TRANG =====================
        $dataPagination = [
            'page' => $page,
            'page_size' => $page_size,
            'canonical' => $canonical,
            'totalRecords' => $totalRecords,
        ];

        // ===================== LẤY DỮ LIỆU DANH MỤC =====================
        // Dữ liệu danh mục từ database
        $categoryTree = getCategoryTree();

        // Lấy danh mục từ cache để tối ưu hiệu suất
        $categoryALL = Cache::remember('category', 3600, function () {
            return getCategoryTree();
        });

        // ===================== CHUẨN BỊ DỮ LIỆU CHO VIEW =====================
        $dataAll = [
            'dataProduct' => $dataProduct,
            'Category' => $categoryTree,
            'categoryALL' => $categoryALL,
        ];

        // ===================== TRẢ VỀ VIEW =====================
        return view('admin.product.manage_product', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
            'active' => 7, // Đánh dấu menu đang được active
            'dataPagination' => $dataPagination
        ]);
    }


    // Them san pham
    public function ManageAddProduct()
    {
        // kiểm tra xem có dùng thư viện hay không
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        // 
        $domain = env('DOMAIN_WEB');
        // 
        $dataSeo = [
            'seo_title' => "Fashion Houses Admin – Thêm Mới Sản Phẩm",
            'seo_desc' => "Fashion Houses Admin giúp bạn quản lý sản phẩm, đơn hàng và khách hàng một cách dễ dàng. Giao diện trực quan, báo cáo chi tiết, tối ưu hiệu suất kinh doanh.",
            'seo_keyword' => "Fashion Houses Admin, quản lý thời trang, quản lý đơn hàng, quản lý sản phẩm, hệ thống admin, phần mềm quản lý cửa hàng, bán hàng thời trang, quản lý khách hàng",
            'canonical' => $domain . '/admin/dashboard'
        ];
        // LÂY DỮ LIỆU
        $data = InForAccountAdmin(session('admin_id'));
        // => Dữ liệu danh mục
        $categoryTree = getCategoryTree();
        $product_sizes = productSizes();
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'product_sizes' => $product_sizes
        ];
        // Trả về view 'example'
        return view('admin.product.manage_add_product', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
            'active' => 7
        ]);
    }

    // Cập nhật / chỉnh sửa sản phẩm
    public function ManageEditProduct(Request $request)
    {
        $product_id = $request->id;
        // kiểm tra xem có dùng thư viện hay không
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        // 
        $domain = env('DOMAIN_WEB');
        // 
        $dataSeo = [
            'seo_title' => "Fashion Houses Admin – Cập nhật Sản Phẩm",
            'seo_desc' => "Fashion Houses Admin giúp bạn quản lý sản phẩm, đơn hàng và khách hàng một cách dễ dàng. Giao diện trực quan, báo cáo chi tiết, tối ưu hiệu suất kinh doanh.",
            'seo_keyword' => "Fashion Houses Admin, quản lý thời trang, quản lý đơn hàng, quản lý sản phẩm, hệ thống admin, phần mềm quản lý cửa hàng, bán hàng thời trang, quản lý khách hàng",
            'canonical' => $domain . '/admin/dashboard'
        ];
        // LÂY DỮ LIỆU
        $data = InForAccountAdmin(session('admin_id'));
        // truy vấn lấy dữ liệu
        $data = product::join('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
            ->join('admin', 'products.product_admin_id', '=', 'admin.admin_id')
            ->where('products.product_id', $product_id)
            ->select('products.*', 'manage_discounts.*', 'admin.admin_name as admin_name', 'admin.admin_id as admin_id')
            ->first();

        $dataProduct = [];
        if ($data) {
            $dataProduct = $data->toArray();
        }
        // => Dữ liệu danh mục
        $categoryTree = getCategoryTree();
        // => Dữ liệu Category code
        $catcode = (!empty($dataProduct)) ? $dataProduct['category'] : "";
        $category_code = getCategoryCode($catcode);
        // => Dữ liệu Category child code
        $catcodechildren = (!empty($dataProduct)) ? $dataProduct['category_code'] : "";
        $category_children_code = getCategoryCode($catcodechildren);
        // => lấy dữ liệu kích thước
        $product_sizes = productSizes();
        // lấy dữ liệu tổng
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'category_code' => $category_code,
            'category_children_code' => $category_children_code,
            'product_sizes' => $product_sizes,
            'dataProduct' => $dataProduct,
        ];
        // Trả về view 'example'
        return view('admin.product.manage_edit_product', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
            'active' => 7
        ]);
    }
}
