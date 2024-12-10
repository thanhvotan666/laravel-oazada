@extends('layouts.supplier')

@section('title',  request()->getHost() .' - Dashboard')
@section('content')
    <main class="container-fluid p-0 bg-grey">
        <div class="container-fluid p-4 py-5 d-flex flex-column gap-3">
            <div class="h2 fw-semibold">Supplier Dashboard</div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="p-3">
                        <div class="bg-white rounded-4 border">
                            <div class="p-3 d-flex gap-4">
                                <div class="d-flex justify-content-center align-items-center rounded-4 bg-orange"
                                    style="width: 60px;height: 60px;">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <div class="fw-bold text-secondary small">ORDERS</div>
                                    <!-- edit -->
                                    <div class="fs-5 fw-semibold">{{ $supplier->orders->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-3">
                        <div class="bg-white rounded-4 border">
                            <div class="p-3 d-flex gap-4">
                                <div class="d-flex justify-content-center align-items-center rounded-4 bg-orange"
                                    style="width: 60px;height: 60px;">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <div class="fw-bold text-secondary small">PRODUCTS</div>
                                    <!-- edit -->
                                    <div class="fs-5 fw-semibold">{{ $supplier->products->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-3">
                        <div class="bg-white rounded-4 border">
                            <div class="p-3 d-flex gap-4">
                                <div class="d-flex justify-content-center align-items-center rounded-4 bg-orange"
                                    style="width: 60px;height: 60px;">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            fill="currentColor" class="bi bi-currency-exchange" viewBox="0 0 16 16">
                                            <path
                                                d="M0 5a5 5 0 0 0 4.027 4.905 6.5 6.5 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05q-.001-.07.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.5 3.5 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98q-.004.07-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5m16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0m-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <div class="fw-bold text-secondary small">TOTAL</div>
                                    <!-- edit -->
                                    <div class="fs-5 fw-semibold">${{ $supplier->orders->sum('total') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-4 border">
                <div class="px-4 py-3 fw-bold">
                    ORDERS
                </div>
                <div>
                    <hr class="m-0">
                </div>
                <div class="d-flex flex-wrap gap-2 justify-content-around">
                    {{-- <div class="w-100" style="min-width: 230px;max-width: 230px;">
                        <div class="p-3">
                            <div class="bg-white rounded-4 border">
                                <div class="p-3">
                                    <div>
                                        <div class="fw-bold text-secondary small text-uppercase">all ()</div>
                                        <!-- edit -->
                                        <div class="fs-5 fw-semibold">$123</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- groupby status -->

                    @foreach ($supplier->orders->groupBy('status') as $key => $value)
                        <div class="w-100" style="min-width: 250px;max-width: 250px;">
                            <div class="p-3">
                                <div class="bg-white rounded-4 border text-uppercase">
                                    <div class="p-3">
                                        <div>
                                            <div class="fw-bold text-secondary small">{{ $key }}
                                                ({{ $value->count() }})
                                            </div>
                                            <!-- edit -->
                                            <div class="fs-5 fw-semibold">${{ $value->sum('total') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="w-100 p-5" style="margin: auto;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
            <!-- litmit 5 -->
            <div class="bg-white rounded-4 border overflow-hidden">
                <table class="table table-hover m-0">
                    <thead>
                        <tr>
                            <th scope="col" colspan="4" class="px-4">Latest Customers</th>
                            <th scope="col" class="text-end px-4">
                                <a href="{{ route('supplier.orders.index') }}">
                                    View All
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lastOrders as $order)
                            <tr>
                                <th scope="row" class="align-middle text-warning text-center">
                                    {{-- new --}}
                                </th>
                                <th class="align-middle">
                                    {{ $order->created_at->format('d M') }}
                                </th>
                                <th class="align-middle">
                                    {{ $order->user->name }}
                                </th>
                                <th>
                                    <div>
                                        {{ $order->user->orders->where('supplier_id', '=', $supplier->id)->count() }}
                                        orders placed
                                    </div>
                                    <div>
                                        ${{ $order->user->orders->where('supplier_id', '=', $supplier->id)->sum('total') }}
                                        spent
                                    </div>
                                </th>
                                <th class="align-middle text-end">
                                    <button type="button" class="btn btn-outline-success rounded-3 me-4"
                                        onclick="sendCustomer({{ $order->user->id }})">
                                        Chat now
                                    </button>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <script>
        const chartData = @json($chartData);
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line', // Biểu đồ dạng đường
            data: {
                labels: chartData.labels, // Nhãn trục X
                datasets: [{
                        label: 'All orders',
                        data: chartData.allOrders, // Dữ liệu doanh thu
                        backgroundColor: 'rgba(0, 128, 0, 0.2)', // Màu nền phía dưới đường
                        borderColor: 'rgba(0, 128, 0, 1)', // Màu đường
                        borderWidth: 2, // Độ rộng đường
                        fill: true // Tô nền phía dưới đường
                    },
                    {
                        label: 'Canceled Orders',
                        data: chartData.canceledOrders, // Dữ liệu doanh thu
                        backgroundColor: 'rgba(255, 0, 0, 1)', // Màu nền phía dưới đường
                        borderColor: 'rgba(255, 0, 0, 1)', // Màu đường
                        borderWidth: 2, // Độ rộng đường
                        fill: false // Tô nền phía dưới đường
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.raw} orders`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
