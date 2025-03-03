<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\APIController;

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
Route::post('/Adminlogin', [APIController::class, 'Adminlogin']);
// * API Luồng sản phẩm
// Tạo sản phẩm
Route::post('/CreateProduct', [APIController::class, 'CreateProduct']);
// Cập nhật sản phẩm
Route::post('/UpdateProduct', [APIController::class, 'UpdateProduct']);
// Hiển thị / Ẩn sản phẩm
Route::post('/ActiveProduct', [APIController::class, 'ActiveProduct']);
// Xóa sản phẩm
Route::post('/DeleteProduct', [APIController::class, 'DeleteProduct']);
// * API Luồng tài khoản người dùng