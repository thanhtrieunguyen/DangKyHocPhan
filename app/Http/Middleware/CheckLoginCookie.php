<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\SinhVien;

class CheckLoginCookie
{
    public function handle($request, Closure $next)
    {
        // Lấy giá trị cookie
        $mssv = Cookie::get('login_token');

        if ($mssv) {
            // Tìm người dùng theo MSSV
            $user = SinhVien::where('mssv', $mssv)->first();
            if ($user) {
                // Đăng nhập người dùng nếu tìm thấy
                Auth::login($user);
            }
        }

        return $next($request);
    }
}
