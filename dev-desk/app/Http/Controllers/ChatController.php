<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
class ChatController extends Controller
{
    public function getAllChats()
    {
        $chats = Chat::all();
        return response()->json($chats, 200);
    }


    public function getChat(Request $req)
    {
        $chat = Chat::find($req->id);
        if (!$chat) {
            return response()->json(['error' => 'Chat not found'], 404);
        }
        return response()->json($chat, 200);
    }


    public function createChat(Request $req)
        {

            $username1 = $req->input('username1');
            $username2 = $req->input('username2');

            $validatedUser1 = User::where('username', $username1)->first();
            $validatedUser2 = User::where('username', $username2)->first();
            
            if (!$validatedUser1 || !$validatedUser2 || $validatedUser2 == $validatedUser1) {
                return response()->json([
                    'error' => 'note available users',
                    "message"=>$username1,$validatedUser1
                ], 404);
            }

            $chat = Chat::where(function($query) use ($username1, $username2) {
                $query->where('username_1', $username1)
                      ->where('username_2', $username2);
            })->orWhere(function($query) use ($username1, $username2) {
                $query->where('username_1', $username2)
                      ->where('username_2', $username1);
            })->first();
            
            if (!$chat) {
                $chat = Chat::create([
                    'username_1' => $username1,
                    'username_2' => $username2
                ]);
            }

        return response()->json([
            "message"=>$chat]
        , 201);
    }

    public function updateChat(Request $req)
    {
        $chat = Chat::find($req->id);
        if (!$chat) {
            return response()->json(['error' => 'Chat not found'], 404);
        }

        $chat->username_1 = $req->username_1;
        $chat->username_2 = $req->username_2;
        $chat->save();

        return response()->json($chat, 200);
    }

    public function deleteChat(Request $req)
    {
        $chat = Chat::find($req->id);
        if (!$chat) {
            return response()->json(['error' => 'Chat not found'], 404);
        }

        $chat->delete();

        return response()->json(['message' => 'Chat deleted successfully'], 200);
    }
}

