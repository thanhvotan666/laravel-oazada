<div class="container-fluid" style="margin-top: 100px;">
    <div class="d-flex w-100 justify-content-between">
        <div>Showing 300,000+ products from global suppliers for "{{ request('name') }}"</div>
        <div>
            <button class="btn" onclick="changeProductShow('stack')">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                    class="bi bi-list-task 
                    {{ (is_null(request('product_show')) ? 'text-warning' : request('product_show') == 'stack') ? 'text-warning' : '' }}"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z" />
                    <path
                        d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z" />
                    <path fill-rule="evenodd"
                        d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z" />
                </svg>
            </button>
            <button class="btn" onclick="changeProductShow('grid')">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                    class="bi bi-grid {{ !request('product_show') == 'grid' ?: 'text-warning' }}" viewBox="0 0 16 16">
                    <path
                        d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z" />
                </svg>
            </button>
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-between p-4 gap-3">
        @foreach ($products as $product)
            <div class="d-flex flex-column bg-white p-4 justify-content-between rounded-4"
                style="width: 280px; height: 600px;">
                <div class="d-flex flex-column gap-1">
                    <a href="{{ route('product', ['id' => $product->id]) }}" class="text-center">
                        <img class="rounded-4 " src="{{ asset($product->image) }}" alt="" width="230"
                            height="230"></a>

                    <a href="{{ route('product', ['id' => $product->id]) }}" class="card-content">
                        {{ $product->code . ' - ' . $product->name }}
                    </a>
                    <a href="{{ route('product', ['id' => $product->id]) }}" class="h4">
                        @if ($product->is_variant)
                            ${{ $product->variants->min('price') }} -
                            ${{ $product->variants->max('price') }}
                        @else
                            ${{ $product->variants->min('price') }}
                        @endif
                    </a>
                    <a href="{{ route('product', ['id' => $product->id]) }}">Min. order: 100 pieces</a>
                    <a href="{{ route('product', ['id' => $product->id]) }}">Easy Return</a>
                    <div class="text-truncate">
                        <a href="{{ route('supplier', ['id' => $product->supplier->id]) }}"
                            style="text-decoration: underline;">
                            {{ $product->supplier->name }}
                        </a>
                    </div>
                    <small class="d-flex gap-1 text-secondary">
                        <a href="{{ route('supplier', ['id' => $product->supplier->id]) }}" class="d-flex">
                            <div>
                                @if (now()->diffInYears($product->created_at))
                                    != 0)
                                    {{ now()->diffInYears($product->created_at) }} years ago
                                @elseif (now()->diffInMonths($product->created_at) != 0)
                                    {{ now()->diffInMonths($product->created_at) }} months ago
                                @else
                                    {{ now()->diffInDays($product->created_at) }} days ago
                                @endif
                            </div>
                            <div>
                                <img src="{{ $product->supplier->user->country->image }}"
                                    alt="{{ $product->supplier->user->country->name }}" height="20">
                                {{ $product->supplier->user->country->name }}
                            </div>
                        </a>
                        <a href="{{ route('supplier', ['id' => $product->supplier->id]) }}">
                            <strong>{{ $product->reviews->average('star') }}</strong>/5.0
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path
                                d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659" />
                        </svg>
                    </small>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-outline-dark rounded-pill"
                        href="{{ route('supplier', ['id' => $product->supplier->id]) }}">Add to card</a>
                    {{-- edit --}}
                    <button type="button" class="btn btn-outline-dark rounded-pill"
                        onclick="sendSupplier({{ $product->supplier->user->id }})">Chat now</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
