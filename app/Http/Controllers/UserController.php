<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(Request $request){
        return response()->json([
            'status' => 'success',
            'data' => Auth::user()
        ]);
    }
}
