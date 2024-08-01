<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::all();
        return response()->json($chats, 200);
    }
    
        public function store(StoreChatRequest $request)
    {
        $username1 = $request->input('username1');
        $username2 = $request->input('username2');

        $validatedUser1 = User::where('username', $username1)->first();
        $validatedUser2 = User::where('username', $username2)->first();

        if (!$validatedUser1 || !$validatedUser2) {
            return response()->json([
                'error' => 'Users not found',
                'message' => 'One or both usernames are invalid.'
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
            'message' => $chat
        ], 201);
    }

    public function update(UpdateChatRequest $request, chat $chat)
    {
        $chat->update($request->validated());
        return response()->json([
            "message" => $chat
        ], 200);
    }
    
    public function destroy(chat $chat)
    {
        $chat->delete();
        return response()->json(null,204);
        
        
        }

    //     public function getChat($id)
    // {
    //     $chat = Chat::find($req->id);
    //     if (!$chat) {
    //         return response()->json(['error' => 'Chat not found'], 404);
    //     }
    //     return response()->json($chat, 200);
    // }

    public function getChatByUsername($username_1)
    {
        $chat=Chat::where("username_1",$username_1)->get();
        if ($chat->isEmpty()){
            return response()->json([[
                "message"=>'no chats found'
            ]],404);
         }
        return response()->json($chat);
    }
}

