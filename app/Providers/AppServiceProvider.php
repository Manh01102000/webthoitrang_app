<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
// Product
use App\Repositories\product\ProductRepository;
use App\Repositories\product\ProductRepositoryInterface;
// User
use App\Repositories\user\UserRepository;
use App\Repositories\user\UserRepositoryInterface;
// Cart
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;
// Order
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
// Register
use App\Repositories\Register\RegisterRepository;
use App\Repositories\Register\RegisterRepositoryInterface;
// ChangePasword
use App\Repositories\ChangePassword\ChangePasswordRepository;
use App\Repositories\ChangePassword\ChangePasswordRepositoryInterface;
// Comment
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
// ComfirmOrder
use App\Repositories\ComfirmOrder\ConfirmOrderRepository;
use App\Repositories\ComfirmOrder\ConfirmOrderRepositoryInterface;
// Login
use App\Repositories\Login\LoginRepository;
use App\Repositories\Login\LoginRepositoryInterface;
// ManagementOrder
use App\Repositories\ManagementOrder\ManagementOrderRepository;
use App\Repositories\ManagementOrder\ManagementOrderRepositoryInterface;
// ManagerAccount
use App\Repositories\ManagerAccount\ManagerAccountRepository;
use App\Repositories\ManagerAccount\ManagerAccountRepositoryInterface;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    /**
     * Phương thức register() là một phần của Dependency Injection Container trong Laravel!
     * Phương thức register() của một ServiceProvider trong Laravel. Nó sử dụng $this->app->bind() để đăng ký binding 
     * giữa một interface và một class cụ thể.
     * Laravel có Service Container – một hệ thống Dependency Injection mạnh mẽ.
     * Nó cho phép bạn đăng ký các dependency và Laravel sẽ tự động inject chúng khi cần.
     * Khi Laravel thấy một class cần ProductRepositoryInterface, nó sẽ tự động cung cấp một instance của ProductRepository.
     * Giúp tự động quản lý dependency, code gọn hơn, dễ bảo trì.
     */
    public function register(): void
    {
        // Đăng ký các dịch vụ của bạn
        // Để Laravel tự động inject Repository mỗi khi dùng RepositoryInterface.
        // Product
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        // User
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        // Cart
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        // Order
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        // Register
        $this->app->bind(RegisterRepositoryInterface::class, RegisterRepository::class);
        // ChangePasword
        $this->app->bind(ChangePasswordRepositoryInterface::class, ChangePasswordRepository::class);
        // Comment
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        // ComfirmOrder
        $this->app->bind(ConfirmOrderRepositoryInterface::class, ConfirmOrderRepository::class);
        // Login
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
        // ManagementOrder
        $this->app->bind(ManagementOrderRepositoryInterface::class, ManagementOrderRepository::class);
        // ManagerAccount
        $this->app->bind(ManagerAccountRepositoryInterface::class, ManagerAccountRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //->prefix() Dùng để thêm tiền tố (prefix) vào tất cả các route bên trong nhóm.

        // Đảm bảo rằng các route web được cấu hình
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
        // Load routes admin
        Route::middleware('web')
            ->prefix('admin')
            ->group(base_path('routes/admin.php'));
        // Đảm bảo rằng các route API được cấu hình
        Route::middleware('api')
            ->prefix('api')  // Các route API sẽ có tiền tố /api
            ->group(base_path('routes/api.php'));
    }
}
