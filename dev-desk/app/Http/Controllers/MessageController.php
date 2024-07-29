<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Chat;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
class MessageController extends Controller

{

    public function index()
    {
        $messages = Message::all();
        return response()->json($messages, 200);
    }

        public function update(UpdateMessageRequest $request, message $message)
        {
            $message->update($request->validated());
            return response()->json([
                'message' => 'Script updated successfully',
                'script' => $message
            ], 200);
        }

        public function store(StoreMessageRequest $request)
        {
            $username1 = $request->input('username1');
            $username2 = $request->input('username2');

            $validatedUser1 = User::where('username', $username1)->first();
            $validatedUser2 = User::where('username', $username2)->first();
    
            if (!$validatedUser1 || !$validatedUser2 || $validatedUser2 == $validatedUser1) {
                return response()->json([
                    'error' => 'note available users',
                ], 404);
            }

            $chat = Chat::where(function($query) use ($username1, $username2) {
                $query->where([
                    ['username_1', $username1],
                    ['username_2', $username2]
                ])->orWhere([
                    ['username_1', $username2],
                    ['username_2', $username1]
                ]);
            })->first();
    
            if (!$chat) {
                $chat = Chat::create([
                    'username_1' => $username1,
                    'username_2' => $username2
                ]);
            }
            $message = Message::create([
                'username' => $username1,
                'message' => $request->input('message'),
                'chat_id' => $chat->id,
            ]);
    
            return response()->json([
                'message' => $message,
                'state' => 'success'
            ], 201);
        }
    public function destroy(Message $id)
    {
        $id->delete();
        return response()->json(null, 204);
    }

    public function getmessagebyLike($keyword)
    {
        $messages = Message::where('message', 'LIKE', '%' . $keyword . '%')->get();
        if ($messages->isEmpty()) {
            return response()->json(['message' => 'No messages found'], 404);
        }
        return response()->json($messages, 200);
    }

    public function getMessage($username)
    {
        $messages = Message::where('username', $username)->get();
        if ($messages->isEmpty()) {
            return response()->json([
                'error' => 'No messages found for this username',
            ], 404);
        }
        return response()->json([
            'messages' => $messages,
            'state' => 'success',
        ], 200);
    }

    public function getMessagesbychat_id($id)
    {
        $messages = Message::where('chat_id', $id)->get();
        return response()->json($messages, 200);
    }

}