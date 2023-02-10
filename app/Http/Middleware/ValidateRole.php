<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $roleList = [
            "Admin" => "Admin",
            "User" => "User"
        ];
        $userRole = Auth::user()->roles()->get();
        if (!$userRole->contains('name_role', strtolower($roleList[$role]))) {
            return response()->json([
                'status' => '500',
                'message' => 'Bạn không có quyền chỉnh sửa'
            ]);
        }

        return $next($request);
    }
}
