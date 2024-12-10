@extends('layouts.app')

@section('title',  request()->getHost() .' - Search Suppliers')
@section('content')
    <link rel="stylesheet" href="{{ asset('storage/css/trade.css') }}">
    <script>
        const filterCategoryType = (elm) => {
            document.getElementById('category_type_id').value = elm.value;
            document.getElementById('category_id').value = 0;
            document.getElementById('filterForm').submit();
        }
        const filterCategory = (elm) => {
            document.getElementById('category_id').value = elm.value;
            const allCategories = document.getElementById('allCategories');
            const arrayAllCategories = allCategories.querySelectorAll('button');
            arrayAllCategories.forEach(element => {
                element.classList.remove('btn-success');
                element.classList.remove('fw-bold');
            });
            elm.classList.add('btn-success');
            elm.classList.add('fw-bold');
        }

        function onClickFilterCountry(elm) {
            document.getElementById('country_id').value = elm.value;
            const allCountries = document.getElementById('allCountries');
            const arrayAllCountries = allCountries.querySelectorAll('button');
            arrayAllCountries.forEach(element => {
                element.classList.remove('btn-success');
                element.classList.remove('fw-bold');
            });
            elm.classList.add('btn-success');
            elm.classList.add('fw-bold');
            console.log(elm);
            console.log(document.getElementById('country_id').value);
        }
    </script>
    <main>
        <section class="container-fluid py-5 bg-grey">
            <div class="d-flex flex-wrap gap-5">
                <a href="{{ route('search.index') }}" name=""
                    class="trade {{ !request()->is('search') ?: 'active' }}">Products</a>
                <a href="{{ route('search.all-suppliers') }}" name=""
                    class="trade {{ !request()->is('search/all-suppliers') ?: 'active' }}">All
                    suppliers</a>
            </div>
        </section>
        <!-- products -->
        <section class="container-fluid bg-grey">
            <div class="d-flex flex-column">
                <div class="d-flex">
                    <form class="d-flex flex-column gap-3 bg-white p-3 col-2" action="" method="get" id="filterForm">
                        <div class="h3">Filters</div>
                        <input type='text' class="form-control" name='name' value='{{ request('name') }}'>
                        <div class="h4">
                            Company
                        </div>
                        <div class="d-flex gap-1 align-items-center">
                            <div><input class="btn btn-outline-secondary" type="text" name="company_name"
                                    style="width: 100%; " value='{{ request('company_name') }}'>
                            </div>
                            <div><input class="btn btn-outline-dark px-3 rounded-pill" type="submit" value="OK"
                                    style="width: 100%;">
                            </div>
                        </div>
                        <div class="h4">
                            Category Types
                        </div>
                        <div class="left-list d-flex flex-column gap-1">
                            <input type="hidden" name="category_type_id" id="category_type_id"
                                value='{{ request('category_type_id', 0) }}'>
                            <button type="button"
                                class="btn text-start {{ is_null(request('category_type_id')) || request('category_type_id') == 0 ? 'btn-success fw-bold' : '' }}"
                                value="0" onclick="filterCategoryType(this)">All</button>
                            @foreach ($categoryTypes as $categoryType)
                                <button type="button"
                                    class="btn text-start {{ request('category_type_id') == $categoryType->id ? 'btn-success fw-bold' : '' }}"
                                    value="{{ $categoryType->id }}" onclick="filterCategoryType(this)">
                                    {{ $categoryType->name }}
                                </button>
                            @endforeach
                        </div>
                        <div class="h4">
                            Categories
                        </div>
                        <div class="left-list d-flex flex-column gap-1" id="allCategories">
                            <input type="hidden" name="category_id" id="category_id"
                                value='{{ request('category_id', 0) }}'>
                            <button type="button"
                                class="btn text-start {{ is_null(request('category_id')) || request('category_id') == 0 ? 'btn-success fw-bold' : '' }}"
                                value="0" onclick="filterCategory(this)">All</button>
                            @foreach ($filterCategories as $filterCategory)
                                <button type="button"
                                    class="btn text-start {{ request('category_id') == $filterCategory->id ? 'btn-success fw-bold' : '' }}"
                                    value="{{ $filterCategory->id }}" onclick="filterCategory(this)">
                                    {{ $filterCategory->name }}
                                </button>
                            @endforeach
                        </div>
                        {{-- edit --}}
                        <div class="h4">
                            Supplier country/region
                        </div>
                        <div class="left-list d-flex flex-column gap-1" id="allCountries">
                            <input type="hidden" name="country_id" id="country_id"
                                value="{{ request('country_id', '0') }}">
                            <button type="button" value="0"
                                class="btn text-start {{ request('country_id', 0) == 0 ? 'btn-success fw-bold' : '' }}"
                                onclick="onClickFilterCountry(this)">
                                All
                            </button>
                            @foreach ($countries as $country)
                                <button type="button"
                                    class="btn text-start {{ request('country_id', 0) == $categoryType->id ? 'btn-success fw-bold' : '' }}"
                                    value="{{ $country->id }}" onclick="onClickFilterCountry(this)">
                                    {{ $country->name }}
                                </button>
                            @endforeach

                        </div>
                        <button type="submit" class="btn btn-primary">Filters</button>
                    </form>

                    <!-- stack or Grid -->
                    <div class="container-fluid d-flex flex-column">
                        @foreach ($suppliers as $supplier)
                            <div class="d-flex flex-column p-4 gap-4 border bg-white">
                                <div class="d-flex flex-wrap justify-content-between ">
                                    <div class="d-flex gap-2">
                                        <div>
                                            <a href="">
                                                <img src="{{ asset($supplier->user->avatar) }}" alt=""
                                                    height="50">
                                            </a>
                                        </div>
                                        <div>
                                            <a href="" style="text-decoration: underline;">
                                                {{ $supplier->name }}
                                            </a>
                                            <div class="d-flex gap-2">
                                                <img src="image/icon/verified icon.png" alt="" height="20">
                                                <div>
                                                    @if (now()->diffInYears($supplier->created_at) != 0)
                                                        {{ now()->diffInYears($supplier->created_at) }} years
                                                    @elseif (now()->diffInMonths($supplier->created_at) != 0)
                                                        {{ now()->diffInMonths($supplier->created_at) }} months
                                                    @else
                                                        {{ now()->diffInDays($supplier->created_at) }} days
                                                    @endif
                                                </div>
                                                <div>{{ $supplier->orders->pluck('user_id')->unique()->count() }}+ staff
                                                </div>
                                                <div>USD
                                                    ${{ // 11836.15->11836
                                                        number_format($supplier->orders->sum('total'), 0, ',', '.') }}+
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- edit --}}
                                    <div class="d-flex gap-2">
                                        <button onclick="sendSupplier({{ $supplier->user->id }})"
                                            class="d-flex
                                            align-items-center rounded-pill px-4 fw-bold btn btn-outline-dark">Chat
                                            now</button>
                                        <a href="{{ route('supplier-contacts', ['id' => $supplier->id]) }}"
                                            class="d-flex align-items-center rounded-pill px-4 fw-bold btn btn-outline-dark">Contact
                                            supplier</a>
                                        <a href="{{ route('supplier', ['id' => $supplier->id]) }}"
                                            class="d-flex align-items-center rounded-pill px-4 fw-bold btn btn-orange">View
                                            profile</a>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap justify-content-between">
                                    <div class="d-flex flex-column gap-4">
                                        <a href="">
                                            <div>Rating and reviews</div>
                                            @php
                                                $countReview = 0;
                                                $sumStar = 0;
                                                foreach ($supplier->products as $product) {
                                                    foreach ($product->reviews as $review) {
                                                        $countReview++;
                                                        $sumStar += $review->star;
                                                    }
                                                }
                                                $rating = $sumStar != 0 ? $sumStar / $countReview : 5;
                                            @endphp
                                            <div>
                                                {{ $rating }}
                                                /5
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill text-warning"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                                ({{ $countReview }} reviews)
                                            </div>
                                        </a>
                                        <div href="">
                                            <div>Capabilities</div>
                                            @php
                                                $i = 0;
                                            @endphp
                                            <div>
                                                <ul class="fw-bold">
                                                    @foreach ($supplier->products->pluck('category')->unique() as $category)
                                                        @break($i++ > 4)
                                                        <li>
                                                            <a
                                                                href="{{ route('search.index', ['category_id' => $category->id]) }}">
                                                                {{ $category->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap flex-row-reverse gap-4">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($supplier->products->take(3) as $product)
                                            @break($i++ > 2)
                                            @if ($i == 1)
                                                <a href="{{ route('product', ['id' => $product->id]) }}">
                                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                        width="200" height="200">
                                                </a>
                                            @else
                                                <a href="{{ route('product', ['id' => $product->id]) }}">
                                                    <div>
                                                        <img src="{{ asset($product->image) }}"
                                                            alt="{{ $product->name }}" width="130" height="130">
                                                    </div>
                                                    <div>
                                                        @if ($product->is_variant)
                                                            ${{ $product->variants->min('price') }} -
                                                            ${{ $product->variants->max('price') }}
                                                        @else
                                                            ${{ $product->variants->min('price') }}
                                                        @endif
                                                    </div>
                                                    <div>variants: {{ $product->variants->count() }}</div>
                                                </a>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- suppliers  -->
                </div>

                <div class="p-4 bg-white d-flex justify-content-center">
                    {{ $suppliers->appends([
                            'name' => request('name'),
                            'company_name' => request('company_name'),
                            'category_type_id' => request('category_type_id'),
                            'category_id' => request('category_id'),
                            'country_id' => request('country_id'),
                        ])->links() }}
                </div>
            </div>
        </section>
    </main>
@endsection
