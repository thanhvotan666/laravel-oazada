@extends('layouts.app')
@section('title', request()->getHost() . ': Your comprehensive B2B e-commerce platform')
@section('content')
    <link rel="stylesheet" href="{{ asset('storage/css/index.css') }}">
    <main>
        @include('include.banner')
        <!-- Top deals edit -->
        {{-- <section class="container-fluid d-flex flex-column align-items-center my-5">
            <div class="container row justify-content-between my-3">
                <h3 class="col-sm-6">
                    Top deals
                </h3>
                <h3 class="col-sm-6 text-end">
                    <a href="#">View more &rarr;</a>
                </h3>
            </div>
            <div class="container-fluid my-3 bg-wheat text-center rounded-5">
                <div class="p-3">
                    <h3>
                        <oazada>OAZADA</oazada> <strong>Guaranteed</strong>
                    </h3>
                </div>
                <div class="row p-3">
                    <div class="col-md-6">
                        Guaranteed delivery by the scheduled dates
                    </div>
                    <div class="col-md-6">
                        Money back guarantee
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center gap-2">
                    <div class="col-xl bg-grey d-flex flex-column rounded-5 px-0">
                        <div class="p-4 fw-bold">Over 80% below retail price </div>
                        <div class="row gap-3 justify-content-between">
                            <div class="col text-center">
                                <img align="center" class="rounded-5" src="image/products/bike.jpg"
                                    style="width: 180px; height: 150px;">
                                <div class="fw-bold px-3">
                                    <oazada>OAZADA</oazada>Guaranteed
                                </div>
                                <div class="fw-bold px-3">$1.25</div>
                                <div class=" px-3"><small>Min. order: 2 pieces</small></div>
                            </div>
                            <div class="col text-center">
                                <img align="center" class="rounded-5" src="image/products/bike.jpg"
                                    style="width: 180px; height: 150px;">
                                <div class="fw-bold px-3">
                                    <oazada>OAZADA</oazada>Guaranteed
                                </div>
                                <div class="fw-bold px-3">$1.25</div>
                                <div class=" px-3"><small>Min. order: 2 pieces</small></div>
                            </div>
                            <div class="col text-center">
                                <img align="center" class="rounded-5" src="image/products/bike.jpg"
                                    style="width: 180px; height: 150px;">
                                <div class="fw-bold px-3">
                                    <oazada>OAZADA</oazada>Guaranteed
                                </div>
                                <div class="fw-bold px-3">$1.25</div>
                                <div class=" px-3"><small>Min. order: 2 pieces</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl bg-grey d-flex flex-column rounded-5 px-0">
                        <div class="p-4 fw-bold">Spotlight on other savings </div>
                        <div class="row gap-3 justify-content-between">
                            <div class="col text-center">
                                <img align="center" class="rounded-5" src="image/products/bike.jpg"
                                    style="width: 180px; height: 150px;">
                                <div class="fw-bold px-3">
                                    <oazada>OAZADA</oazada>Guaranteed
                                </div>
                                <div class="fw-bold px-3">$1.25</div>
                                <div class=" px-3"><small>Min. order: 2 pieces</small></div>
                            </div>
                            <div class="col text-center">
                                <img align="center" class="rounded-5" src="image/products/bike.jpg"
                                    style="width: 180px; height: 150px;">
                                <div class="fw-bold px-3">
                                    <oazada>OAZADA</oazada>Guaranteed
                                </div>
                                <div class="fw-bold px-3">$1.25</div>
                                <div class=" px-3"><small>Min. order: 2 pieces</small></div>
                            </div>
                            <div class="col text-center">
                                <img align="center" class="rounded-5" src="image/products/bike.jpg"
                                    style="width: 180px; height: 150px;">
                                <div class="fw-bold px-3">
                                    <oazada>OAZADA</oazada>Guaranteed
                                </div>
                                <div class="fw-bold px-3">$1.25</div>
                                <div class=" px-3"><small>Min. order: 2 pieces</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Top ranking edit -->
        {{-- <section class="container-fluid d-flex flex-column align-items-center my-5">
            <div class="container row justify-content-between my-3">
                <h3 class="col-sm-6">
                    Top ranking
                </h3>
                <h3 class="col-sm-6 text-end">
                    <a href="#">View more &rarr;</a>
                </h3>
            </div>
            <div class="container d-flex gap-5 my-3">
                <a class="btn btn-outline-secondary active rounded-pill">Most popular </a>
                <a class="btn btn-outline-secondary rounded-pill">Hot selling </a>
                <a class="btn btn-outline-secondary rounded-pill">Best reviewed </a>
            </div>
            <div class="container-fluid">
                <div class="d-flex flex-wrap justify-content-between gap-3">
                    <div class=" bg-grey rounded-5 p-0 ">
                        <div class="p-4 border-bottom border-dark">Luminous Quartz Watches L</div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-1">
                                <div class="num-rank-top"> #1</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">

                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-2">
                                <div class="num-rank-top"> #2</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">
                                    <oazada>OAZADA</oazada> Guaranteed
                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-3">
                                <div class="num-rank-top"> #3</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">

                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                    </div>
                    <div class=" bg-grey rounded-5 p-0 ">
                        <div class="p-4 border-bottom border-dark">Luminous Quartz Watches L</div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-1">
                                <div class="num-rank-top"> #1</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">

                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-2">
                                <div class="num-rank-top"> #2</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">
                                    <oazada>OAZADA</oazada> Guaranteed
                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-3">
                                <div class="num-rank-top"> #3</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">

                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                    </div>
                    <div class=" bg-grey rounded-5 p-0 ">
                        <div class="p-4 border-bottom border-dark">Luminous Quartz Watches L</div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-1">
                                <div class="num-rank-top"> #1</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">

                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-2">
                                <div class="num-rank-top"> #2</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">
                                    <oazada>OAZADA</oazada> Guaranteed
                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-3">
                                <div class="num-rank-top"> #3</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">

                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                    </div>
                    <div class=" bg-grey rounded-5 p-0 ">
                        <div class="p-4 border-bottom border-dark">Luminous Quartz Watches L</div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-1">
                                <div class="num-rank-top"> #1</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">

                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-2">
                                <div class="num-rank-top"> #2</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">
                                    <oazada>OAZADA</oazada> Guaranteed
                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3 ranking">
                            <img src="image/products/bike.jpg" class="card-img-top rounded-5" alt="..."
                                style="width: 140px;height: 140px">
                            <div class="m-3 num-rank rank-3">
                                <div class="num-rank-top"> #3</div>
                                <div class="num-rank-bottom"></div>
                            </div>
                            <div class="ps-3">
                                <div class="fw-bold">

                                </div>
                                <div>Popularity score: 4.7</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- New arrivals  -->
        <section class="container-fluid d-flex flex-column align-items-center my-5">
            <div class="container row justify-content-between my-5">
                <h3 class="col-sm-6">
                    New arrivals
                </h3>
                <h3 class="col-sm-6 text-end">
                    <a href="{{ route('search.index') }}">View more &rarr;</a>
                </h3>
            </div>
            <div class="row row-cols-1 row-cols-md-4 g-4 py-4  bg-grey rounded-3">
                @foreach ($newArrivals as $newArrival)
                    <div class="col">
                        <a href="{{ route('product', ['id' => $newArrival->id]) }}" class="card h-100 border-0 bg-grey">
                            <img src="{{ asset($newArrival->image) }}" class="card-img-top rounded-5" alt="...">
                            <div class="card-body">
                                <div class="card-text">
                                    <div>
                                        <strong>
                                            @if ($newArrival->is_variant)
                                                ${{ $newArrival->variants->min('price') }} -
                                                ${{ $newArrival->variants->max('price') }}
                                            @else
                                                ${{ $newArrival->variants->min('price') }}
                                            @endif
                                        </strong>
                                    </div>
                                    <div class="text-secondary">Min. order: 1 price</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- Recommended for your business edit -->
        {{-- <section class="container-fluid d-flex flex-column align-items-center my-5">
            <div class="container row justify-content-between">
                <h3 class="col-sm-6">
                    Recommended for your business
                </h3>
                <h3 class="col-sm-6 text-end">
                    <a href="#">View more &rarr;</a>
                </h3>
            </div>
            <div class="d-flex flex-wrap justify-content-between gap-5 p-5">
                <a href="#" class="d-flex gap-3">
                    <div class="col h-200">
                        <img src="image/recommended for your bussiness/jfi1.jpg" alt=""
                            class="rounded mx-auto d-block" width="250" height="250">
                    </div>
                    <div class="col d-flex flex-column justify-content-between">
                        <img src="image/recommended for your bussiness/jfi2.webp" alt="" class="rounded"
                            width="120" height="120">
                        <img src="image/recommended for your bussiness/jfi3.jpg" alt="" class="rounded"
                            width="120" height="120">
                    </div>
                </a>
                <a class="d-flex gap-3">
                    <div class="col h-200">
                        <img src="image/recommended for your bussiness/ship1.webp" alt=""
                            class="rounded mx-auto d-block" width="250" height="250">
                    </div>
                    <div class="col d-flex flex-column justify-content-between">
                        <img src="image/recommended for your bussiness/ship2.jpg" alt="" class="rounded"
                            width="120" height="120">
                        <img src="image/recommended for your bussiness/ship3.jpg" alt="" class="rounded"
                            width="120" height="120">
                    </div>
                </a>
                <a class="d-flex gap-3">
                    <div class="col h-200">
                        <img src="image/recommended for your bussiness/jfi1.jpg" alt=""
                            class="rounded mx-auto d-block" width="250" height="250">
                    </div>
                    <div class="col d-flex flex-column justify-content-between">
                        <img src="image/recommended for your bussiness/jfi2.webp" alt="" class="rounded"
                            width="120" height="120">
                        <img src="image/recommended for your bussiness/jfi3.jpg" alt="" class="rounded"
                            width="120" height="120">
                    </div>
                </a>
            </div>
            <div>
                <hr>
            </div>
        </section> --}}
        <!-- Get product inspiration -->
        <section class="container-fluid  d-flex flex-column align-items-center bg-grey m-0 py-5">
            <div class="container">
                <h3>Get product inspiration</h3>
            </div>
            <div class="row row-cols-1 row-cols-xl-6 g-4 mx-2 ">
                @foreach ($productInspirations as $productInspiration)
                    <div class="col">
                        <a href="{{ route('product', ['id' => $productInspiration->id]) }}" class="card h-100">
                            <img src="{{ asset($productInspiration->image) }}" class="card-img-top"
                                alt="{{ $productInspiration->name }}">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <oazada>OAZADA</oazada> Guaranteed
                                </h6>
                                <div class="card-text">
                                    <p class="card-content text-secondary">
                                        {{ $productInspiration->code }} - {{ $productInspiration->name }}
                                    </p>
                                    <div>
                                        <strong>
                                            @if ($productInspiration->is_variant)
                                                ${{ $productInspiration->variants->min('price') }} -
                                                ${{ $productInspiration->variants->max('price') }}
                                            @else
                                                ${{ $productInspiration->variants->min('price') }}
                                            @endif
                                        </strong>
                                    </div>
                                    <div class="text-secondary">Easy Return</div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted d-flex gap-1">
                                    <div><img src="{{ asset('storage/image/icon/verified icon.png') }}" alt="verified"
                                            height="20px"></div>
                                    <div>
                                        @if (now()->diffInYears($productInspiration->created_at) != 0)
                                            {{ now()->diffInYears($productInspiration->created_at) }} years ago
                                        @elseif (now()->diffInMonths($productInspiration->created_at) != 0)
                                            {{ now()->diffInMonths($productInspiration->created_at) }} months ago
                                        @elseif (now()->diffInDays($productInspiration->created_at) != 0)
                                            {{ now()->diffInDays($productInspiration->created_at) }} days ago
                                        @elseif (now()->diffInHours($productInspiration->created_at) != 0)
                                            {{ now()->diffInHours($productInspiration->created_at) }} hours ago
                                        @else
                                            {{ now()->diffInMinutes($productInspiration->created_at) ?? 0 }} munites ago
                                        @endif
                                    </div>
                                    <div>.</div>
                                    <div>
                                        {{ $productInspiration->supplier->user->country->code }}
                                    </div>
                                </small>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center my-4">
                <a href="{{ route('search.index') }}" class="btn border-1 border-dark rounded-pill bg-white px-5">
                    <h3 class="px-5">
                        <div class="px-5">View more</div>
                    </h3>
                </a>
            </div>
        </section>
        <!--edit-->
        <!-- Find suppliers by country or region -->
        <section class="container-fluid bg-grey py-4">
            <div class="container">
                <div class="row justify-content-between">
                    <h3 class="col-sm-6">
                        Find suppliers by country or region
                    </h3>
                    <h3 class="col-sm-6 text-end">
                        <a href="{{ route('search.all-suppliers') }}">View more &rarr;</a>
                    </h3>
                </div>
                <div class="d-flex flex-wrap gap-5 justify-content-center">
                    @foreach ($countries as $country)
                        <a href="{{ route('search.all-suppliers') . '?country_id=' . $country->id }}">
                            <div class="d-flex justify-content-center">
                                <div class="rounded-circle bg-light d-flex justify-content-center align-items-center"
                                    style="width: 60px; height: 60px;">
                                    <img src="{{ asset($country->image) }}" alt="{{ $country->name }}" height="20px">
                                </div>
                            </div>
                            <div class="text-center">
                                {{ $country->name }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
