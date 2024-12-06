<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Country;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function headerCategory(Request $request)
    {
        $categories = Category::where('category_type_id', $request->category_type_id)->get();
        return view('ajax.header-category', compact(
            'categories'
        ));
    }

    public function headerProduct(Request $request)
    {
        if ($request->has('category_type_id')) {
            $categoryType = CategoryType::find($request->category_type_id);
            $category = Category::where('category_type_id', $request->category_type_id)->first();
            $products = Product::where('category_id', $category->id)->get();
            return view('ajax.header-product', compact(
                'products',
                'category'
            ));
        }

        $category = Category::find($request->category_id);
        $products = Product::where('category_id', $request->category_id)->get();
        return view('ajax.header-product', compact(
            'products',
            'category'
        ));
    }

    public function filterCountry(Request $request)
    {
        $countries = Country::where('country_name', 'LIKE', $request->country_name)->get();
        return view('ajax.filter-country', compact(
            'countries'
        ));
    }

    public function headerCart(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return "<a href='{{ route('login') }}'>Login to see cart</a>";
        }
        $carts = Cart::where('user_id', $user->id)->get();
        return view('ajax.header-cart', compact('carts'));
    }

    public function supplierCatogory(Request $request)
    {
        $categories = Category::where('category_type_id', $request->category_type_id)->get();
        return view('ajax.supplier-category', compact(
            'categories'
        ));
    }

    public function messageReceiver(Request $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect(null, 403);
        }
        $messages = Message::where('sender', $userId)
            ->orWhere('receiver', $userId)
            ->with([
                'senderUser:id,name',
                'receiverUser:id,name'
            ])
            ->orderByDesc('id')
            ->get()
            ->map(function ($message) use ($userId) {
                return [
                    'user' => $message->sender == $userId
                        ? $message->receiverUser
                        : $message->senderUser,
                    'new' => $message->sender == $userId
                        ? false : $message->new,
                ];
            })
            ->unique('user.id');
        return view('ajax.messengerReceiver', compact('messages', 'userId'));
    }
    public function messageSender(Request $request)
    {
        $sender = Auth::id();
        $receiver = $request->receiver;
        if (!$sender || !$receiver) {
            return redirect(null, 403);
        }
        $messages = Message::where(function ($query) use ($sender, $receiver) {
            $query->where('sender', $sender)
                ->where('receiver', $receiver);
        })
            ->orWhere(function ($query) use ($sender, $receiver) {
                $query->where('sender', $receiver)
                    ->where('receiver', $sender);
            })
            ->orderBy('id', 'desc')
            ->get();
        foreach ($messages as $message) {
            if ($message->sender === $sender) {
                continue;
            }
            $message->update(['new' => false]);
        }
        return view('ajax.messengerSender', compact('messages', 'sender', 'receiver'));
    }
}
