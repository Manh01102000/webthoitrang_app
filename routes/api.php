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
// Giỏ hàng
use App\Http\Controllers\OrderController;
// Xác nhận đơn hàng
use App\Http\Controllers\ConfirmOrderController;
// comment
use App\Http\Controllers\CommentController;
// Chi tiết sản phẩm
use App\Http\Controllers\ProductDetailController;
//Quản lý đơn hàng
use App\Http\Controllers\ManagementOrderController;
//Hợp đồng tiếp thị liên kết
use App\Http\Controllers\AffiliateContracts;
// ========================AJAX================================
// API kiểm tra tài khoản tồn tại
Route::post('/check_account_register', [RegisterController::class, 'CheckAccountRegister']);
// Đăng ký tài khoản
Route::post('/AccountRegister', [RegisterController::class, 'AccountRegister']);
// Đăng nhập tài khoản
Route::post('/Accountlogin', [LoginController::class, 'Accountlogin']);
// Đăng nhập tài khoản
Route::post('/Accountlogin', [LoginController::class, 'Accountlogin']);
// Làm mới token
Route::post('/refreshToken', [LoginController::class, 'refreshToken']);
// Xóa cache
Route::post('/clearCache', [ApiController::class, 'clearCache']);
// Lấy tỉnh thành
Route::post('/getCities', [ApiController::class, 'getCities']);
// Lấy quận huyên không theo id
Route::post('/getDistrics', [ApiController::class, 'getDistrics']);
// Lấy xã phường không theo id
Route::post('/getCommunes', [ApiController::class, 'getCommunes']);
// Lấy quận huyện theo id
Route::post('/getDistrictsByID', [ApiController::class, 'getDistrictsByID']);
// lấy xã phường theo id
Route::post('/getCommunesByID', [ApiController::class, 'getCommunesByID']);
// lấy danh mục sản phẩm id cha
Route::post('/getCategoryByID', [ApiController::class, 'getCategoryByID']);
// lấy user_id phục vụ check người dùng online
Route::post('/get-user-id-online', [ApiController::class, 'getUserIdOnline']);
// =====================Đánh giá sao sản phẩm==============================
Route::group(['middleware' => ['auth.jwt']], function () {
    Route::post('/RatingProduct', [ProductDetailController::class, 'RatingProduct']);
});
// Middleware kiểm tra đăng nhập và kiểm tra token hợp lệ
// =====================Giỏ hàng + Đơn hàng ==============================
Route::group(['middleware' => ['auth.jwt']], function () {
    Route::post('/AddToCart', [CartController::class, 'AddToCart']);
    Route::post('/updateCartCountBuy', [CartController::class, 'updateCartCountBuy']);
    Route::post('/ConfirmOrder', [OrderController::class, 'ConfirmOrder']);
    Route::post('/ConfirmOrderBuyNow', [OrderController::class, 'ConfirmOrderBuyNow']);
});
// =====================Xác nhận đơn hàng======================================
Route::group(['middleware' => ['auth.jwt']], function () {
    Route::post('/AddDataInforship', [ConfirmOrderController::class, 'AddDataInforship']);
    Route::post('/SetShipDefalt', [ConfirmOrderController::class, 'SetShipDefalt']);
    Route::post('/PayMent', [ConfirmOrderController::class, 'PayMent']);
});
// =================API luồng quản lý đơn hàng==============================
// Middleware kiểm tra đăng nhập và kiểm tra token hợp lệ
Route::group(['middleware' => ['auth.jwt']], function () {
    Route::post('/ChangeStatusOrder', [ManagementOrderController::class, 'ChangeStatusOrder']);

});
// =================API Cập nhật tài khoản==============================
// Middleware kiểm tra đăng nhập và kiểm tra token hợp lệ
Route::group(['middleware' => ['auth.jwt']], function () {
    // Cập nhật tài khoản
    Route::post('/AccountUpdate', [managerAccountController::class, 'AccountUpdate']);
    // Đổi Mật khẩu
    Route::post('/ChangePassword', [ChangePasswordController::class, 'ChangePassword']);
    // API Kiểm tra mật khẩu cũ
    Route::post('/check_password_old', [ChangePasswordController::class, 'check_password_old']);
    // API Kiểm tra mật mới có trùng mật khẩu cũ hay không
    Route::post('/check_password_new', [ChangePasswordController::class, 'check_password_new']);
});
// =================API luồng bình luận==============================
// Middleware kiểm tra đăng nhập và kiểm tra token hợp lệ
Route::prefix('comment')->group(function () {
    // Lấy comment
    Route::get('/', [CommentController::class, 'LoadMoreComment']);

    // Lấy comment thêm
    Route::get('/{id}/replies', [CommentController::class, 'loadMoreReplies'])->where('id', '[0-9]+');

    Route::group(['middleware' => ['auth.jwt']], function () {
        // Thêm comment
        Route::post('/', [CommentController::class, 'AddComment']);

        // Thêm emoji
        Route::post('/{id}/emoji', [CommentController::class, 'SubmitEmoji'])->where('id', '[0-9]+');

        //Xóa comment
        Route::delete('/{id}', [CommentController::class, 'DeleteComment'])->where('id', '[0-9]+');
    });
});


// =================API luồng Tiếp thị liên kết==============================
Route::group(['middleware' => ['auth.jwt']], function () {
    Route::post('/save-contract', [AffiliateContracts::class, 'create']);
    Route::post('/cancel-contract', [AffiliateContracts::class, 'delete']);
});
// API debug token
Route::post('/debugToken', [LoginController::class, 'debugToken']);
// ==========================================