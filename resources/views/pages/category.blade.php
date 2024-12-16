@extends('layouts.app')

@section('title', request()->getHost() . ': ' . $category->name)
@section('content')
    <main class="container-fluid bg-grey pb-5 px-0">
        <div class="container-fluid p-0"
            style="background-image: url('{{ asset('storage/image/temp/O1CN01KaRUno1FDynLxJeS1_!!6000000000454-2-tps-2200-600.avif') }}');
        background-color: rgba(0, 0, 0, 0.4);
        background-blend-mode: multiply; 
        width: 100%;
        height: 250px;    
        background-position: top center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 130px;">
            <div class="container-fluid" style="position: absolute;top:0">
                <div class="text-white text-center p-5">
                    <div class="h1 fw-bold">{{ $category->name }}</div>
                    <div>Discover new and trending products</div>
                </div>
                <div class="container">
                    <div class="px-5">
                        <div class="bg-white rounded-4" style="height:200px">
                            <div class="text-dark p-3 fw-bold h5">Keywords by category</div>
                            <div class="p-3 overflow-x-auto d-flex gap-4 w-100">
                                @foreach ($keywords as $keyword)
                                    <a href="{{ route('search.index', ['keyword' => $keyword->keyword]) }}">
                                        <div>
                                            <img src="{{ asset($keyword->product->image) }}" alt="{{ $keyword->keyword }}"
                                                height="80" width="80" class="border rounded-circle">
                                        </div>
                                        <div>{{ $keyword->keyword }}</div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="d-flex flex-column gap-4">
            <div class="container">
                <div class="px-5">
                    <h4 class="p-2 fw-bold">Expert-curated hot picks</h4>
                    <div class="d-flex flex-wrap">
                        <!-- for 3 -->
                        @foreach ($keywords->take(3) as $keyword)
                            <div class="col-lg-4">
                                <div class="p-3">
                                    <div class="p-3 bg-white rounded-4">
                                        <h3 class="fw-bold">{{ $keyword->keyword }}</h3>
                                        <div>
                                            <hr>
                                        </div>
                                        @php
                                            $sortedProducts = App\Models\Product::where('category_id', $category->id)
                                                ->whereHas('keywords', function ($query) use ($keyword) {
                                                    $query->where('keyword', $keyword->keyword);
                                                })
                                                ->with('variants')
                                                ->get()
                                                ->map(function ($product) {
                                                    $totalStockDifference = $product->variants->sum(function (
                                                        $variant,
                                                    ) {
                                                        return $variant->total_stock - $variant->stock;
                                                    });

                                                    return [
                                                        'product' => $product,
                                                        'total_stock_difference' => $totalStockDifference,
                                                    ];
                                                })
                                                ->sortByDesc('total_stock_difference');
                                        @endphp

                                        @foreach ($sortedProducts->take(3) as $i => $p)
                                            <a class="d-flex align-items-center justify-content-between p-3 ranking"
                                                href="{{ route('product', ['id' => $p['product']->id]) }}">
                                                <img src="{{ asset($p['product']->image) }}" class="card-img-top rounded-4"
                                                    alt="{{ $p['product']->name }}" style="width: 140px;height: 140px">
                                                <div class="m-3 num-rank rank-{{ $i + 1 }}">
                                                    <div class="num-rank-top"> #{{ $i + 1 }}</div>
                                                    <div class="num-rank-bottom"></div>
                                                </div>
                                                <div class="ps-3">
                                                    <div class="card-content">
                                                        {{ $p['product']->name }}
                                                    </div>
                                                    <h5 class="fw-bold ">
                                                        @if ($p['product']->is_variant)
                                                            ${{ $p['product']->variants->min('price') }} -
                                                            ${{ $p['product']->variants->max('price') }}
                                                        @else
                                                            ${{ $p['product']->variants->min('price') }}
                                                        @endif
                                                    </h5>
                                                    <div>sold: {{ $p['total_stock_difference'] }}</div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- <div class="container ">
                <div class="px-5">
                    <div class="bg-white rounded-4">
                        <h3 class="p-3 fw-bold">Cross-industry picks</h3>
                        <div class="d-flex overflow-x-hidden gap-4" style="height: 290px;">
                            <!-- all history -->
                            <div class="p-2">
                                <div style="width: 200px;">
                                    <img src="../storage/image/product/shirt.avif" alt="" style="width: 100%;"
                                        class="rounded-3">
                                    <div class="card-content text-center fw-bold">
                                        1232178y12wdhuifh y8uhfy8uwhwiuj
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="container">
                <div class="px-5">
                    <h4 class="">Just for you</h4>
                    <!-- all product of key -->
                    <div class="row row-cols-lg-5 g-2 g-lg-3 text-center">
                        @foreach ($keyProducts as $product)
                            <a class="col" href="{{ route('product', ['id' => $product->id]) }}">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 100%;"
                                    class="rounded-4">
                                <div class="p-3 fw-bold">{{ $product->name }}</div>
                            </a>
                        @endforeach
                    </div>
                    <div>
                        {{ $keyProducts->appends([
                                'per_page' => request('per_page'),
                            ])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
