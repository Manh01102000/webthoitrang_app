<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra session có tồn tại không
        if (!session()->has('admin_id')) {
            return redirect('/admin/login')->with('error', 'Bạn không có quyền truy cập!');
        }

        // Lấy admin_role từ session
        $admin_show = session('admin_show');
        if ($admin_show != 1) {
            return redirect('/admin/login')->with('error', 'Tài khoản của bạn không có quyền truy cập!');
        }

        // Kiểm tra nếu admin_role không thuộc các giá trị [1, 2, 3, 4] thì chặn truy cập
        // if (!in_array($adminRole, [1])) {
        //     return redirect('/admin/login')->with('error', 'Bạn không có quyền truy cập!');
        // }

        return $next($request);
    }
}
