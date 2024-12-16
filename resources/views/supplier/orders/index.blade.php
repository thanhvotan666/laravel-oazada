@extends('layouts.supplier')

@section('title',  request()->getHost() . ': Orders')
@section('content')
    <div class="container-fluid d-flex flex-column gap-4 bg-grey">
        <div class="p-5 d-flex flex-column gap-4">
            <div class="d-flex justify-content-between">
                <div class="h2 fw-bold ">
                    Orders
                </div>
                <div></div>
                {{-- <a class="h2 fw-bold btn btn-success px-3">
                    Add
                </a> --}}
            </div>
            <div class="container-fluid bg-white border rounded-4" style="min-height: 450px">
                <form class="" method="GET" action="">
                    <div class="navbar">
                        <div class="container-fluid">
                            <div class="d-flex gap-3 p-4 w-100  ">
                                <div class="input-group" style="width: 100%;">
                                    <span class="input-group-text bg-white " id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search products"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                                    aria-label="Toggle navigation">
                                    <div class="text-success d-flex align-items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z" />
                                        </svg>
                                        Filter
                                    </div>
                                </button>
                            </div>

                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar"
                                aria-labelledby="offcanvasDarkNavbarLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Filter orders</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body d-flex flex-column gap-4">
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            onclick="document.getElementById('status').disabled = !this.checked;"
                                            @checked(request('status'))>
                                        <label class="w-25" for="status">
                                            STATUS
                                        </label>
                                        <select name="status" id="status"
                                            class="form-control select-control fs-6 fw-semibold"
                                            @disabled(request('status', '') === '')>
                                            <option @selected(request('status', '') === 'pending') value="pending">pending</option>
                                            <option @selected(request('status', '') === 'processing') value="processing">processing</option>
                                            <option @selected(request('status', '') === 'shipping') value="shipping">shipping</option>
                                            <option @selected(request('status', '') === 'shipped') value="shipped">shipped</option>
                                            <option @selected(request('status', '') === 'canceled') value="canceled">canceled</option>
                                        </select>
                                    </div>

                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            onclick="document.getElementById('min_total').disabled = !this.checked;"
                                            @checked(request('min_total'))>
                                        <label class="w-25" for="min_total">
                                            Min total
                                        </label>
                                        <input type="number" name="min_total" id="min_total"
                                            value="{{ request('min_total', 0) }}" @disabled(!request('min_total'))>
                                    </div>

                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            onclick="document.getElementById('max_total').disabled = !this.checked;"
                                            @checked(request('max_total'))>
                                        <label class="w-25" for="max_total">
                                            Max total
                                        </label>
                                        <input type="number" name="max_total" id="max_total"
                                            value="{{ request('max_total', 0) }}" @disabled(!request('max_total'))>
                                    </div>

                                    {{-- <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            onclick="document.getElementById('product_name').disabled = !this.checked;"
                                            @checked(request('product_name'))>
                                        <label class="w-25" for="product_name">
                                            Product name
                                        </label>
                                        <input type="text" name="product_name" id="product_name"
                                            value="{{ request('product_name', '') }}" @disabled(!request('product_name'))>
                                    </div> --}}

                                    <div class="text-center">
                                        <input type="submit" value="Filter" class="btn btn-orange">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ORDER</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">DELIVERY METHOD</th>
                                    <th scope="col">DATE</th>
                                    <th scope="col">TOTAL</th>
                                    <th scope="col"></th>
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
                                                style="width: fit-content" data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                                @if ($order->status === 'canceled') onmouseover="this.click()" @endif>
                                                {{ $order->status }}
                                            </div>
                                            @if ($order->status === 'canceled')
                                                <ul class="dropdown-menu px-2 ">
                                                    <li>
                                                        By: {{ $order->cancel->by }}
                                                    </li>
                                                    <li>
                                                        Cause: {{ $order->cancel->cause }}
                                                    </li>
                                                </ul>
                                            @endif
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
                                        <td class="text-end">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16"
                                                class="btn btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                            </svg>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('supplier.orders.show', ['order' => $order->id]) }}">View</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action=""></form>
                                                    <form action="" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this order?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item text-danger disabled">Remove(disabled)</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-3 d-flex align-items-center gap-4 justify-content-center">
                            <div>
                                <label for="per_page">Num of row:</label>
                                <select name="per_page" id="per_page" onchange="this.form.submit()"
                                    class="form-select">
                                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                            </div>
                        </div>

                        <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                            {{ $orders->appends([
                                    'per_page' => request('per_page'),
                                    'status' => request('status'),
                                    'min_total' => request('min_total'),
                                    'max_total' => request('max_total'),
                                ])->links() }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
