<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\CancelOrder;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $user = Auth::user();
        $supplier = $user->supplier;

        $query = Order::query();

        $query->where('supplier_id', $supplier->id);

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('min_total')) {
            $query->where('total', '>=', $request->input('min_total'));
        }
        if ($request->has('max_total')) {
            $query->where('total', '<=', $request->input('max_total'));
        }

        // if ($request->has('product_name')) {
        //     $query->where('name', 'like', '%' . $request->input('product_name') . '%');
        // }

        // if ($request->has('status')) {
        //     $query->where('status', 'like', '%' . $request->input('status') . '%');
        // }

        $query->orderByDesc('id');
        $orders = $query->paginate($perPage);
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('supplier.orders.index', compact('orders', 'user'));
    }

    public function show(Request $request, Order $order)
    {
        $productVariant = ProductVariant::find($order->detail->product_variant_id) ?? new ProductVariant();
        $user = User::find($order->user_id);
        return view('supplier.orders.show', compact('order', 'productVariant', 'user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:50|in:pending,processing,shipping,shipped,canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());
        if ($request->has('cause') && $request->status == 'canceled') {
            CancelOrder::create([
                'by' => 'supplier',
                'order_id' => $order->id,
                'cause' => $request->cause,
            ]);
            $product = ProductVariant::find($order->detail()->product_variant_id);
            if ($product) {
                $product->update(['stock' => $product->stock + $order->detail()->quantity]);
            }
        }
        return redirect()->route('supplier.orders.show', ['order' => $id])->with('success', 'Order updated successfully.');
    }
}
