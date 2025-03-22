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
// Tiếp thị liên kết
use App\Http\Controllers\AffiliateController;
// Chi tiết sản phẩm
use App\Http\Controllers\ProductDetailController;
// Chi tiết tin tức
use App\Http\Controllers\NewsDetailController;
// page 404
use App\Http\Controllers\ErrorController;
// page messenger
use App\Http\Controllers\MessengerController;

// ==================Route===============================
// 🚀 TRANG CHỦ & THÔNG TIN CHUNG
Route::get('/', [HomeController::class, 'Home']);
Route::get('/lien-he', [ContactController::class, 'index']);
Route::get('/tin-tuc', [NewsController::class, 'index']);
Route::get('/tro-chuyen', [MessengerController::class, 'index']);

// 🚀 XÁC THỰC & TÀI KHOẢN
Route::get('/dang-ky-tai-khoan', [RegisterController::class, 'index']);
Route::get('/dang-nhap-tai-khoan', [LoginController::class, 'index']);
Route::get('/dang-xuat', [LogoutController::class, 'index']);
Route::get('/quan-ly-tai-khoan', [ManagerAccountController::class, 'index']);
Route::get('/doi-mat-khau', [ChangePasswordController::class, 'index']);

// 🚀 GIỎ HÀNG & THANH TOÁN
Route::get('/gio-hang', [CartController::class, 'index']);
Route::get('/xac-nhan-don-hang', [ConfirmOrderController::class, 'index']);
Route::get('/quan-ly-don-hang', [ManagementOrderController::class, 'index']);

// 🚀 SẢN PHẨM (cần kiểm tra xem có sản phẩm không nếu k trả về 404)
Route::get('/san-pham-yeu-thich', [ProductFavoriteController::class, 'index']);
Route::middleware('notfound')->group(function () {
    Route::get('/san-pham/{id}', [ProductDetailController::class, 'index'])->where('id', '[0-9]+');
    Route::get('/san-pham/{slug}-{id}', [ProductDetailController::class, 'index'])
        ->where(['id' => '[0-9]+', 'slug' => '[a-zA-Z0-9-]+']);
});
// 🚀 Tiếp thị liên kết
Route::get('/tiep-thi-lien-ket', [AffiliateController::class, 'index']);
// 🚀 BÀI VIẾT / TIN TỨC
Route::middleware('notfound')->group(function () {
    Route::get('/bai-viet/{id}', [NewsDetailController::class, 'index'])->where('id', '[0-9]+');
    Route::get('/bai-viet/{slug}-{id}', [NewsDetailController::class, 'index'])
        ->where(['id' => '[0-9]+', 'slug' => '[a-zA-Z0-9-]+']);
});

// 🚀 LỖI & HỆ THỐNG
Route::get('/404', [ErrorController::class, 'notFound']);

// 🚀 SITEMAP
Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'));
    return $sitemap->writeToFile(public_path('sitemap.xml'));
});

// 🚀 ROUTE TEST
Route::get('/test', function () {
    return view('test');
});