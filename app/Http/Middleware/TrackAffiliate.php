<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Affiliate;

class TrackAffiliate
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('ref')) {
            $affiliate = Affiliate::where('affiliate_code', $request->query('ref'))->first();

            if ($affiliate) {
                // Luôn cập nhật mã affiliate mới nhất
                Session::put('affiliate_code', $affiliate->affiliate_code);
                Session::put('affiliate_id', $affiliate->id);
            }
        }

        return $next($request);
    }
}
