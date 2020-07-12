<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::get();
        $response = [
            'status' => 'Success',
            'message' => $user
        ];
        return response()->json($response,200);
    }

    public function verify(Request $request)
    {
        $user = User::where([
            ['username', '=', $request['username']],
            ['password', '=', md5($request['password'])],
        ])->value('role');
        $response = [
            'status' => 'Success',
            'role' => $user
        ];
        return response()->json($response,200);
    }
}
