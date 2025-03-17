<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // 1 Lấy token từ Header hoặc Cookie
            $token = $request->bearerToken();

            if (!$token) {
                $token = $request->cookie('jwt_token');
            }
            // 3 Gán token vào JWTAuth trước khi authenticate
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();
            $request->merge(['user' => $user]); // Lưu user vào request
        } catch (TokenExpiredException $e) {
            try {
                // 1 Nếu token hết hạn, tự động refresh
                $newToken = JWTAuth::refresh($token);
                JWTAuth::setToken($newToken)->authenticate();
                // Set jwt_token (tồn tại 1 ngày) khi có refreshToken
                $expire_time = time() + (1 * 24 * 60 * 60);
                // 2 Gửi token mới trong cookie & header
                return $next($request)
                    ->withCookie(cookie('jwt_token', $newToken, $expire_time, '/', null, true, true))
                    ->header('Authorization', 'Bearer ' . $newToken);

            } catch (JWTException $e) {
                return response()->json(['message' => 'Phiên đăng nhập hết hạn, vui lòng đăng nhập lại!'], 401);
            }
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'Token không hợp lệ!'], 401);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Có lỗi với token!'], 401);
        }

        return $next($request);
    }

}
