<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $roleId)
    {
        $user = Auth::user();

        if (!$user || !$user->vaiTros->contains('MaVaiTro', $roleId)) {
            abort(403, 'Bạn không có quyền truy cập');
        }

        return $next($request);
    }
}
