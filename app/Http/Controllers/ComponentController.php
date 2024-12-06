<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComponentController extends Controller
{
    public function componentMessage(Request $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return view();
        }

        $messages = Message::where('sender', $userId)->get();
        return view('layouts.include.messenger');
    }
}
