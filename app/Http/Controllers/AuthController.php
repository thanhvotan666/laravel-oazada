<?php

namespace App\Http\Controllers;

use App\Models\CancelOrder;
use App\Models\Cart;
use App\Models\CategoryType;
use App\Models\Country;
use App\Models\Discount;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Decimal;
use Str;

class AuthController extends Controller
{
    public function cart(Request $request)
    {
        $user = Auth::user();
        $categoryTypes = CategoryType::all();
        $carts = Cart::where('user_id', $user->id)->get();
        $discount = new Discount([
            'id' => 0,
            'code' => '',
            'name' => '',
            'value' => 0,
            'type' => 'direct',
        ]);
        $cartSelect = $carts[0] ?? new Cart(['id' => 0]);
        //dd($cartSelect);
        if ($request->has('cart_id')) {
            $cartSelect = Cart::where('user_id', $user->id)
                ->find($request->input('cart_id'));
        }

        if (!$request->has('discount_code')) {
            return view('customer.cart', compact(
                'categoryTypes',
                'carts',
                'discount',
                'cartSelect'
            ));
        }
        if ($request->discount_code == '') {
            return view('customer.cart', compact(
                'categoryTypes',
                'carts',
                'discount',
                'cartSelect'
            ));
        }
        $discount = Discount::where('code', $request->discount_code)->first();
        if (!$discount) {
            return redirect()->back()->with('error_code', 'None voucher with this code: ' . $request->discount_code . ' !');
        }
        if ($discount->status === 'expired') {
            return redirect()->back()->with('error_code', 'Voucher ' . $request->discount_code . ' is expired!');
        }
        return view('customer.cart', compact(
            'categoryTypes',
            'carts',
            'discount',
            'cartSelect'
        ));
    }
    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $product = Product::find($request->product_id);
        if (!$product->is_variant) {
            $productVariant = ProductVariant::where('product_id', $product->id)->firstOrFail();
            $carts = Cart::where('user_id', $user->id)
                ->where('product_variant_id', $productVariant->id)
                ->get();
            if ($carts->count() > 0) {
                $cart = $carts->first();
                $cart->update(['quantity' => ($cart->quantity + $request->quantity)]);
                return redirect(route('cart'))->with('success', 'Product has been added');
            }
            Cart::create([
                'product_variant_id' => $productVariant->id,
                'user_id' => $user->id,
                'quantity' => $request->quantity,
            ]);
        } else {
            $request->validate([
                'options' => 'required'
            ]);
            $options = $request->options;
            $query = ProductVariant::query();
            $query->where('product_id', $product->id);
            foreach (explode(',', $options) as $option) {
                $query->whereHas('options', function ($q) use ($option) {
                    $q->where('value', $option);
                });
            };
            $productVariants = $query->get();
            if ($productVariants->count() === 1) {
                $productVariant = $productVariants->first();
                $carts = Cart::where('user_id', $user->id)
                    ->where('product_variant_id', $productVariant->id)
                    ->get();
                if ($carts->count() > 0) {
                    $cart = $carts->first();
                    $cart->update(['quantity' => ($cart->quantity + $request->quantity)]);
                    return redirect(route('cart'))->with('success', 'Product has been added');
                }
                Cart::create([
                    'product_variant_id' => $productVariant->id,
                    'user_id' => $user->id,
                    'quantity' => $request->quantity,
                ]);
            } else {
                return back()->with('error', 'You have not selected enough attributes');
            }
        }
        return redirect(route('cart'))->with('success', 'Product added to cart');
    }
    public function removeOutCart(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->find($id);
        if (!$cart) {
            return back()->with('error', 'Delete is failed');
        }
        $cart->delete();
        return back()->with('success', 'Deleted successfully');
    }
    public function changeQuantityCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        if ($request->quantity < 0) {
            return back()->with('error', 'Quantity cannot be negative');
        }
        if ($request->quantity == 0) {
            $result = $cart->delete();
            if ($result) {
                return back()->with('success', 'Cart is deleted');
            }
            return back()->with('error', 'Delete cart failed');
        }
        $result = $cart->update(['quantity' => $request->quantity]);
        if ($result) {
            return back()->with('success', 'Quantity updated');
        }
        return back()->with('error', 'Update quantity failed');
    }
    public function orders(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $user = Auth::user();
        $categoryTypes = CategoryType::all();
        $orders = Order::where('user_id', $user->id)->orderByDesc('id')->paginate($perPage);

        return view('customer.orders', compact(
            'categoryTypes',
            'orders',
        ));
    }
    public function order(Request $request, $id)
    {
        $user = Auth::user();
        $categoryTypes = CategoryType::all();
        $order = Order::where('user_id', $user->id)->find($id);
        if (!$order) {
            return redirect()->route('index');
        }

        $product_variant = ProductVariant::find($order->detail->product_variant_id);

        return view('customer.order', compact(
            'categoryTypes',
            'order',
            'user',
            'product_variant'
        ));
    }
    public function profile(Request $request)
    {
        $user = Auth::user();
        $categoryTypes = CategoryType::all();
        $orders = Order::where('user_id', $user->id)->orderByDesc('id')->get();

        $reviews = ProductReview::where('user_id', $user->id)->get();

        return view('customer.profile', compact(
            'categoryTypes',
            'user',
            'orders',
            'reviews',
        ));
    }
    public function favorite(Request $request)
    {
        $user = Auth::user();
        $categoryTypes = CategoryType::all();
        $favorites = Favorite::where('user_id', $user->id)->get();
        return view('customer.favorite', compact(
            'categoryTypes',
            'favorites',
        ));
    }
    public function checkout(Request $request)
    {
        $user = Auth::user();

        $query = Cart::query()->where('user_id', $user->id);
        if (!$request->has('cart_id')) {
            return back()->with('error', 'Select a cart!!');
        }
        $query->where('id', $request->input('cart_id'));
        $carts = $query->get();

        if ($carts->count() == 0) {
            return redirect(route('cart'))->with('error', 'There are no products in the cart');
        }
        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->productVariant->stock) {
                return redirect()->route('cart')->with('error', 'Insufficient stock: '
                    . $cart->productVariant->product->code
                    . ' - '
                    . $cart->productVariant->product->name
                    . ' - '
                    . $cart->productVariant->options->pluck('value')->join(', '));
            }
        }
        $discount = new Discount(['value' => 0]);
        if ($request->has('discount_code')) {
            $discount = Discount::where('code', $request->discount_code)->first();
        }
        $categoryTypes = CategoryType::all();
        $countries = Country::all();
        return view('customer.checkout', compact(
            'categoryTypes',
            'discount',
            'carts',
            'countries',
            'user'
        ));
    }
    public function addToFavorite(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $product = Product::find($request->product_id);
        if (!$product->is_variant) {
            $productVariant = ProductVariant::where('product_id', $product->id)->firstOrFail();
            $favorite = Favorite::where('user_id', $user->id)->where('product_variant_id', $productVariant->id)->get();
            if ($favorite) {
                return back()->with('success', 'Product already exists in favorites');
            }
            Favorite::create([
                'product_variant_id' => $productVariant->id,
                'user_id' => $user->id,
            ]);
        } else {
            $request->validate([
                'options' => 'required'
            ]);
            $options = $request->options;
            $query = ProductVariant::query();
            $query->where('product_id', $product->id);

            foreach (explode(',', $options) as $option) {
                $query->whereHas('options', function ($q) use ($option) {
                    $q->where('value', $option);
                });
            };
            $productVariants = $query->get();
            if ($productVariants->count() === 1) {
                $productVariant = $productVariants->first();
                $favorite = Favorite::where('user_id', $user->id)
                    ->where('product_variant_id', $productVariant->id)
                    ->get();
                if ($favorite->count() === 1) {
                    return back()->with('success', 'Product already exists in favorites');
                }
                Favorite::create(['product_variant_id' => $productVariant->id, 'user_id' => $user->id,]);
            } else {
                return back()->with('error', 'You have not selected enough attributes');
            }
        }
        return back()->with('success', 'Product added to favorites');
    }
    public function removeOutFavorite(Request $request, $id)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->find($id);
        if (!$favorite) {
            return back()->with('error', 'Delete is failed');
        }
        $favorite->delete();
        return back()->with('success', 'Deleted successfully');
    }
    public function checkOrder(Request $request)
    {

        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:500',
            'phone' => 'required|string|max:15',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'discount_code' => 'nullable|string|max:255',
            'discount_type' => 'nullable|string|in:direct,percent',
            'discount_value' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'items_subtotal' => 'required|numeric|min:0',
            'shipping_cost' => 'nullable|numeric|min:0',
        ]);
        $validatedData['user_id'] = $user->id;
        $validatedData['country'] = Country::find($validatedData['country_id'])->name;

        //dd($validatedData);

        $carts = Cart::where('user_id', $user->id)
            ->where('id', $request->cart_id)->get();

        //check items
        $items_subtotal = 0;
        foreach ($carts as $cart) {
            $items_subtotal += $cart->productVariant->price * $cart->quantity;
            if ($cart->quantity > $cart->productVariant->stock) {
                return redirect()->route('cart')->with('error', 'Insufficient stock: '
                    . $cart->productVariant->product->code
                    . ' - '
                    . $cart->productVariant->product->name
                    . ' - '
                    . $cart->productVariant->options->pluck('value')->join(', '));
            }
        }
        if ($items_subtotal != $validatedData['items_subtotal']) {
            return back()->with('error', "Checkout is failed" . ": items_subtotal:" . $items_subtotal . " != " . "validatedData['items_subtotal']:" . $validatedData['items_subtotal']);
        }

        //check discount
        if ($request->has('discount_code') && !is_null($validatedData['discount_code'])) {
            $discount_code = Discount::where('code', $validatedData['discount_code'])->get();
            if ($discount_code->isEmpty()) {
                return back()->with('error', "Voucher: " . $discount_code . " is error");
            }
        }
        try {
            $order = Order::create($validatedData);
            foreach ($carts as $cart) {
                $data = [
                    "order_id" => $order->id,
                    "product_variant_id" => $cart->productVariant->id,
                    "variant" => $cart->productVariant->options->pluck('value')->join(', '),
                    "name" => $cart->productVariant->product->code . " - " . $cart->productVariant->product->name,
                    "quantity" => $cart->quantity,
                    "price" => $cart->productVariant->price,
                    "weight" => $cart->productVariant->weight,
                ];

                OrderDetail::create($data);
                $reduceStock =  $cart->productVariant->stock - $cart->quantity;
                ProductVariant::find($cart->productVariant->id)->update(['stock' => $reduceStock]);
                $cart->delete();
            }
            return redirect(route('order', ['id' => $order->id]))->with('success', 'Your order is being confirmed');
        } catch (\Exception $e) {
            return back()->with('error', 'Error!!!');
        }
    }
    public function cancelOrder(Request $request, $id)
    {
        $user = Auth::user();
        if (!$request->has('cause')) {
            return back()->with('error', 'error: no reason!');
        }
        $order = Order::where('user_id', $user->id)->find($id);

        CancelOrder::create([
            'order_id' => $id,
            'cause' => $request->input('cause'),
            'by' => 'customer'
        ]);
        $order->update([
            'status' => 'canceled'
        ]);
        return back()->with('success', 'Order has been canceled!');
    }
    public function productReview(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            back()->with("error", "You need to login!");
        }
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'star' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
        ]);
        // $order = Order::where('user_id' ,$user->id)
        // ->whereHas('detail', function ($q) use ($request) {
        //     $q->where('country_id', $array);
        // });
        ProductReview::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'star' => $request->star,
            'review' => $request->review,
        ]);
        return back()->with('success', 'Your review has been noted.');
    }

    public function updateNameUser(Request $request)
    {
        $user =  User::find(Auth::id());
        $validatedData = $request->validate([
            'name' => 'required|string|min:1'
        ]);
        try {

            $user->update($validatedData);

            return back()->with('success', 'Your name was updated!');
        } catch (\Exception $e) {

            return back()->with('error', 'Failed to update your name. Please try again.');
        }
    }
    public function updateAddressUser(Request $request)
    {
        $user =  User::find(Auth::id());
        $validatedData = $request->validate([
            'address' => 'nullable|string|min:1',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|min:8',
        ]);
        try {
            $user->update($validatedData);

            return back()->with('success', 'Your default address was updated!');
        } catch (\Exception $e) {

            return back()->with('error', 'Failed to update your default address. Please try again.');
        }
    }
}
