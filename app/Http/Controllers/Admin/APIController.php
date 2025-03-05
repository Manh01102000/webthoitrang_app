<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash; // ✅ Import Hash đúng
use App\Models\Admin; // Import model Admin
use App\Models\product; // Import model product
use App\Models\manage_discount; // Import model manage_discount

// =======Sử dụng Repository trong Controller=====
// Inject Repository vào Controller thay vì viết trực tiếp logic.
use App\Repositories\product\ProductRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class APIController extends Controller
{
    protected $productRepo, $userRepo;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->productRepo = $productRepo;
        $this->userRepo = $userRepo;
    }
    // =============================================ADMIN===============================================================================
    public function Adminlogin(Request $request)
    {
        try {
            // Kiểm tra đầu vào
            $admin_account = $request->input('admin_account');
            $admin_password = $request->input('admin_password');

            if (!$admin_account || !$admin_password) {
                return apiResponse("error", "Thiếu tài khoản hoặc mật khẩu", [], false, 400);
            }

            // Mã hóa mật khẩu với md5 để so sánh
            $hashed_password = md5($admin_password);

            // Kiểm tra tài khoản có tồn tại không
            $admin = Admin::where([
                ['admin_account', '=', $admin_account],
                ['admin_pass', '=', $hashed_password]
            ])->first();

            if (!$admin) {
                return apiResponse("error", "Tài khoản hoặc mật khẩu không chính xác", [], false, 401);
            }

            // Lưu vào session
            session()->put('admin_id', $admin->admin_id);
            session()->put('admin_type', $admin->admin_type);
            session()->put('admin_show', $admin->admin_show);

            return apiResponse("success", "Đăng nhập thành công", $admin, true, 200);
        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }
    // =============================================PRODUCT===============================================================================
    // API THÊM SẢN PHẨM
    public function CreateProduct(Request $request)
    {
        $result = $this->productRepo->create($request->all());
        if ($result['success']) {
            return apiResponse('success', $result['message'], [], true, $result['httpCode']);
        } else {
            return apiResponse('error', $result['message'], [], false, $result['httpCode']);
        }
    }
    // API CẬP NHẬT SẢN PHẨM
    public function UpdateProduct(Request $request)
    {
        $result = $this->productRepo->update($request->all());
        if ($result['success']) {
            return apiResponse('success', $result['message'], [], true, $result['httpCode']);
        } else {
            return apiResponse('error', $result['message'], [], false, $result['httpCode']);
        }
    }
    // API XÓA SẢN PHẨM
    public function DeleteProduct(Request $request)
    {
        $product_id = $request->get('product_id');

        if (!$product_id) {
            return apiResponse('error', 'Thiếu product_id', [], false, 400);
        }

        $result = $this->productRepo->delete($product_id);

        if ($result['success']) {
            return apiResponse('success', $result['message'], [], true, $result['httpCode']);
        } else {
            return apiResponse('error', $result['message'], [], false, $result['httpCode']);
        }
    }
    // API ACTIVE SẢN PHẨM
    public function ActiveProduct(Request $request)
    {
        $product_id = $request->get('product_id');

        if (!$product_id) {
            return apiResponse('error', 'Thiếu product_id', [], false, 400);
        }

        $result = $this->productRepo->active($product_id);

        if ($result['success']) {
            return apiResponse('success', $result['message'], [], true, $result['httpCode']);
        } else {
            return apiResponse('error', $result['message'], [], false, $result['httpCode']);
        }
    }
    // =============================================USER (người dùng)===============================================================================
}
