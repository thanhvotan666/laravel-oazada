<?php

namespace App\Http\Controllers;

use App\Events\NewMessageEvent;
use App\Models\Message;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender' => auth()->id(),
            'receiver' => $request->receiver,
            'message' => $request->message,
            'new' => true,
        ]);

        broadcast(new NewMessageEvent($message))->toOthers();

        return response()->json(['status' => 'Message sent!', 'message' => $message]);
    }
    public function sendSupplier(Request $request)
    {
        if ($request->receiver == auth()->id()) {
            return redirect(null, 403);
        }
        $user = User::find($request->receiver);
        $supplier = Supplier::where('user_id', $user->id)->first();

        $message = Message::create([
            'sender' => auth()->id(),
            'receiver' => $request->receiver,
            'message' => "Hi, " . $supplier->name,
            'new' => true,
        ]);

        broadcast(new NewMessageEvent($message))->toOthers();

        return response()->json(['status' => 'Message sent!', 'message' => $message]);
    }
    public function sendCustomer(Request $request)
    {
        if ($request->receiver == auth()->id()) {
            return redirect(null, 403);
        }
        $user = User::find($request->receiver);

        $message = Message::create([
            'sender' => auth()->id(),
            'receiver' => $request->receiver,
            'message' => "Hi, " . $user->name,
            'new' => true,
        ]);

        broadcast(new NewMessageEvent($message))->toOthers();

        return response()->json(['status' => 'Message sent!', 'message' => $message]);
    }
}
