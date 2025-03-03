<?php
// =================================================
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
// ==================Controller===============================
// Trang chủ
use App\Http\Controllers\HomeController;
// Đăng ký
use App\Http\Controllers\RegisterController;
// Đăng nhập
use App\Http\Controllers\LoginController;
// Đăng xuất
use App\Http\Controllers\LogoutController;
// Trang chủ tin tức
use App\Http\Controllers\NewsController;
// Liên hệ
use App\Http\Controllers\ContactController;
// Giỏ hàng
use App\Http\Controllers\CartController;
// Giỏ hàng
use App\Http\Controllers\ConfirmOrderController;
// Quản lý tài khoản
use App\Http\Controllers\managerAccountController;
// Đổi mật khẩu
use App\Http\Controllers\ChangePasswordController;
// sản phẩm yêu thích
use App\Http\Controllers\ProductFavoriteController;
// quản lý đơn hàng
use App\Http\Controllers\ManagementOrderController;
// ==================Route===============================
// Trang chủ
Route::get('/', [HomeController::class, 'Home']);
// Đăng ký
Route::get('/dang-ky-tai-khoan', [RegisterController::class, 'index']);
// Đăng nhập
Route::get('/dang-nhap-tai-khoan', [LoginController::class, 'index']);
// Đăng xuất
Route::get('/dang-xuat', [LogoutController::class, 'index']);
// Trang chủ tin tức
Route::get('/tin-tuc', [NewsController::class, 'index']);
// Liên hệ
Route::get('/lien-he', [ContactController::class, 'index']);
// Giỏ hàng
Route::get('/gio-hang', [CartController::class, 'index']);
// Giỏ hàng
Route::get('/xac-nhan-don-hang', [ConfirmOrderController::class, 'index']);
// Quản lý tài khoản
Route::get('/quan-ly-tai-khoan', [managerAccountController::class, 'index']);
// Đổi mật khẩu
Route::get('/doi-mat-khau', [ChangePasswordController::class, 'index']);
// sản phẩm yêu thích
Route::get('/san-pham-yeu-thich', [ProductFavoriteController::class, 'index']);
// quản lý đơn hàng
Route::get('/quan-ly-don-hang', [ManagementOrderController::class, 'index']);
// test 
Route::get("/test", function () {
    return view('test');
});

// Tạo site map
Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'));
    return $sitemap->writeToFile(public_path('sitemap.xml'));
});