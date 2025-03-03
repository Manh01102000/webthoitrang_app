<?php
// ROUTER
use Illuminate\Support\Facades\Route;
// Đăng ký controller
use App\Http\Controllers\RegisterController;
// Login controller
use App\Http\Controllers\LoginController;
// Quản lý tài khoản controller
use App\Http\Controllers\managerAccountController;
// API controller
use App\Http\Controllers\ApiController;
// Đổi mật khẩu
use App\Http\Controllers\ChangePasswordController;
// Giỏ hàng
use App\Http\Controllers\CartController;
// ========================AJAX================================
// API kiểm tra tài khoản tồn tại
Route::post('/check_account_register', [RegisterController::class, 'CheckAccountRegister']);
// Đăng ký tài khoản
Route::post('/AccountRegister', [RegisterController::class, 'AccountRegister']);
// Đăng nhập tài khoản
Route::post('/Accountlogin', [LoginController::class, 'Accountlogin']);
// Đăng nhập tài khoản
Route::post('/Accountlogin', [LoginController::class, 'Accountlogin']);
// API Kiểm tra mật khẩu cũ
Route::post('/check_password_old', [ChangePasswordController::class, 'check_password_old']);
// API Kiểm tra mật mới có trùng mật khẩu cũ hay không
Route::post('/check_password_new', [ChangePasswordController::class, 'check_password_new']);
// Xóa cache
Route::post('/clearCache', [ApiController::class, 'clearCache']);
// Lấy tỉnh thành
Route::post('/getCities', [ApiController::class, 'getCities']);
// Lấy quận huyên không theo id
Route::post('/getDistrics', [ApiController::class, 'getDistrics']);
// Lấy xã phường không theo id
Route::post('/getCommunes', [ApiController::class, 'getCommunes']);
// Lấy quận huyện theo id
Route::post('/getDistricsByID', [ApiController::class, 'getDistricsByID']);
// lấy xã phường theo id
Route::post('/getCommunesByID', [ApiController::class, 'getCommunesByID']);
// lấy danh mục sản phẩm id cha
Route::post('/getCategoryByID', [ApiController::class, 'getCategoryByID']);
// =====================Giỏ hàng==============================
Route::post('/AddToCart', [CartController::class, 'AddToCart']);
Route::post('/updateCartCountBuy', [CartController::class, 'updateCartCountBuy']);
Route::post('/ConfirmOrder', [CartController::class, 'ConfirmOrder']);
// =================API Cập nhật==============================
// Cập nhật tài khoản
Route::post('/AccountUpdate', [managerAccountController::class, 'AccountUpdate']);
// Đổi Mật khẩu
Route::post('/ChangePassword', [ChangePasswordController::class, 'ChangePassword']);