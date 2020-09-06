<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat.chat');
    }

    public function fetchAll()
    {
        return Message::with('user')->get();
    }

    public function fetchAllWithUserId(Request $request)
    {
        $messages = Message::where('to_user_id', $request->user_id)
            ->orWhere('user_id', $request->user_id)->with('user', 'toUser')->get();

        foreach ($messages as $msg) {
            $userId = ($msg->user_id == $request->user_id) ? $msg->to_user_id : $msg->user_id;
            $msg->key = $userId;
        }
        $messages = $messages->groupBy('key')->sortBy('created_at');
        error_log($messages);


        return response()->json(['data' => $messages, 'status' => 'success']);
    }

    public function sendMessage(Request $request)
    {
        $chat = Message::create(['to_user_id' => $request->user_id, 'user_id' => \Auth::id(), 'message' => $request->message]);

        echo 'created message = ' . $chat->message . $chat->to_user_id;

        broadcast(new MessageEvent($chat->load('user')))->toOthers();

        return response()->json(['status' => 'success']);
    }
}
