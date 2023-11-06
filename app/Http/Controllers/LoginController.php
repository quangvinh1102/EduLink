<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getUniversity() {
        $university = University::all();
        return response()->json(['listUniversity' => $university]);
    }

    public function register(UserRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'university_id' => $request->admin ? $request->university_id : null,
            'role' => $request->admin? 1 : 0,
        ]);
        return response()->json(['mess' => 'Đăng ký thành công!!']);
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Auth::login(Auth::user());
            return response()->json(['message' => 'Đăng nhập thành công'], 200);
        }
    
        return response()->json(['message' => 'Đăng nhập thất bại'], 401);
    }

    public function currentUserLogin() {
        if (Auth::check()) {
            $user = 123; 
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['message' => 'Người dùng chưa đăng nhập'], 401);
        }
    }
}
