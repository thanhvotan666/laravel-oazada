@extends('layouts.app')

@section('title',  request()->getHost() . ': Order - ' . $order->id)
@section('content')
    <main class="container-fluid bg-grey">
        <div class="container">
            <div class="fw-bold fs-3 ps-4">Order #{{ $order->id }}</div>
            @include('include.showAlert')
            {{-- <div class="fw-bold fs-6 ps-5 text-secondary">Customer: #12421412</div> --}}
            <div class="row flex-row-reverse">
                <div class="col-xl-4">
                    <div class="p-4">
                        <div class="border rounded-4 bg-white p-3 d-flex flex-column gap-3">
                            <div class="fw-bold fs-5">Summary</div>
                            <div class="d-flex justify-content-between">
                                <div>Items subtotal :</div>
                                <div class="fs-6  fw-semibold">${{ $order->items_subtotal }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Discount :</div>

                                <div class="fs-6  fw-semibold  text-danger">-${{ $order->discount_value }}</div>
                            </div>
                            <div class="d-flex justify-content-between ">
                                <div>Subtotal :</div>
                                <div class="fs-6 fw-semibold {{ $order->discount_value == 0 ?: 'text-success' }} ">
                                    ${{ number_format($order->items_subtotal - $order->discount_value, 2) }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Shipping Cost :</div>

                                <div class="fs-6  fw-semibold">${{ $order->shipping_cost }}</div>
                            </div>
                            <div class="d-flex  fw-semibold justify-content-between" style="font-size: 11px;">
                                <div>Voucher code :</div>
                                <div class="text-success">{{ $order->discount_code }}</div>
                            </div>

                            <hr>

                            <div class="d-flex fw-semibold justify-content-between fs-3">
                                <div>Total :</div>

                                <div class="{{ $order->discount_value == 0 ?: 'text-success' }}">${{ $order->total }}
                                </div>
                            </div>
                        </div>
                        <div class="border rounded-4 bg-white p-3 d-flex flex-column gap-3 mt-3">
                            <div class="fw-bold fs-5">Order Status</div>
                            <div>
                                <div>Fulfillment status :</div>
                                <form class="d-flex gap-4" action="{{ route('cancel-order', ['id' => $order->id]) }}"
                                    method="POST" id="form-cancel-order">
                                    @csrf
                                    <input type="text"
                                        class="form-control fs-6 fw-semibold 
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
                                        value="{{ $order->status }}" readonly>
                                    @if ($order->status !== 'canceled' && $order->status !== 'shipped')
                                        <input type="hidden" name="cause" id='cause'>
                                        <input type="text" name='status'
                                            class="btn btn-danger fs-6 fw-semibold bg-danger text-white text-center"
                                            value="cancel" style="width: 80px" readonly onclick="return cancelOrder()">
                                    @endif
                                </form>
                            </div>
                            <script>
                                function cancelOrder() {
                                    const reason = prompt("Please enter reason for canceling order:");
                                    if (!reason) {
                                        alert("You must enter a reason to cancel the order!");
                                        return false;
                                    }
                                    document.getElementById('cause').value = reason;
                                    document.getElementById('form-cancel-order').submit();
                                    return false;
                                }
                            </script>
                            <div>
                                <div>Discount :</div>
                                <input type="text" class="form-control fs-6 fw-semibold bg-white"
                                    value="{{ $order->delivery_method }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="p-4">
                        <div class="py-3 d-flex flex-column gap-4">
                            <div class="fw-bold fs-5">Shipping Info</div>
                            <div>
                                <table class="table table-hover ">
                                    <thead>
                                        <tr class="table-light fw-semibold">
                                            <th scope="col">#</th>
                                            <th scope="col">PRODUCTS</th>
                                            <th scope="col">VARIANT</th>
                                            <th scope="col">PRICE</th>
                                            <th scope="col" class="text-center">QUANTITY</th>
                                            <th scope="col">TOTAL</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    @php
                                        $detail = $order->detail;
                                    @endphp
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $product_variant->product->id }}</th>
                                            <td><a class="@if ($product_variant) text-success fw-semibold @else text-danger @endif "
                                                    href="{{ route('product', ['id' => $product_variant->product->id]) }}">
                                                    {{ $detail->name }}
                                                </a>
                                            </td>
                                            <td>{{ $detail->variant }}</td>
                                            <td>{{ $detail->price }}</td>
                                            <td class="text-center">{{ $detail->quantity }}</td>
                                            <td>${{ $detail->quantity * $detail->price }}</td>
                                            <td></td>
                                        </tr>
                                </table>
                            </div>
                            <div
                                class="d-flex justify-content-between fw-semibold fs-6 border border-start-0 border-end-0 py-3">
                                <div>Items subtotal :</div>
                                <div>${{ $order->items_subtotal }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="p-3">
                                        <div class="fs-4 fw-semibold ps-2">Billing details</div>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="d-flex">
                                                <div class="px-2  fw-semibold" style="height: 45px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">
                                                        Customer
                                                    </div>
                                                    <div class="small">
                                                        {{ $user->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="px-2  fw-semibold" style="height: 45px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">
                                                        Email
                                                    </div>
                                                    <div class="small">
                                                        {{ $user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="px-2  fw-semibold" style="height: 45px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                                        <path
                                                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">
                                                        Phone
                                                    </div>
                                                    <div class="small">
                                                        {{ $user->phone_number }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="px-2  fw-semibold" style="height: 45px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">
                                                        Address
                                                    </div>
                                                    <div class="small">
                                                        {{ $user->address }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="p-3">
                                        <div class="fs-4 fw-semibold ps-2">Shipping details</div>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="d-flex">
                                                <div class="px-2  fw-semibold" style="height: 45px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">
                                                        Receiver
                                                    </div>
                                                    <div class="small">
                                                        {{ $order->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="px-2  fw-semibold" style="height: 45px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">
                                                        Email
                                                    </div>
                                                    <div class="small">
                                                        {{ $order->email }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="px-2  fw-semibold" style="height: 45px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                                        <path
                                                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">
                                                        Phone
                                                    </div>
                                                    <div class="small">
                                                        {{ $order->phone }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="px-2  fw-semibold" style="height: 45px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">
                                                        Address line 1
                                                    </div>
                                                    <div class="small">
                                                        {{ $order->address_1 }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="p-3">
                                        <div class="fs-4 fw-semibold ps-2">Other details</div>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="d-flex">
                                                <div class="px-2  fw-semibold" style="height: 45px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">
                                                        Address line 2
                                                    </div>
                                                    <div class="small">
                                                        {{ $order->address_2 }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="px-2  fw-semibold" style="height: 45px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-card-heading"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                                        <path
                                                            d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">
                                                        Voucher
                                                    </div>
                                                    <div class="small text-success">
                                                        {{ $order->discount_code }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
