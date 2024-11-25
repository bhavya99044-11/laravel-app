<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Events\ChatSender;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Broadcast;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Chat;
use App\Events\ActiveEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ChatController extends Controller
{
    protected $data;
    public function index()
    {
        return view('frontend.content');
    }

    // Chat view whene user not selected
    public function chatView($id = null)
    {
        try {
            $id = (int) $id;
            $authId = Auth::user()->id;
            $this->data['users'] = User::select(['name', 'id', 'last_seen'])->get();
            $id == null ? [
                $receiver = $this->data['users']->where('id', '!=', $authId)->first(),
                $receiverId = $receiver->id
            ] : [
                $receiver = $this->data['users']->where('id', '=', $id)->first(),
                $receiverId = $receiver->id
            ];
            $this->data['users-chat'] = Chat::where(function ($query) use ($authId, $receiverId) {
                $query->where('sender_id', $authId)->where('receiver_id', $receiverId);
                $query->orWhere('sender_id', $receiverId)->where('receiver_id', $authId);
            })->orderBy('created_at', 'ASC')->get();
            Broadcast(new ActiveEvent(Auth::user()));
            $this->data['last_active'] = lastSeen($receiver->last_seen);
            $this->data['receiver'] = $receiver;
            return view('frontend.chat')->with(['data' => $this->data]);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage(),
            ]);
        }
    }

    //When user id for chat selected
    public function chatUser(Request $request, $id)
    {
        $this->chatView($id);
        return view('frontend.chat')->with(['data' => $this->data]);
    }

    //Store message in database and pusher functionality
    public function send(Request $request)
    {
        try {
            DB::beginTransaction();
            $message = array();
            if ($request->files->has('images')) {
                foreach ($request->images as $image) {
                    $imageName = time() . $image->getClientOriginalname();
                    $imageName = str_replace(' ', '', $imageName);
                    $image->move('chatimages', $imageName);
                    $senderId = Auth::user()->id;
                    $receiverId = $request->receiver_id;
                    $message[] = Chat::create([
                        'sender_id' => $senderId,
                        'receiver_id' => $receiverId,
                        'message' => null,
                        'image_path' => 'chatimages/' . $imageName,
                        'message_type' => 1
                    ]);
                    $id = count($message) - 1;
                    $message[$id]['date'] = Carbon::parse($message[$id]['created_at'])->format('H:i');
                }
            }
            if (!empty($request->message)) {
                $senderId = Auth::user()->id;
                $receiverId = $request->receiver_id;
                $message[] = Chat::create([
                    'sender_id' => $senderId,
                    'receiver_id' => $receiverId,
                    'message' => $request->message,
                    'image_path' => null,
                    'message_type' => 0
                ]);
                $id = count($message) - 1;
                $message[$id]['date'] = Carbon::parse($message[$id]['created_at'])->format('H:i');
            }
            $pusher = new Pusher(
                config('broadcasting.connections.pusher.key'),
                config('broadcasting.connections.pusher.secret'),
                config('broadcasting.connections.pusher.app_id'),
                config('broadcasting.connections.pusher.options')
            );
            $pusher->trigger('chat-' . $receiverId . '', 'ChatSender', $message);
            DB::commit();
            return response()->json([
                'status' => 200,
                'data' => $message
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function messages($userId)
    {
        // Retrieve messages from database and return them
    }
    public function statusUpdate(Request $request)
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            config('broadcasting.connections.pusher.options')
        );
        $user = $request->input('events');
        foreach ($user as $key => $value) {
            if ($value['name'] == 'member_removed') {
                User::whereId($value['user_id'])->update([
                    'last_seen' => Carbon::now()
                ]);
                
                $pusher->trigger('chat-' . $value['user_id'] . '', 'ChatSender', [
                    'status' => 400,
                    'data' => [
                        'user_id' => $value['user_id'],
                        'last_seen' => Carbon::now()->format('H:i')
                    ]
                ]);
            }
        }
    }

    public function content(Request $request)
    {
        $password = Setting::where('key', '=', 'login_password')->pluck('password')->first();
        if (Session::get('content_password.expiry') < Carbon::now()->toDateTimeString()) {
            Session::forget('content_password');
        }
        if (
            Session::get('content_password') !== null &&
            Hash::check(Session::get('content_password.value'), $password)
        ) {
            return view('frontend.content');
        }
        return view('frontend.content');
    }

    public function passwordVerify(Request $request)
    {
        $password = Setting::where('key', '=', 'login_password')->pluck('password')->first();
        if (Hash::check($request->password, $password)) {
            Session::put('content_password', [
                'value' => (int) $request->password,
                'expiry' => Carbon::now()->addSeconds(30)
            ]);
            Cookie::queue('content_password', $request->password);
            return response()->json([
                'status' => 200,
                'message' => 'Success'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'invalid password'
            ]);
        }
    }
}
