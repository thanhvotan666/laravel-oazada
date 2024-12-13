<div class="container-fluid d-flex flex-column" style="margin-top: 100px;">
    <div class="d-flex w-100 justify-content-between border ps-5"
        style="background-color: rgba(128, 255, 0, 0.3);border-color: chartreuse">
        <div class="d-flex flex-column justify-content-between  py-4" style="width: 250px ">
            <div>
                <img src="{{ asset($randomSupplier->user->avatar) }}" alt="{{ $randomSupplier->name }}" height="30">
                - {{ $randomSupplier->name }}
            </div>

            <div class="d-flex gap-2">
                <div>Ratings & Reviews: </div>
                <div>{{ $allReviews->average('star') }}</div>
                <div>
                    /5
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                        <path
                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto d-flex gap-3 w-100 justify-content-end px-3">
            @foreach ($randomSupplier->products->take(6) as $product)
                <div>
                    <div>
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="100"
                            height="100">
                    </div>
                    <div class="fw-bold">
                        @if ($product->is_variant)
                            ${{ $product->variants->min('price') }} -
                            ${{ $product->variants->max('price') }}
                        @else
                            ${{ $product->variants->min('price') }}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex w-100 justify-content-between">
        <div>Showing 100,000+ products from global suppliers for "{{ request('name') }}"</div>

        <div>
            <button class="btn" type="buttom" onclick="changeProductShow('stack')">
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
            <button class="btn" type="buttom" onclick="changeProductShow('grid')">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                    class="bi bi-grid {{ request('product_show') != 'gird' ?: 'text-warning' }}" viewBox="0 0 16 16">
                    <path
                        d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z" />
                </svg>
            </button>
        </div>
    </div>
    <div class="bg-white my-3 d-flex flex-column gap-3">
        @foreach ($products as $product)
            <div class="d-flex justify-content-between p-3 gap-3">
                <div class="d-flex gap-4">
                    <div>
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="240"
                            height="240" class="rounded-4">
                    </div>
                    <div class="d-flex flex-column gap-1">
                        <a href="{{ route('product', ['id' => $product->id]) }}"
                            class="card-content">{{ $product->code }} - {{ $product->name }}</a>
                        <a href="{{ route('product', ['id' => $product->id]) }}" class="h3">
                            @if ($product->is_variant)
                                ${{ $product->variants->min('price') }} -
                                ${{ $product->variants->max('price') }}
                            @else
                                ${{ $product->variants->min('price') }}
                            @endif
                        </a>
                        <a href="{{ route('product', ['id' => $product->id]) }}">Min. order: 1</a>
                        <a href="{{ route('product', ['id' => $product->id]) }}">Easy Return</a>
                        <a href="{{ route('supplier', ['id' => $product->supplier->id]) }}">
                            {{ $product->supplier->name }}
                        </a>
                        <div class="d-flex gap-4">
                            <a href="{{ route('supplier', ['id' => $product->supplier->id]) }}"
                                class="d-flex flex-wrap">
                                <div>
                                    <img src="{{ asset($product->supplier->user->country->image) }}" alt=""
                                        height="20">
                                    {{ $product->supplier->user->country->name }}
                                </div>
                            </a>
                            <a href="{{ route('product', ['id' => $product->id]) }}">
                                <strong>{{ $product->reviews->average('star') }}</strong>
                                /5.0
                                ({{ $product->reviews->count() }} reviews)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                                    <path
                                        d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column gap-4">
                    <div>
                        <a href="{{ route('product', ['id' => $product->id]) }}">
                            <input class="add-to-card btn btn-outline-dark rounded-pill px-5" type="button"
                                value="Add to cart">
                        </a>
                    </div>
                    <!--edit-->
                    <div>
                        <input class="chat-now btn btn-outline-dark rounded-pill w-100" type="button" value="Chat now"
                            onclick="sendSupplier({{ $product->supplier->user->id }})">
                    </div>
                    <div>
                        <a href="{{ route('product', ['id' => $product->id]) }}"
                            class=" btn btn-outline-danger rounded-pill w-100" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag-heart" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M14 14V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                            </svg>
                            Favorite
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
