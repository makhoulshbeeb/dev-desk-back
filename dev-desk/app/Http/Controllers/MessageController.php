<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Chat;
class MessageController extends Controller

{
    public function getAllMessages()
        {
            $messages = Message::all();
            // $messages = Message::get();
            if (!$messages) {
                return response()->json([
                    'error' => 'Message not found'
                ], 404);
            }
            return response()->json([
                "messages" => $messages
            ], 200);
        }
    //   public function getAllMessages($id)
    //     {
    //         $this->middleware('admin');
    //         $messages = Message::find($id);
    //         // $messages = Message::get();
    //         if (!$messages) {
    //             return response()->json([
    //                 'error' => 'Message not found'
    //             ], 404);
    //         }
    //         return response()->json([
    //             "messages" => $messages
    //         ], 200);
    //     }

    public function getMessage(Request $req)
        {
            // $this->middleware('admin');
            $username = $req->input('username');
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

        public function updateMessage(Request $req)
        {
            $message = Message::find($req->id);
            if (!$message) {
                return response()->json([
                    'error' => 'Message not found'
                ], 404);
            }
            $message->message = $req->message;
            $message->save();
            return response()->json([
                'message' => $message,
                'state' => 'success',
            ], 200);
        }   

        public function deleteMessage(Request $req)
        {
            $id = $req->input('id');
            $message = Message::find($id);
            if (!$message) {
                return response()->json([
                    'error' => 'Message not found'
                ], 404);
            }
            $message->delete();
            return response()->json([
                "message" => "deleted successfully",
                "state" => "success",
            ], 200);
        }

        public function createMessage(Request $req)
        {

            $username1 = $req->input('username1');
            $username2 = $req->input('username2');

            $validatedUser1 = User::where('username', $username1)->first();
            $validatedUser2 = User::where('username', $username2)->first();
    
            if (!$validatedUser1 || !$validatedUser2 || $validatedUser2 == $validatedUser1) {
                return response()->json([
                    'error' => 'note available users',
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

            $message = Message::create([
                'username' => $username1,
                'message' => $req->input('message'),
                'chat_id' => $chat->id,
            ]);
    
            return response()->json([
                'message' => $message,
                'state' => 'success'
            ], 201);
        }
}