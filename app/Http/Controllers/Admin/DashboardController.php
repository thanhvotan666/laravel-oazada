<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $labels = [];

        $allOrders = [];

        $allSuppliers = [];

        $allProducts = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('m-d');

            $allOrders[] = Order::whereDate('created_at', "<=", $date)->count();

            $allSuppliers[] = Supplier::whereDate('created_at', "<=", $date)->count();

            $allProducts[] = Product::whereDate('created_at', "<=", $date)->count();
        }
        $chartData = [
            'labels' => $labels,
            'allOrders' => $allOrders,
            'allSuppliers' => $allSuppliers,
            'allProducts' => $allProducts
        ];
        $orderCount = Order::count();
        $supplierCount = Supplier::count();
        $productCount = Product::count();

        return view('admin.dashboard', compact('chartData', 'orderCount', 'supplierCount', 'productCount'));
    }
}
