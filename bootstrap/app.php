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
            'auth.jwt' => \App\Http\Middleware\JwtMiddleware::class,
        ]);
    })

    // Xử lý lỗi với withExceptions() Cấu hình xử lý Exception toàn cục cho ứng dụng
    // render(function (NotFoundHttpException $e, $request) {...}):
    // Khi có lỗi 404 (NotFoundHttpException), Laravel sẽ chuyển hướng đến /404 thay vì hiển thị lỗi.
    // Nghĩa là nếu người dùng truy cập vào một trang không tồn tại, họ sẽ được chuyển hướng đến trang lỗi 404.
    ->withExceptions(function (Exceptions $exceptions) {
        // Khi xảy ra lỗi 404 (NotFoundHttpException), chuyển hướng đến trang '/404'
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return redirect('/404');
        });

        // Xử lý tất cả lỗi liên quan đến JWT
        $exceptions->render(function (\Exception $e, $request) {
            // Ghi log lỗi để dễ debug
            \Log::error("JWT Error: " . $e->getMessage());
            // Xác định loại lỗi và trả về thông báo phù hợp
            // instanceof là một toán tử trong PHP dùng để kiểm tra xem một biến có thuộc về một class cụ thể hay không.
            // TokenExpiredException,TokenInvalidException... là một class đại diện cho lỗi khi token JWT đã hết hạn.
            // Nếu $e là một instance của TokenExpiredException,TokenInvalidException,.. tức là lỗi xảy ra do token đã hết hạn,
            // không hợp lệ thì khối lệnh tương ứng sẽ được thực thi. 
            if ($e instanceof TokenExpiredException) {
                $message = 'Token đã hết hạn. Vui lòng đăng nhập lại!';
                $statusCode = 401;
            } elseif ($e instanceof TokenInvalidException) {
                $message = 'Token không hợp lệ!';
                $statusCode = 401;
            } elseif ($e instanceof JWTException) {
                $message = 'Token không được cung cấp!';
                $statusCode = 401;
            } else {
                return null; // Trả về null để Laravel xử lý các lỗi khác
            }

            return response()->json(['message' => $message], $statusCode);
        });
    })

    // Khởi tạo ứng dụng Laravel với các thiết lập trên
    ->create();