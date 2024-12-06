<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $supplier = $user->supplier;

        $orders = [];
        $labels = [];
        $allOrders = [];
        $canceledOrders = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('m-d');
            $formattedDate = $date->format('Y-m-d');

            $orders[$formattedDate] = $supplier->orders()
                ->whereDate('created_at', $date)
                ->get();
            $allOrders[] = $orders[$formattedDate]->count() ?? 0;
            $canceledOrders[] = $orders[$formattedDate]->where('status', 'canceled')->count() ?? 0;
        }
        $chartData = [
            'labels' => $labels,
            'allOrders' => $allOrders,
            'canceledOrders' => $canceledOrders
        ];

        $lastOrders = $supplier
            ->orders()
            ->orderByDesc('created_at')
            ->take(9)
            ->get()
            ->unique('user_id')
            ->take(5);
        return view('supplier.dashboard', compact('user', 'supplier', 'chartData', 'lastOrders'));
    }
}
