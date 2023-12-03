<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\University;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\FileService;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{

    protected $file;
    public function __construct(FileService $file)
    {
        $this->file = $file;
    }

    public function getUniversity()
    {
        $university = University::all();
        return response()->json(['listUniversity' => $university]);
    }

    public function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => 'storage/avatar/admin-default.png',
            'university_id' => $request->admin ? $request->university_id : null,
            'role' => $request->admin ? 1 : 0,
        ]);
        return response()->json(['mess' => 'Đăng ký thành công!!']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $token = $user->createToken('user_token')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Tài khoản mật khẩu không chính xác'], 401);
        }
    }

    public function inforUser(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $user =  $request->user();
            $user['avatar'] = asset(Storage::url($user->avatar));
            return response()->json([
                'status_code' => 200,
                'user' => $user,
            ]);
        }
        return response()->json([
            'status_code' => 500,
            'message' => $request,
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            if (Auth::guard('web')->check()) {
                Auth::guard('web')->logout();
            }

            $user->tokens()->delete();

            return response()->json(['message' => 'Logged out successfully', 'status_code' => 200]);
        }

        return response()->json(['message' => 'No user found', 'status_code' => 404]);
    }

    public function updateUser(Request $request, $id)
    {
        // dd($request->avatar->getClientOriginalName());
        $user = User::find($id);
        
        if ($request->hasFile('avatar')) {
            if (Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            $nameFile = $request->avatar->getClientOriginalName();
            $path = $this->file->uploadImage($request->avatar, 'avatar', $nameFile);
        } else {
            $path = $user->avatar;
        }

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'description' => $request->description,
                'location' => $request->location,
                'gender' => $request->gender,
                'avatar' => $path,
            ]);
            return response()->json(['mess' => 'Cập nhật ảnh thành công!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function getAllUsers($id) {
        $chat = Chat::where('user_id', $id)->get();
        // dd($chat);
        // foreach ($chat as &$item) {
        //     $item['avatar'] = Storage::url($item['avatar']);
        // }
        return response()->json($chat);
    }
}
