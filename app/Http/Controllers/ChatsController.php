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

        return view('chat');
    }

    public function fetchMessages(Request  $request)
    {

        return Message::with('user')
            ->where('sender_id',auth()->user()->id)
            ->where('receiver_id',$request->receiver_id)
            ->orwhere('receiver_id',$request->receiver_id)
            ->orwhere('sender_id',auth()->user()->id)
            ->get();
    }

    public function fetchUsers()
    {
        $userArray = array();
        $data = User::with('messages')->get();
        foreach ($data as $d){

            foreach ($d->messages as $msg){

              if($msg->message !== null){
                 $user = User:: findorFail($msg->receiver_id);
                  array_push($userArray,$user);
              }
            }

        }

        return $userArray;
    }

    public function searchUsers(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = User::where('email', 'LIKE','%'.$request->keyword.'%')->get();
        return response()->json($data);
    }


    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $data = [
            'user_id' => $request->input('user_id'),
            'sender_id' =>   $request->input('sender_id'),
            'receiver_id' => $request->input('receiver_id'),
            'message' => $request->input('message'),
            'type' =>  $request->input('type'),
            'channel' =>  $request->input('channel'),
        ];

        $message = $user->messages()->create($data);


        broadcast(new MessageSent($user, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}
