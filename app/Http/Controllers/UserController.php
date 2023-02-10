<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        return response()->json([
            'errorCode' => config('errorcode.success'),
            'data' => Auth::user()
        ]);
    }
}
