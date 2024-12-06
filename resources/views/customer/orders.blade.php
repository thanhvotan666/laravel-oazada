@extends('layouts.app')

@section('title', 'Orders')
@section('content')
    <main class="container-fluid bg-grey">
        <div class="container">
            <div class="px-4 fs-4">
                <strong>Orders</strong>
                <small class="text-secondary">({{ $orders->count() }})</small>
            </div>
            <div class="p-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ORDER</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">DELIVERY METHOD</th>
                            <th scope="col">DATE</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col">VIEW</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="small">
                                <th scope="row">
                                    <div class="text-info">
                                        #{{ $order->id }}
                                    </div>
                                </th>
                                <td>
                                    <div class="p-1 rounded-3 fw-bold 
                                    @switch($order->status)
                                        @case('pending')
                                            bg-info text-white
                                            @break
                                        @case('processing')
                                            bg-primary text-white
                                            @break
                                        @case('shipping')
                                            bg-warning text-white
                                            @break
                                        @case('shipped')
                                            bg-success text-white
                                            @break
                                        @case('canceled')
                                            bg-danger text-white
                                            @break
                                    @endswitch"
                                        style="width: fit-content">
                                        {{ $order->status }}
                                    </div>
                                </td>
                                <td>
                                    {{ $order->delivery_method }}
                                </td>
                                <td>
                                    {{ $order->created_at }}
                                </td>
                                <td class="fw-semibold">
                                    ${{ $order->total }}
                                </td>
                                <td>
                                    <a href="{{ route('order', ['id' => $order->id]) }}" style="color:purple">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                            fill="currentColor" class="bi bi-eyeglasses" viewBox="0 0 16 16">
                                            <path
                                                d="M4 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4m2.625.547a3 3 0 0 0-5.584.953H.5a.5.5 0 0 0 0 1h.541A3 3 0 0 0 7 8a1 1 0 0 1 2 0 3 3 0 0 0 5.959.5h.541a.5.5 0 0 0 0-1h-.541a3 3 0 0 0-5.584-.953A2 2 0 0 0 8 6c-.532 0-1.016.208-1.375.547M14 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $orders->appends([
                        'per_page' => request('per_page'),
                    ])->links() }}
            </div>
        </div>
    </main>
@endsection
