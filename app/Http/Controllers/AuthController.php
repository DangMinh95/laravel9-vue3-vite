<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'errorCode' => config('errorcode.loginfail'),
                'message' => 'Tài khoản hoặc mật khẩu không đúng',
                'data' => []
            ]);
        }
        $user = Auth::user();
        $user->token = $token;
        $user->token_expire = Carbon::now()->addMinutes(env('JWT_TTL', config('common.ttlCookieToken')))->timezone('Asia/Ho_Chi_Minh');
        $user->save();

        return response()->json([
            'errorCode' => 0,
            'user' => $user,
        ])->cookie('token', $token, config('common.ttlCookieToken'), '/', env('APP_DOMAIN'), false, true);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        // $token = Auth::login($user);

        return response()->json([
            'errorCode' => config('errorcode.success'),
            'message' => 'User created successfully',
            'user' => $user,
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'errorCode' => config('errorcode.success'),
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'errorCode' => config('errorcode.success'),
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
