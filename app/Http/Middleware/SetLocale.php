<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->user()->language ?? $request->getPreferredLanguage(['en', 'vi']); // Mặc định là 'en' nếu chưa đăng nhập
        App::setLocale($locale); // Thiết lập ngôn ngữ
        return $next($request);
    }
}
