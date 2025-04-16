<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->is('api/*')) {
            return null; // API için yönlendirme yapmıyoruz, direkt 401 hata kodu dönecek
        }
        
        return $request->expectsJson() ? null : route('login');
    }
} 