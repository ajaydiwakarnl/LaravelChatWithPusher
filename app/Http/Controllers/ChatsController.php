<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $updateStatus = User::find(auth()->user()->id);
        $updateStatus->isActive = 1;
        $updateStatus->save();
        return view('chat');
    }

    public function fetchMessages(Request  $request)
    {

        return Message::with('user')->where('sender_id',auth()->user()->id)->where('receiver_id',$request->receiver_id)->get();
    }

    public function fetchUsers()
    {
        return User::where('id','!=',auth()->user()->id)->get();
    }



    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = new Message;
        $message->message = $request->input('message');
        $message->sender_id = auth()->user()->id;
        $message->receiver_id = $request->input('recevier_id');
        $message->type = $request->input('type');
        $message->save();

        broadcast(new MessageSent($user, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}
