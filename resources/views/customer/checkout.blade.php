@extends('layouts.app')

@section('title', 'Checkout')
@section('content')
    @php
        $itemSuptotal = 0;
    @endphp
    <main class="container-fluid p-0 bg-grey">
        <div class="container ">
            <div class="p-4 fw-bold fs-2">Check out</div>
            @include('include.showAlert')
            <form class="row flex-row-reverse" method="post" action="{{ route('check-order') }}">
                @csrf
                <div class="col-xl-4">
                    <div class="p-4">
                        <div class="border rounded-4 bg-white p-3 d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center">
                                <div class="fw-bold fs-5">Summary</div>
                                <div>
                                    <!-- route cart -->
                                    <a class="link-info link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
                                        href="{{ route('cart') }}" style="text-decoration: underline;">
                                        Edit cart
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-2 ps-3">
                                <!-- carts -->
                                @php
                                    $itemsSubtotal = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    @php
                                        $itemTotal = $cart->quantity * $cart->productVariant->price;
                                        $itemsSubtotal += $itemTotal;
                                    @endphp
                                    <div class="d-flex justify-content-between gap-2 align-items-center fw-semibold">
                                        <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                        <div class="" style="width: 30;height: 30;">
                                            <img src="{{ $cart->productVariant->product->image }}"
                                                alt="{{ $cart->productVariant->product->name }}" width="30"
                                                height="30">
                                        </div>
                                        <div class="card-content text-truncate flex-grow-1 " style="font-size: 10px;">
                                            {{ $cart->productVariant->product->code }} -
                                            {{ $cart->productVariant->product->name }}
                                        </div>
                                        <div class="text-muted" style="font-size: 11px;">x{{ $cart->quantity }}</div>
                                        <div class="fs-6">${{ $itemTotal }}</div>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <div>Items subtotal :</div>
                                <div class="fs-6  fw-semibold">${{ $itemsSubtotal }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Discount :</div>
                                @php
                                    $discountValue =
                                        $discount->type == 'direct'
                                            ? $discount->value
                                            : ($discount->value / 100) * $itemsSubtotal;
                                    //dd($discount);
                                @endphp
                                <div class="fs-6  fw-semibold  text-danger">-${{ $discountValue }}</div>
                            </div>
                            <div class="d-flex justify-content-between ">
                                <div>Subtotal :</div>
                                @php
                                    $subtotal = $itemsSubtotal - $discountValue;
                                @endphp
                                <div class="fs-6  fw-semibold {{ $discount->value == 0 ?: 'text-success' }}">
                                    ${{ $subtotal }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Shipping Cost :</div>
                                @php
                                    $shippingCost = 0;
                                @endphp
                                <div class="fs-6  fw-semibold">${{ $shippingCost }}</div>
                            </div>
                            <div class="d-flex  fw-semibold justify-content-between" style="font-size: 11px;">
                                <div>Voucher code :</div>
                                <div class="text-success">{{ $discount->code }}</div>
                            </div>

                            <hr>

                            <div class="d-flex fw-semibold justify-content-between fs-3">
                                <div>Total :</div>
                                @php
                                    $total = $subtotal + $shippingCost;
                                @endphp
                                <div class="{{ $discount->value == 0 ?: 'text-success' }}">${{ $total }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="p-4">
                        <div class="py-3 d-flex flex-column gap-4">
                            <div class="fw-bold fs-5">Shipping Info</div>
                            <div>
                                <label for="name" class="form-label fw-bold">
                                    Full name
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" class="form-control" id="name" name='name'
                                    value="{{ $user->name }}" required>
                            </div>
                            <div class="d-flex gap-4">
                                <div class="w-100">
                                    <label for="email" class="form-label fw-bold">
                                        Email
                                        <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $user->email }}" required>
                                </div>
                                <div class="w-100">
                                    <label for="phone" class="form-label fw-bold">
                                        Phone
                                        <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ $user->phone_number }}" required>
                                </div>
                            </div>
                            <div>
                                <label for="address_1" class="form-label fw-bold">
                                    Address line 1
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" class="form-control" id="address_1" name="address_1"
                                    value="{{ $user->address }}" required>
                            </div>
                            <div>
                                <label for="address_2" class="form-label fw-bold">
                                    Address line 2
                                </label>
                                <input type="text" class="form-control" id="address_2" name="address_2">
                            </div>
                            <div class="d-flex gap-4">
                                <div class="w-100">
                                    <label for="country" class="form-label fw-bold">
                                        Country
                                        <sup class="text-danger">*</sup>
                                    </label>
                                    <select id="country" class="select-control form-control" name="country_id" required>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @selected($user->country_id == $country->id)>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-100">
                                </div>
                                <div class="w-100">
                                </div>
                            </div>
                            <div class="d-flex gap-4">
                                <input type="hidden" name="items_subtotal" value="{{ $itemsSubtotal }}">
                                <input type="hidden" name="discount_code" value="{{ $discount->code }}">
                                <input type="hidden" name="discount_type" value="{{ $discount->type }}">
                                <input type="hidden" name="discount_value" value="{{ $discount->value }}">
                                <input type="hidden" name="shipping_cost" value="{{ $shippingCost }}">
                                <input type="hidden" name="total" value="{{ $total }}">
                                <input type="submit" class="btn btn-orange form-control" value="ORDER!!!">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
