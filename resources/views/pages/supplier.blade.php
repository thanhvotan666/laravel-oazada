@extends('layouts.app')

@section('title',  request()->getHost() ." - ".$supplier->name)
@section('content')
    <main class="container-fluid p-0 bg-grey">

        @include('pages.include.head')

        <div class="container-fluid mt-5">
            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators (optional) -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="3"></button>
                </div>

                <!-- Carousel items -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/image/banner/banner1.jpg') }}" class="d-block"
                            alt="Minimalist Furniture Banner" style="width: 100%; height: 100%;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('storage/image/banner/banner2.jpg') }}" class="d-block"
                            alt="Minimalist Furniture Banner" style="width: 100%; height: 100%;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('storage/image/banner/banner3.png') }}" class="d-block"
                            alt="Minimalist Furniture Banner" style="width: 100%; height: 100%;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('storage/image/banner/banner4.jpg') }}" class="d-block"
                            alt="Minimalist Furniture Banner" style="width: 100%; height: 100%;">
                    </div>
                </div>

                <!-- Controls (optional) -->
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="container mt-5 bg-white border rounded-5 overflow-hidden p-0">
            <div class="d-flex justify-content-between">
                <div style="position: relative;">
                    <img src="{{ asset($supplier->user->country->image) }}" alt="" width="400" height="320">
                    <div style="position: absolute;top:45%;font-size: xx-large;padding-left: 30px;font-weight: bolder">New
                        Trending
                        Products
                    </div>
                </div>
                <!-- limit: 2 -->
                <div class="d-flex w-100 h-100 justify-content-around">
                    @foreach ($newTrendingProducts as $product)
                        <div class="p-2">
                            <a href="{{ route('product', ['id' => $product->id]) }}" style="width: 200px;">
                                <div>
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="200"
                                        height="150">
                                </div>
                                <div class="card-content" style="width: 200px;">
                                    {{ $product->code . ' - ' . $product->name }}
                                </div>
                                <br>
                                <div>
                                    <strong>
                                        @if ($product->is_variant)
                                            ${{ $product->variants->min('price') }} -
                                            ${{ $product->variants->max('price') }}
                                        @else
                                            ${{ $product->variants->min('price') }}
                                        @endif
                                    </strong>
                                </div>
                                <div>Shipping to be negotiated </div>
                                <div>Min. Order: 1 piece</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container-fluid mt-5">
            <div style="position: relative;">
                <div class="container-fluid bg-dark text-white p-5 rounded-5" style="position: absolute;top: 0;left:0">
                    <div class="d-flex justify-content-between pb-5 fw-bold ">
                        <div class="h3">Top picks</div>
                        <div class="h3"><a href="#" class="text-white">View more</a></div>
                    </div>
                </div>
                <div class="container mt-5">
                    <!-- limit: 10 -->
                    <div class="row row-cols-1 row-cols-xl-5 g-4 mx-2" style="padding-top: 80px;">
                        @foreach ($topPicks as $product)
                            <div class="col">
                                <div class="p-2">
                                    <a href="{{ route('product', ['id' => $product->id]) }}" class="card h-100">
                                        <img src="{{ asset($product->image) }}"
                                            alt="{{ $product->name }}"class="card-img-top">
                                        <div class="card-body">
                                            <div class="card-text">
                                                <p class="card-content text-secondary">
                                                    {{ $product->code . ' - ' . $product->name }}
                                                </p>
                                                <div>
                                                    <strong>
                                                        @if ($product->is_variant)
                                                            ${{ $product->variants->min('price') }} -
                                                            ${{ $product->variants->max('price') }}
                                                        @else
                                                            ${{ $product->variants->min('price') }}
                                                        @endif
                                                    </strong>
                                                </div>
                                                <div class="text-secondary">Min. order: 1 piece</div>
                                                <div class="text-secondary">Easy Return</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="container mt-5">
                <!-- limit: 12 - random -->
                <div class="row row-cols-1 row-cols-xl-4 g-4 mx-2">
                    @foreach ($newProducts as $product)
                        <div class="col">
                            <div class="p-2">
                                <a href="{{ route('product', ['id' => $product->id]) }}" class="card h-100">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                        class="card-img-top">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p class="card-content text-secondary">
                                                {{ $product->code . ' - ' . $product->name }}
                                            </p>
                                            <div>
                                                <strong>
                                                    @if ($product->is_variant)
                                                        ${{ $product->variants->min('price') }} -
                                                        ${{ $product->variants->max('price') }}
                                                    @else
                                                        ${{ $product->variants->min('price') }}
                                                    @endif
                                                </strong>
                                            </div>
                                            <div class="text-secondary">Min. order: 1 piece</div>
                                            <div class="text-secondary">Easy Return</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container mt-5 text-center">
            <h3>COMPANY INTRODUCTION</h3>
            <div>
                <hr>
            </div>
            <div class=" d-flex gap-3 justify-content-center">
                <h5>Verification Type:</h5>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-house" viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg>
                <b><u>Onsite Check</u></b>
            </div>

            <div class="row row-cols-1 row-cols-xl-3 my-4">
                <div class="col">
                    <div class="d-flex gap-4 text-start">
                        <div class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-geo-alt" viewBox="0 0 16 16">
                                <path
                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                        </div>
                        <div class="text-warning fs-6">
                            <div><u>Country / Region:</u></div>
                            <div>{{ $supplier->address }}</div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex gap-4 text-start">
                        <div class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-clock-history" viewBox="0 0 16 16">
                                <path
                                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
                                <path
                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
                            </svg>
                        </div>
                        <div class="text-warning fs-6">
                            <div><u>Year Established:</u></div>
                            <div>{{ $supplier->created_at->format('Y') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex gap-4 text-start">
                        <div class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-person-vcard" viewBox="0 0 16 16">
                                <path
                                    d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                <path
                                    d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
                            </svg>
                        </div>
                        <div class="text-warning fs-6">
                            <div><u>Business Type:</u></div>
                            {{-- edit --}}
                            <div>Trading Company</div>
                        </div>
                    </div>
                </div>
                <div class="col mt-5">
                    <div class="d-flex gap-4 text-start">
                        <div class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-dropbox" viewBox="0 0 16 16">
                                <path
                                    d="M8.01 4.555 4.005 7.11 8.01 9.665 4.005 12.22 0 9.651l4.005-2.555L0 4.555 4.005 2zm-4.026 8.487 4.006-2.555 4.005 2.555-4.005 2.555zm4.026-3.39 4.005-2.556L8.01 4.555 11.995 2 16 4.555 11.995 7.11 16 9.665l-4.005 2.555z" />
                            </svg>
                        </div>
                        <div class="fs-6">
                            <div><u>Main Products:</u></div>
                            <div>{{ $categorySupplier->take(2)->pluck('name')->join(', ') . ', ...' }}</div>
                        </div>
                    </div>
                </div>
                <div class="col mt-5">
                    <div class="d-flex gap-4 text-start">
                        <div class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-credit-card" viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                            </svg>
                        </div>
                        <div class="fs-6">
                            <div><u>Accepted payment methods:</u></div>
                            <div>T/T, L/C, MoneyGram, Credit Card</div>
                        </div>
                    </div>
                </div>
                <div class="col mt-5">
                    <div class="d-flex gap-4 text-start">
                        <div class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-puzzle" viewBox="0 0 16 16">
                                <path
                                    d="M3.112 3.645A1.5 1.5 0 0 1 4.605 2H7a.5.5 0 0 1 .5.5v.382c0 .696-.497 1.182-.872 1.469a.5.5 0 0 0-.115.118l-.012.025L6.5 4.5v.003l.003.01q.005.015.036.053a.9.9 0 0 0 .27.194C7.09 4.9 7.51 5 8 5c.492 0 .912-.1 1.19-.24a.9.9 0 0 0 .271-.194.2.2 0 0 0 .039-.063v-.009l-.012-.025a.5.5 0 0 0-.115-.118c-.375-.287-.872-.773-.872-1.469V2.5A.5.5 0 0 1 9 2h2.395a1.5 1.5 0 0 1 1.493 1.645L12.645 6.5h.237c.195 0 .42-.147.675-.48.21-.274.528-.52.943-.52.568 0 .947.447 1.154.862C15.877 6.807 16 7.387 16 8s-.123 1.193-.346 1.638c-.207.415-.586.862-1.154.862-.415 0-.733-.246-.943-.52-.255-.333-.48-.48-.675-.48h-.237l.243 2.855A1.5 1.5 0 0 1 11.395 14H9a.5.5 0 0 1-.5-.5v-.382c0-.696.497-1.182.872-1.469a.5.5 0 0 0 .115-.118l.012-.025.001-.006v-.003a.2.2 0 0 0-.039-.064.9.9 0 0 0-.27-.193C8.91 11.1 8.49 11 8 11s-.912.1-1.19.24a.9.9 0 0 0-.271.194.2.2 0 0 0-.039.063v.003l.001.006.012.025c.016.027.05.068.115.118.375.287.872.773.872 1.469v.382a.5.5 0 0 1-.5.5H4.605a1.5 1.5 0 0 1-1.493-1.645L3.356 9.5h-.238c-.195 0-.42.147-.675.48-.21.274-.528.52-.943.52-.568 0-.947-.447-1.154-.862C.123 9.193 0 8.613 0 8s.123-1.193.346-1.638C.553 5.947.932 5.5 1.5 5.5c.415 0 .733.246.943.52.255.333.48.48.675.48h.238zM4.605 3a.5.5 0 0 0-.498.55l.001.007.29 3.4A.5.5 0 0 1 3.9 7.5h-.782c-.696 0-1.182-.497-1.469-.872a.5.5 0 0 0-.118-.115l-.025-.012L1.5 6.5h-.003a.2.2 0 0 0-.064.039.9.9 0 0 0-.193.27C1.1 7.09 1 7.51 1 8s.1.912.24 1.19c.07.14.14.225.194.271a.2.2 0 0 0 .063.039H1.5l.006-.001.025-.012a.5.5 0 0 0 .118-.115c.287-.375.773-.872 1.469-.872H3.9a.5.5 0 0 1 .498.542l-.29 3.408a.5.5 0 0 0 .497.55h1.878c-.048-.166-.195-.352-.463-.557-.274-.21-.52-.528-.52-.943 0-.568.447-.947.862-1.154C6.807 10.123 7.387 10 8 10s1.193.123 1.638.346c.415.207.862.586.862 1.154 0 .415-.246.733-.52.943-.268.205-.415.39-.463.557h1.878a.5.5 0 0 0 .498-.55l-.001-.007-.29-3.4A.5.5 0 0 1 12.1 8.5h.782c.696 0 1.182.497 1.469.872.05.065.091.099.118.115l.025.012.006.001h.003a.2.2 0 0 0 .064-.039.9.9 0 0 0 .193-.27c.14-.28.24-.7.24-1.191s-.1-.912-.24-1.19a.9.9 0 0 0-.194-.271.2.2 0 0 0-.063-.039H14.5l-.006.001-.025.012a.5.5 0 0 0-.118.115c-.287.375-.773.872-1.469.872H12.1a.5.5 0 0 1-.498-.543l.29-3.407a.5.5 0 0 0-.497-.55H9.517c.048.166.195.352.463.557.274.21.52.528.52.943 0 .568-.447.947-.862 1.154C9.193 5.877 8.613 6 8 6s-1.193-.123-1.638-.346C5.947 5.447 5.5 5.068 5.5 4.5c0-.415.246-.733.52-.943.268-.205.415-.39.463-.557z" />
                            </svg>
                        </div>
                        <div class="fs-6">
                            <div><u>Main Markets:</u></div>
                            <div>South Asia, Southern Europe, Northern...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="text-center">
                <a href="{{ route('supplier-contacts', ['id' => $supplier->id]) }}"
                    class="px-5 rounded-pill fs-4 btn btn-orange">
                    Contact Supplier
                </a>
                <a href="{{ route('supplier-product', ['id' => $supplier->id]) }}"
                    class="px-5 rounded-pill fs-4 btn btn-success text-warning border border-warning">
                    Start Order
                </a>
                <button class="px-5 rounded-pill fs-4 btn btn-orange" onclick="sendSupplier({{ $supplier->user->id }})">
                    Chat now
                </button>
            </div>  
        </div>
        {{-- <div>
            <hr>
        </div>
        <div class="container mt-5 px-5">
            <form action="">
                <div class="text-center h3">Send message to supplier</div>
                <div class="h4">To:</div>
                <div class="d-flex gap-4">
                    <div class="h4">Message:</div>
                    <textarea name="" id="" cols="30" rows="10" class="w-100"
                        placeholder="Enter your inquiry details such as product name, color, size, quanity, material, etc."></textarea>
                </div>
                <div class=" text-center"><button class="btn btn-orange px-5 my-4" type="submit">Send</button></div>
            </form>
        </div> --}}
    </main>
@endsection
