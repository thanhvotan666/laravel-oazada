<div class="fw-bold"><a href="">{{ $category->name }}</a></div>
<div class="d-flex flex-wrap gap-4">
    @foreach ($products as $product)
        <a href="{{ route('product', ['id' => $product->id]) }}"
            class="d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="70" height="70"
                class="rounded-circle">
            <div>{{ $product->name }}</div>
        </a>
    @endforeach
</div>
