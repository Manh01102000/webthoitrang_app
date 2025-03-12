<?php
// Import các class cần thiết:
// Application: Lớp chính của Laravel để khởi tạo ứng dụng.
// Exceptions: Dùng để cấu hình cách Laravel xử lý lỗi.
// NotFoundHttpException: Lớp xử lý lỗi 404 Not Found.
// Middleware: Dùng để đăng ký alias cho middleware.
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Configuration\Middleware;

// Token
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

// Application::configure(...)=>sẽ tạo một ứng dụng Laravel và cấu hình nó.
// basePath: dirname(__DIR__): Xác định thư mục gốc của ứng dụng (thường là thư mục chứa bootstrap/).
return Application::configure(basePath: dirname(__DIR__))
    // Khai báo route
    // web: __DIR__ . '/../routes/web.php' 👉 Laravel sẽ sử dụng các route trong file routes/web.php.
    // commands: __DIR__ . '/../routes/console.php' 👉 Laravel sử dụng route dành cho artisan command trong routes/console.php.
    // health: '/up' 👉 Đây là endpoint để kiểm tra trạng thái ứng dụng (/up sẽ trả về trạng thái của server).
    ->withRouting(
        web: __DIR__ . '/../routes/web.php', // Chỉ định file định tuyến chính
        commands: __DIR__ . '/../routes/console.php', // Chỉ định file định tuyến cho console
        health: '/up', // Endpoint kiểm tra tình trạng ứng dụng
    )

    // Cấu hình Middleware của ứng dụng
    // withMiddleware(...): Định nghĩa middleware mà ứng dụng sẽ sử dụng.
    // alias([...]): Đặt tên ngắn (notfound) cho middleware HandleNotFound, để có thể dùng nó trong route:
    ->withMiddleware(function (Middleware $middleware) {
        // Đăng ký middleware với alias 'notfound'
        $middleware->alias([
            // notfound không tìm thấy và chuyển sang 404
            'notfound' => \App\Http\Middleware\HandleNotFound::class,
            // jwt.auth: Middleware kiểm tra token hợp lệ.
            'jwt.auth' => \Tymon\JWTAuth\Http\Middleware\Authenticate::class,
            // jwt.refresh: Middleware tự động cấp token mới khi token hết hạn.
            'jwt.refresh' => \Tymon\JWTAuth\Http\Middleware\RefreshToken::class,
        ]);
    })

    // Xử lý lỗi với withExceptions() Cấu hình xử lý Exception toàn cục cho ứng dụng
    // render(function (NotFoundHttpException $e, $request) {...}):
    // Khi có lỗi 404 (NotFoundHttpException), Laravel sẽ chuyển hướng đến /404 thay vì hiển thị lỗi.
    // Nghĩa là nếu người dùng truy cập vào một trang không tồn tại, họ sẽ được chuyển hướng đến trang lỗi 404.
    ->withExceptions(function (Exceptions $exceptions) {
        // Khi xảy ra lỗi 404 (NotFoundHttpException), chuyển hướng đến trang '/404'
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return redirect('/404'); // Chuyển hướng đến trang 404 do người dùng định nghĩa
        });

        // Xử lý Token Hết Hạn
        $exceptions->render(function (TokenExpiredException $e, $request) {
            return response()->json([
                'message' => 'Token đã hết hạn. Vui lòng đăng nhập lại!',
            ], 401);
        });

        // Xử lý Token Không Hợp Lệ
        $exceptions->render(function (TokenInvalidException $e, $request) {
            return response()->json([
                'message' => 'Token không hợp lệ!',
            ], 401);
        });

        // Xử lý Lỗi Không Tìm Thấy Token
        $exceptions->render(function (JWTException $e, $request) {
            return response()->json([
                'message' => 'Token không được cung cấp!',
            ], 401);
        });
    })

    // Khởi tạo ứng dụng Laravel với các thiết lập trên
    ->create();