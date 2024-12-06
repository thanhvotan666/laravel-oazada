@extends('layouts.app');

@section('title', $product->name)
@section('content')
    <link rel="stylesheet" href="{{ asset('storage/css/product.css') }}">
    <main>
        @include('include.showAlert')
        <section class="container-fluid d-flex flex-column align-items-center my-5">
            <div class="container-fluid d-flex flex-row-reverse flex-wrap gap-2 justify-content-center">
                <div class="col-lg-4">
                    <div class="w-100 mb-3 bg-wheat p-4">
                        <div class="fw-bold">
                            <oazada>OAZADA</oazada> Guaranteed
                        </div>
                        <div>
                            Fixed prices with shipping included
                            Guaranteed delivery by the scheduled
                            dated Money-back guarantee
                        </div>

                    </div>
                    <div class="border border-3 border-top-0 p-4">
                        <div class="w-100 d-flex justify-content-between">
                            <div>stock: {{ $product->variants->sum('stock') ?? 0 }}</div>
                        </div>
                        <div class="w-100 d-flex fw-bold fs-3 justify-content-between">
                            <div>${{ $product->variants->min('price') }}
                                @if ($product->is_variant)
                                    {{ ' - $' . $product->variants->max('price') }}
                                @endif
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="d-flex flex-column gap-4">
                            <div class="fw-bold">Variations</div>
                            <div class="d-flex justify-content-between">
                                <div class="col-9 text-truncate">
                                    Total options:
                                    @if ($product->is_variant)
                                        {{ $product->variants->count() }} options ->
                                        @php
                                            $types = $product->variants->pluck('options')->flatten()->groupBy('name');
                                        @endphp

                                        @foreach ($types as $key => $options)
                                            {{-- {{ dd($options->groupBy('value')->count()) }} --}}
                                            {{ $options->groupBy('value')->count() }} {{ $key }};
                                        @endforeach
                                    @else
                                        1 option
                                    @endif
                                </div>
                                <div class="col" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
                                    aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                                    <u>
                                        <b>
                                            Select now
                                        </b>
                                    </u>
                                </div>
                            </div>
                            <div>
                                <ol>
                                    @if ($product->is_variant)
                                        @foreach ($types as $type => $options)
                                            <li>
                                                {{ $type }}
                                                ({{ $options->groupBy('value')->count() }})
                                                :
                                                @foreach ($options->groupBy('value') as $value => $valueOption)
                                                    {{ $value }};
                                                @endforeach
                                            </li>
                                            <li class="d-flex gap-4 flex-wrap my-3">
                                                @foreach ($options->groupBy('value') as $value => $valueOption)
                                                    <div class="btn btn-outline-dark variation" data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasDarkNavbar"
                                                        aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                                                        {{ $value }}</div>
                                                @endforeach
                                            </li>
                                        @endforeach
                                    @endif
                                </ol>
                            </div>
                            <div class="d-flex fs-6 justify-content-between">
                                <button class="btn btn-outline-danger rounded-pill px-5 p-2" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
                                    aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-bag-heart" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M14 14V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                    </svg> Favorite
                                </button>
                                <button class="navbar-toggler btn btn-outline-dark border rounded-pill px-5 p-2"
                                    type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
                                    aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                                    Add to cart
                                </button>
                                <button class="btn btn-outline-dark rounded-circle p-2"
                                    onclick="sendSupplier({{ $product->supplier->user->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-wechat" viewBox="0 0 16 16">
                                        <path
                                            d="M11.176 14.429c-2.665 0-4.826-1.8-4.826-4.018 0-2.22 2.159-4.02 4.824-4.02S16 8.191 16 10.411c0 1.21-.65 2.301-1.666 3.036a.32.32 0 0 0-.12.366l.218.81a.6.6 0 0 1 .029.117.166.166 0 0 1-.162.162.2.2 0 0 1-.092-.03l-1.057-.61a.5.5 0 0 0-.256-.074.5.5 0 0 0-.142.021 5.7 5.7 0 0 1-1.576.22M9.064 9.542a.647.647 0 1 0 .557-1 .645.645 0 0 0-.646.647.6.6 0 0 0 .09.353Zm3.232.001a.646.646 0 1 0 .546-1 .645.645 0 0 0-.644.644.63.63 0 0 0 .098.356" />
                                        <path
                                            d="M0 6.826c0 1.455.781 2.765 2.001 3.656a.385.385 0 0 1 .143.439l-.161.6-.1.373a.5.5 0 0 0-.032.14.19.19 0 0 0 .193.193q.06 0 .111-.029l1.268-.733a.6.6 0 0 1 .308-.088q.088 0 .171.025a6.8 6.8 0 0 0 1.625.26 4.5 4.5 0 0 1-.177-1.251c0-2.936 2.785-5.02 5.824-5.02l.15.002C10.587 3.429 8.392 2 5.796 2 2.596 2 0 4.16 0 6.826m4.632-1.555a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0m3.875 0a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0" />
                                    </svg>
                                </button>
                            </div>

                            <div class="offcanvas offcanvas-end w-100" tabindex="-1" id="offcanvasDarkNavbar"
                                aria-labelledby="offcanvasDarkNavbarLabel" style="max-width: 600px;">
                                <div class="offcanvas-header">
                                    <h4 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                                        Select variations and quantity
                                    </h4>
                                    <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body d-flex flex-column gap-4">

                                    <h5 class="offcanvas-title">
                                        Price before shipping
                                    </h5>
                                    <div>
                                        <div>stock: {{ $product->variants->sum('stock') ?? 0 }}</div>
                                        <div class="fw-bold fs-3">
                                            ${{ $product->variants->min('price') }}
                                            @if ($product->is_variant)
                                                {{ ' - $' . $product->variants->max('price') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        Total options:
                                        @if ($product->is_variant)
                                            {{ $product->variants->count() }} options ->
                                            @php
                                                $types = $product->variants
                                                    ->pluck('options')
                                                    ->flatten()
                                                    ->groupBy('name');
                                            @endphp

                                            @foreach ($types as $key => $options)
                                                {{-- {{ dd($options->groupBy('value')->count()) }} --}}
                                                {{ $options->groupBy('value')->count() }} {{ $key }};
                                            @endforeach
                                        @else
                                            1 option
                                        @endif
                                    </div>
                                    <div>
                                        <ol>
                                            @if ($product->is_variant)
                                                @foreach ($types as $name => $options)
                                                    <li>
                                                        {{ $name }}
                                                        ({{ $options->groupBy('value')->count() }})
                                                        :
                                                        @foreach ($options->groupBy('value') as $value => $valueOption)
                                                            {{ $value }};
                                                        @endforeach
                                                    </li>
                                                    <li class="d-flex gap-4 flex-wrap my-3">
                                                        @foreach ($options->groupBy('value') as $value => $valueOption)
                                                            <div class="btn btn-outline-dark variation "
                                                                name='{{ $name }}' value='{{ $value }}'
                                                                onclick='select{{ $name }}(this)'>
                                                                {{ $value }}
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ol>
                                    </div>
                                    <div class="d-flex justify-content-center gap-4">
                                        <button class="btn btn-light border fw-bold" id="minusButton">-</button>
                                        <div class="btn btn-light" id='quantityDisplay'>0</div>
                                        <button class="btn btn-light border fw-bold" id="plusButton">+</button>
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-between pe-5 fw-bold fs-3">
                                        <div>Total:</div>
                                        <div class="d-flex">
                                            $
                                            <div id="total">---</div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-4 flex-wrap justify-content-around">
                                        <form action="{{ route('add-to-favorite') }}" method="post" id='add_to_Favorite'>
                                            @csrf
                                            <input type="hidden" name="product_id" id='form_favorite_product_id'
                                                value="">
                                            <input type="hidden" name="options" id='form_favorite_options' value="">
                                            <button class="btn btn-danger" onclick="add_to_favorite_Submit()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-bag-heart" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M14 14V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                                </svg> Favorite
                                            </button>
                                        </form>
                                        <form action="{{ route('add-to-cart') }}" method="post" id='add_to_cart'>
                                            @csrf
                                            <input type="hidden" name="quantity" id='form_quantity' value="">
                                            <input type="hidden" name="product_id" id='form_product_id' value="">
                                            <input type="hidden" name="options" id='form_options' value="">
                                            <input type="button" value="Add to cart" class="btn btn-orange"
                                                onclick="add_to_cart_Submit()" @disabled($product->variants->sum('stock') == 0)>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="d-flex gap-3">
                                <div>Still deciding? Get samples first!</div>
                                <a href=""><u>Order sample</u></a>
                            </div> --}}
                            <div>
                                <hr>
                            </div>
                            <div>Shipping </div>
                            <div class="btn btn-outline-dark text-start p-3">
                                <div>Standard</div>
                                <div>Shipping total: $612.79 for 500 pieces </div>
                                <div class="text-success">Guaranteed delivery by Aug 29</div>
                            </div>
                            <div class="btn btn-outline-dark text-start p-3">
                                <div>Premium</div>
                                <div>Shipping total: $1,118.82 for 500 pieces </div>
                                <div class="text-success">Guaranteed delivery by Aug 26</div>
                            </div>
                            <div><strong>Protections for <oazada>OAZADA</oazada> Guaranteed</strong>
                            </div>
                            <div class="text-success">Guaranteed delivery via<oazada>OAZADA.com</oazada> Logistics
                            </div>
                            <div>Expect your order to be delivered before scheduled dates or
                                receive a 10% delay compensation</div>
                            <div class="text-success">Secure payments</div>
                            <div>Every payment you make on OAZADA.com is secured with strict
                                SSL encryption and PCI DSS data protection protocols</div>
                            <div class="text-success">Money-back guarantee</div>
                            <div>Get your money back for missing deliveries and defective or
                                damaged products, plus free local returns for defects</div>
                            <div class="text-muted">OAZADA.com protects all your orders placed and paid on the
                                platform with</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 d-flex flex-column gap-3">
                    <div class="fw-bold fs-3" style="width: 80%;">
                        {{ $product->code }} - {{ $product->name }}
                    </div>
                    <a href="{{ route('supplier', ['id' => $product->supplier->id]) }}" class="w-100 bg-grey p-1">
                        <img src="{{ asset($product->supplier->user->avatar) }}" alt="{{ $product->supplier->name }}"
                            height="30">
                        <u>{{ $product->supplier->name }}</u>
                    </a>
                    <div class="d-flex gap-4 justify-content-between" style="height: 600px; ">
                        <div class="col-sm-2 d-flex flex-column justify-content-between">
                            <div class="">
                                <img class="w-75 rounded-4" src="{{ asset($product->image) }}"
                                    alt="{{ $product->name }}" onclick="showImage(this)">
                            </div>
                            @foreach ($product->variants as $variant)
                                @if ($variant->image != '')
                                    <div><img onclick="showImage(this)" class="w-75 rounded-4"
                                            src="{{ asset($variant->image) }}" alt=""></div>
                                @endif
                            @endforeach

                        </div>
                        <div class="col-lg-9 bg-grey d-flex justify-content-center align-items-center">
                            <div class="w-100"><img id="showimage" class="w-100" src="{{ asset($product->image) }}"
                                    alt=""></div>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="container">
                        <!-- Other recommendations for your business -->
                        <div class="d-flex flex-column gap-3 align-items-center">
                            <div class="container d-flex flex-wrap">
                                <div class="h3">Other recommendations for your business</div>
                            </div>
                            <div class="container d-flex flex-row flex-wrap align-content-start gap-4">
                                @foreach ($recommendations as $recommendation)
                                    <div class="col">
                                        <a href="{{ route('product', ['id' => $recommendation->id]) }}"
                                            class="card h-100" style="width: 230px;border: none;">
                                            <img src="{{ asset($recommendation->image) }}" class="card-img-top rounded-4"
                                                alt="{{ $recommendation->name }}">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <oazada>OAZADA</oazada>
                                                    <strong>Guaranteed</strong>
                                                </h5>
                                                <div class="card-text">
                                                    <p class="card-content text-secondary">
                                                        {{ $recommendation->code }} - {{ $recommendation->name }}
                                                    </p>
                                                    <div>
                                                        <strong>
                                                            @if ($recommendation->is_variant)
                                                                ${{ $recommendation->variants->min('price') }} -
                                                                ${{ $recommendation->variants->max('price') }}
                                                            @else
                                                                ${{ $recommendation->variants->min('price') }}
                                                            @endif
                                                        </strong>
                                                    </div>
                                                    <div class="text-secondary">Min. order: 1 price</div>
                                                    <div class="text-secondary">3 sold</div>
                                                    <div class="text-secondary">100+ view</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <!-- Key attributes -->
                        <div class="d-flex flex-column gap-3">
                            <div class="h3">Key attributes</div>
                            <div>Other attributes</div>

                            <div class="container">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach ($product->keyAttributes as $keyAttribute)
                                            <tr>
                                                <th>{{ $keyAttribute->name }}</th>
                                                <td>{{ $keyAttribute->value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <!-- Samples -->
                        {{-- <div class="d-flex flex-column gap-3">
                            <div class="h3">Samples</div>
                            <div>Maximum order quantity: 9 piece</div>
                            <div>Sample price: <strong>$69.00/piece</strong></div>
                            <div>
                                <a class="btn btn-outline-dark my-3" href="">Order sample</a>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div> --}}
                        <!-- Customization -->
                        {{-- <div class="d-flex flex-column gap-3">
                            <div class="h3">Customization</div>
                            <div class="d-flex gap-5">
                                <div>
                                    <div>Customized Logo</div>
                                    <div>Min. order: 50</div>
                                </div>
                                <div>
                                    <div>Customized packaging</div>
                                    <div>Min. order: 1000</div>
                                </div>
                                <div>
                                    <div>Graphic customization</div>
                                    <div>Min. order: 50</div>
                                </div>
                            </div>
                            <div>For more customization details,
                                <a href="" style="text-decoration: underline;">message supplier</a>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div> --}}
                        <!-- Ratings & Reviews -->
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg> --}}
                        <div class="d-flex flex-column gap-3">
                            <div class="h3">Ratings & Reviews</div>
                            <form action="{{ route('product-review') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="star" id="star" value="{{ old('star', 0) }}">
                                <div class="text-end text-warning input-group">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button
                                            class="btn 
                                        @if (old('star', 0) >= $i) active @endif"
                                            type="button" id="star-{{ $i }}"
                                            onclick="changeStar({{ $i }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        </button>
                                    @endfor
                                </div>

                                <div class="input-group">
                                    <textarea class="form-control" name="review" aria-label="With textarea" placeholder="Enter review">{{ old('review', '') }}</textarea>
                                    <button class="input-group-text btn btn-orange" type="submit">Review</button>
                                </div>
                            </form>


                            <div class="d-flex gap-5">
                                <a style="text-decoration: underline" href="?review=product"
                                    class="btn link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover @if (request('review', 'product') == 'product') fw-bold active @endif">
                                    Product reviews</a>
                                <a style="text-decoration: underline" href="?review=store"
                                    class="btn link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover @if (request('review', 'product') == 'store') fw-bold active @endif">
                                    Store reviews</a>
                            </div>
                            <div class="@if (request('review', 'product') != 'product') d-none @endif">
                                <div class="d-flex gap-2">
                                    @if (!$productReviewsAll->isEmpty())
                                        <div class="h4 fw-bold">{{ $productReviewsAll->average('star') }}</div>
                                        <div>/5.0</div>
                                        <div>Star</div>
                                    @else
                                        <div class="h4 fw-bold">No product reviews yet</div>
                                    @endif
                                </div>
                                <div>
                                    @foreach ($productReviews as $review)
                                        <div class="px-5 py-1">
                                            <div class="d-flex gap-3">
                                                @php
                                                    $name =
                                                        substr($review->user->name, 0, 1) .
                                                        '******' .
                                                        substr($review->user->name, -1);
                                                @endphp
                                                <div><img src="{{ asset($review->user->avatar) }}"
                                                        alt="{{ $name }}" width="40" height="40"></div>
                                                <div>
                                                    <div>
                                                        {{ $name }}
                                                    </div>
                                                    <div>
                                                        {{ $review->created_at }}
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2 text-warning">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $review->star)
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-star"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="py-2"> {{ $review->review }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="@if (request('review', 'product') != 'store') d-none @endif">

                                <div class="d-flex gap-2">
                                    @if (!$reviewsAll->isEmpty())
                                        <div class="h4 fw-bold">{{ $reviewsAll->average('star') }}</div>
                                        <div>/5.0</div>
                                        <div>Star</div>
                                    @else
                                        <div class="h4 fw-bold">No product reviews yet</div>
                                    @endif
                                </div>
                                <div>
                                    @foreach ($reviews as $review)
                                        <div class="px-5 py-1">
                                            <div class="d-flex gap-3">
                                                @php
                                                    $name =
                                                        substr($review->user->name, 0, 1) .
                                                        '******' .
                                                        substr($review->user->name, -1);
                                                @endphp
                                                <div><img src="{{ asset($review->user->avatar) }}"
                                                        alt="{{ $name }}" width="40" height="40"></div>
                                                <div>
                                                    <div>
                                                        {{ $name }}
                                                    </div>
                                                    <div>
                                                        {{ $review->created_at }}
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2 text-warning">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $review->star)
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-star"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="py-2"> {{ $review->review }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="">
                                {{ $reviews->appends(['review' => request('review')])->links() }}
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <!-- Know your supplier -->
                        <div class="d-flex flex-column gap-3 bg-grey p-3">
                            <div>
                                <a href="{{ route('supplier', ['id' => $product->supplier->id]) }}"
                                    style="text-decoration: underline;">{{ $product->supplier->name }}</a>
                            </div>
                            <div class="d-flex gap-5 justify-content-center">
                                <div>
                                    <div>Response Time</div>
                                    <div class="fw-bold">≤2h</div>
                                </div>
                                <div>
                                    <div>On-time delivery rate</div>
                                    <div class="fw-bold">100.0%</div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                                <a href="{{ route('search.index', ['supplier_id' => $product->supplier->id]) }}"
                                    class="rounded-pill p-1 px-5 mx-5 btn btn-orange">View more products</a>
                                <a href="{{ route('supplier', ['id' => $product->supplier->id]) }}"
                                    class="rounded-pill p-1 px-5 mx-5 btn btn-outline-dark">View
                                    profile</a>
                            </div>

                        </div>
                        <div>
                            <hr>
                        </div>
                        <!-- Product descriptions from the supplier -->
                        <div>
                            <div class="h3">Product descriptions from the supplier</div>
                            <div>{!! $product->description !!}</div>
                        </div>
                    </div>

                </div>

            </div>
            <hr>
        </section>

        <!-- Frequently bought together - limit 5 -->
        <section class="container-fluid d-flex flex-column align-items-center my-5">

            <div class="container d-flex flex-wrap gap-3 justify-content-between py-3">
                <div class="h3">Frequently bought together </div>
            </div>
            <div class="container d-flex flex-row flex-wrap align-content-start gap-4">

                @foreach ($supplierProducts as $supplierProduct)
                    <div class="col">
                        <a href="{{ route('product', ['id' => $supplierProduct->id]) }}" class="card h-100"
                            style="width: 230px;border: none;">
                            <img src="{{ asset($supplierProduct->image) }}" class="card-img-top rounded-4"
                                alt="{{ $supplierProduct->name }}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <oazada>OAZADA</oazada>
                                    <strong>Guaranteed</strong>
                                </h5>
                                <div class="card-text">
                                    <p class="card-content text-secondary">
                                        {{ $supplierProduct->code }} - {{ $supplierProduct->name }}
                                    </p>
                                    <div>
                                        <strong>
                                            @if ($supplierProduct->is_variant)
                                                ${{ $supplierProduct->variants->min('price') }} -
                                                ${{ $supplierProduct->variants->max('price') }}
                                            @else
                                                ${{ $supplierProduct->variants->min('price') }}
                                            @endif
                                        </strong>
                                    </div>
                                    <div class="text-secondary">Min. order: 1 price</div>
                                    <div class="text-secondary">3 sold</div>
                                    <div class="text-secondary">100+ view</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="container">
                <hr>
            </div>
        </section>
        <!-- products - limit 20 -->
        <section class="container-fluid d-flex flex-column align-items-center my-5">
            <div class="container d-flex flex-wrap gap-3 justify-content-between py-3">
                <div class="h3">Popular products </div>
            </div>
            <div class="container d-flex flex-row flex-wrap align-content-start gap-4">
                @foreach ($popularProducts as $popularProduct)
                    <div class="col">
                        <a href="{{ route('product', ['id' => $popularProduct->id]) }}" class="card h-100"
                            style="width: 230px;border: none;">
                            <img src="{{ asset($popularProduct->image) }}" class="card-img-top rounded-4"
                                alt="{{ $popularProduct->name }}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <oazada>OAZADA</oazada>
                                    <strong>Guaranteed</strong>
                                </h5>
                                <div class="card-text">
                                    <p class="card-content text-secondary">
                                        {{ $popularProduct->code }} - {{ $popularProduct->name }}
                                    </p>
                                    <div><strong>
                                            @if ($popularProduct->is_variant)
                                                ${{ $popularProduct->variants->min('price') }} -
                                                ${{ $popularProduct->variants->max('price') }}
                                            @else
                                                ${{ $popularProduct->variants->min('price') }}
                                            @endif
                                        </strong></div>
                                    <div class="text-secondary">Min. order: 1 price</div>
                                    {{-- <div class="text-secondary">3 sold</div> --}}
                                    {{-- edit --}}
                                    <div class="text-secondary">100+ view</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="container">
                <hr>
            </div>
        </section>
        <!-- url -->
        <section class="container-fluid d-flex flex-column align-items-center my-5 bg-grey">
            <div class="p-5">
                {{-- edit --}}
                <a href="">Home</a>
                <a href=""> > {{ $product->supplier->name }}</a>
                <a href=""> > {{ $product->category->categoryType->name }}</a>
                <a href=""> > {{ $product->category->name }}</a>
                <a href=""> > {{ $product->name }}</a>
            </div>

        </section>

        <script>
            function showImage(element) {
                document.getElementById('showimage').src = element.src;
            }
            const quantityDisplay = document.getElementById('quantityDisplay');
            let quantity = 0;
            document.addEventListener('DOMContentLoaded', function() {
                const minusButton = document.getElementById('minusButton');
                const plusButton = document.getElementById('plusButton');
                minusButton.addEventListener('click', function() {
                    if (quantity >= 1) {
                        quantity--;
                        quantityDisplay.textContent = quantity;
                    }
                });

                plusButton.addEventListener('click', function() {
                    quantity++;
                    quantityDisplay.textContent = quantity;
                });
            });

            let selectedOptions = {};
            @if ($product->is_variant)

                const priceOptions = @json(
                    $product->variants->map(function ($variant) {
                        return [
                            'select' => $variant->options->mapWithKeys(function ($option) {
                                return [$option->name => $option->value];
                            }),
                            'price' => $variant->price,
                        ];
                    }));

                console.log(priceOptions);
                @foreach ($types as $name => $options)
                    const select{{ $name }} = (element) => {
                        selectedOptions['{{ $name }}'] = element.innerText;
                        const elementTypes{{ $name }} = document.getElementsByName('{{ $name }}');
                        elementTypes{{ $name }}.forEach(el => el.classList.remove('active'));
                        element.classList.add('active');
                        quantity = 0;
                        quantityDisplay.textContent = quantity;
                        const total = document.getElementById('total');
                        total.innerHTML = "---";
                        priceOptions.forEach((priceOption) => {
                            if (JSON.stringify(priceOption.select) === JSON.stringify(selectedOptions)) {
                                total.innerHTML = priceOption.price;
                                return;
                            }
                        });
                    };
                @endforeach
            @endif


            const add_to_cart_Submit = () => {
                const form_quantity = document.getElementById('form_quantity');
                const form_product_id = document.getElementById('form_product_id');
                const form_options = document.getElementById('form_options');

                form_quantity.value = quantity;
                form_product_id.value = {{ $product->id }};
                form_options.value = Object.entries(selectedOptions)
                    .map(([key, value]) => `${value}`)
                    .join(',');
                document.getElementById('add_to_cart').submit();
            };
            const add_to_favorite_Submit = () => {
                const form_product_id = document.getElementById('form_favorite_product_id');
                const form_options = document.getElementById('form_favorite_options');

                form_product_id.value = {{ $product->id }};
                form_options.value = Object.entries(selectedOptions)
                    .map(([key, value]) => `${value}`)
                    .join(',');
                document.getElementById('add_to_favorite').submit();
            };
        </script>
        <script>
            function changeStar(star) {
                for (let i = 1; i <= 5; i++) {
                    document.getElementById(`star-${i}`).classList.remove('active');
                }
                for (let i = 1; i <= star; i++) {
                    document.getElementById(`star-${i}`).classList.add('active');
                }
                document.getElementById(`star`).value = star;
            }
        </script>
    </main>
@endsection
