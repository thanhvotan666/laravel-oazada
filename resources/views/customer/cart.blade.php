@extends('layouts.app')

@section('title',  request()->getHost() .': Carts')
@section('content')
    <main class="container-fluid bg-grey">
        <div class="container">
            <div class="h1 px-4">Cart</div>
            @include('include.showAlert')
            <div class="row">
                <div class="col-xl-8">
                    <div class="p-4">
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-warning">
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">PRODUCTS</th>
                                    <th scope="col">VARIANT</th>
                                    <th scope="col">PRICE</th>
                                    <th scope="col">STOCK</th>
                                    <th scope="col" class="text-center">QUANTITY</th>
                                    <th scope="col">TOTAL</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            @php
                                $itemSubtotal = 0;
                            @endphp
                            <tbody>
                                @foreach ($carts as $cart)
                                    @php
                                        $itemSubtotal += $cart->productVariant->price * $cart->quantity;
                                    @endphp

                                    <tr class="small">
                                        <th class="text-center" scope="row">
                                            <input class="form-check-input" type="radio" name="cart_id"
                                                id="radio-{{ $cart->id }}" value="{{ $cart->id }}"
                                                @checked($cart->id === $cartSelect->id) onchange="onClickRadioSelect(this)">
                                        </th>
                                        <th class="text-secondary">
                                            <img src="{{ asset($cart->productVariant->image ?? 'storage/image/product/Product.jpg') }}"
                                                alt="{{ $cart->productVariant->product->name }}" width="40"
                                                height="40">
                                        </th>
                                        <td style="max-width:300px;">
                                            <a href="{{ route('product', ['id' => $cart->productVariant->product_id]) }}"
                                                class="card-content link-info link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
                                                style="font-size: 11px">
                                                {{ $cart->productVariant->product->code }} -
                                                {{ $cart->productVariant->product->name }}
                                            </a>
                                        </td>
                                        <td class="#">
                                            {{ $cart->productVariant->options->pluck('value')->join(', ') }}
                                        </td>
                                        <td>${{ $cart->productVariant->price }}</td>
                                        <td>{{ $cart->productVariant->stock }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                {{-- <form action=""></form> --}}
                                                <form action="{{ route('change-quantity-cart', ['id' => $cart->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input class="form-control" style="width: 100px;" type="number"
                                                        name="quantity" value="{{ $cart->quantity }}"
                                                        onchange="this.form.submit()" min="0">
                                                </form>
                                            </div>
                                        </td>

                                        <td class="" name='totalPerVariant' id='total-{{ $cart->id }}'>
                                            ${{ $cart->productVariant->price * $cart->quantity }} </td>
                                        <td class="">
                                            <form action="{{ route('remove-out-cart', ['id' => $cart->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn text-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="6"><strong>Items subtotal :</strong></td>
                                    <td colspan="2"><strong>${{ $itemSubtotal }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="p-3">
                        <div class="border rounded-4 p-4 bg-white">
                            <div class="py-3">
                                <h3>Summary</h3>
                            </div>
                            @if (session('error_code'))
                                <div class="alert alert-danger">
                                    {{ session('error_code') }}
                                </div>
                            @endif
                            <div class="py-3">
                                <select name="" id="" class="text-muted form-select">
                                    <option value="" selected>Cash on Delivery</option>
                                </select>
                            </div>
                            @php
                                $selectItemsSub = is_null($cartSelect->id)
                                    ? 0
                                    : $cartSelect->productVariant->price * $cartSelect->quantity;
                            @endphp
                            <div class="py-3 d-flex justify-content-between">
                                <div>Selected Items subtotal :</div>
                                <div>${{ $selectItemsSub }}</div>
                            </div>
                            @php
                                $discount_value =
                                    $discount->type == 'direct'
                                        ? $discount->value
                                        : ($discount->value / 100) * $selectItemsSub;
                            @endphp
                            <div class="py-3 d-flex justify-content-between">
                                <div>Discount :</div>
                                <div class="text-danger">
                                    -${{ $discount_value }}
                                </div>
                            </div>

                            <form action="{{ route('cart') }}" class="py-3 input-group mb-3" method="GET">
                                <input type="text" class="form-control" placeholder="Voucher" name='discount_code'
                                    value="{{ request('discount_code') }}">
                                @if ($cartSelect->id)
                                    <input type="hidden" name="cart_id" value="{{ $cartSelect->id }}">
                                @endif
                                <button class="btn btn-outline-secondary text-info border-1" type="submit"
                                    id="button-addon2">Apply</button>
                            </form>
                            @php
                                $total = $selectItemsSub - $discount_value < 0 ? 0 : $selectItemsSub - $discount_value;
                            @endphp
                            <div class="py-3 d-flex justify-content-between border-top border-bottom">
                                <div class="fw-bold">Total :</div>
                                <div class="{{ !is_null(request('discount-code')) ?: 'text-success' }} fw-bold">
                                    ${{ $total }}
                                </div>
                            </div>

                            <div class="pt-3 input-group mb-3">
                                <form action="{{ route('checkout') }}" method="GET">
                                    @if ($discount->code != '')
                                        <input type="hidden" name="discount_code" value="{{ $discount->code }}">
                                    @endif
                                    <input type="hidden" name="cart_id" value="{{ $cartSelect->id }}">
                                    <button class="btn btn-primary w-100" type="submit">
                                        Proceed to check out
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <form action="{{ route('cart') }}" id="form-select-cart">
        @if ($discount->code != '')
            <input type="hidden" name="discount_code" value="{{ $discount->code }}">
        @endif
        <input type="hidden" name="cart_id" id="cart_id" value="{{ $cartSelect->id }}">
    </form>
    <script>
        function onClickRadioSelect(e) {
            e.checked = true;
            document.getElementById('cart_id').value = e.value;
            document.getElementById('form-select-cart').submit();
        }
    </script>
@endsection
