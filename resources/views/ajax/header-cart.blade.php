@foreach ($carts as $cart)
    <a href="{{ route('product', ['id' => $cart->productVariant->product->id]) }}"
        class="d-flex gap-4 py-3 align-items-center">
        <div class="col-sm-3">
            <img src="{{ asset($cart->productVariant->product->image) }}" alt="{{ $cart->productVariant->product->name }}"
                width="50" height="50">
        </div>
        <div class="col-sm-7 text-truncate">
            {{ $cart->productVariant->product->name }}
        </div>
        <div class="col-sm-2">
            x{{ $cart->quantity }}
        </div>
    </a>
@endforeach
