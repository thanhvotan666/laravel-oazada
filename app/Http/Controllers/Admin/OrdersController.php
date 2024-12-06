<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $query = Order::query();

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('min_total')) {
            $query->where('total', '>=', $request->input('min_total'));
        }
        if ($request->has('max_total')) {
            $query->where('total', '<=', $request->input('max_total'));
        }
        if ($request->has('supplier_id')) {
            $query->where('supplier_id',  $request->input('supplier_id'));
        }
        $orders = $query->paginate($perPage);
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.orders.index', compact('orders', 'suppliers'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'total_amount' => 'required|numeric',
            'status' => 'required|string|max:50',
        ]);

        Order::create($request->all());
        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Request $request, Order $order)
    {

        $productVariant = ProductVariant::find($order->detail->product_variant_id) ?? new ProductVariant();
        $user = User::find($order->user_id);
        return view('admin.orders.show', compact('order', 'productVariant', 'user'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:50|in:pending,processing,shipping,shipped,canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());
        return redirect()->route('admin.orders.show', ['order' => $id])->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
