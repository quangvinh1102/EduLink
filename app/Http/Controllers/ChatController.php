<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ChatController extends Controller
{
    public function create(Request $request)
    {
        // dd($request);
        Chat::firstOrCreate([
            'id_chat' => $request->id_chat,
            'user_id' => $request->user_id,
        ], [
            'id_chat' => $request->id_chat,
            'user_id' => $request->user_id,
            'updated_at' => Date::now(),
            'created_at' => Date::now(),
        ]);
        Chat::firstOrCreate([
            'id_chat' => $request->id_chat,
            'user_id' => $request->currentUser_id,
        ], [
            'id_chat' => $request->id_chat,
            'user_id' => $request->currentUser_id,
            'updated_at' => Date::now(),
            'created_at' => Date::now(),
        ]);
        return response()->json(['status' => 200]);
    }
}
