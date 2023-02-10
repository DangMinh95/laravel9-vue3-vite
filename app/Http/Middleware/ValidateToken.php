<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasCookie('token')) {
            return response()->json([
                'errorCode' => config('errorcode.loginfail'),
                'message' => 'Bạn vui lòng đăng nhập lại'
            ]);
        }
        $token = $request->cookie('token');
        $request->headers->set('Authorization', $token);
        try {
            if (!Auth::parseToken()->check()) {
                return response()->json([
                    'errorCode' => config('errorcode.loginfail'),
                    'message' => 'Bạn vui lòng đăng nhập lại'
                ]);
            };
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json([
                    'errorCode' => config('errorcode.tokenerror'),
                    'message' => 'Token không hợp lệ'
                ]);
            }
        }

        return $next($request);
    }
}
