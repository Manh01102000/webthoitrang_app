<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\APIControllerAdmin;

// =========================WEB=========================================
Route::get('/login', [AdminController::class, 'login']);
Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/danh-sach-nguoi-dung', [AdminController::class, 'ManageAccountUser']);
    Route::get('/danh-sach-san-pham', [AdminController::class, 'ManageProduct']);
    Route::get('/them-moi-san-pham', [AdminController::class, 'ManageAddProduct']);
    Route::get('/cap-nhat-san-pham-id{id}', [AdminController::class, 'ManageEditProduct']);
});

// =========================API=========================================
// * API Luồng tài khoản admin
// ĐĂNG NHẬP ADMIN
Route::post('/Adminlogin', [APIControllerAdmin::class, 'Adminlogin']);
// * API Luồng sản phẩm
// Tạo sản phẩm
Route::post('/CreateProduct', [APIControllerAdmin::class, 'CreateProduct']);
// Cập nhật sản phẩm
Route::post('/UpdateProduct', [APIControllerAdmin::class, 'UpdateProduct']);
// Hiển thị / Ẩn sản phẩm
Route::post('/ActiveProduct', [APIControllerAdmin::class, 'ActiveProduct']);
// Xóa sản phẩm
Route::post('/DeleteProduct', [APIControllerAdmin::class, 'DeleteProduct']);
// * API Luồng tài khoản người dùng