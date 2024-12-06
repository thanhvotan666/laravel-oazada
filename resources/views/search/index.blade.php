@extends('layouts.app')

@section('title', 'Search Products')
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

        const changeProductShow = (show) => {
            document.getElementById('product_show').value = show;
            document.getElementById('filterForm').submit();
        }
    </script>
    <main>
        <section class="container-fluid py-5 bg-grey">
            @include('include.showAlert')
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
            <form class="d-flex flex-column" method="get" id="filterForm">
                <div class="d-flex">
                    <div class="d-flex flex-column gap-3 bg-white p-3 col-2">

                        <div class="h3">Filters</div>
                        <input type="hidden" name="product_show" id='product_show'
                            value="{{ request('product_show', 'stack') }}">
                        @if (request('supplier_id'))
                            <input type="hidden" name="supplier_id" id="supplier_id" value="{{ request('supplier_id') }}">
                        @endif
                        <div class="h4">
                            Code
                        </div>
                        <div class="d-flex gap-1 align-items-center">
                            <div><input class="form-control" type="text" name="code" id='code'>
                            </div>
                            <div><input class="btn btn-outline-dark px-3 rounded-pill" type="submit" value="OK">
                            </div>
                        </div>
                        <div class="h4">
                            Name
                        </div>
                        <div class="d-flex gap-1 align-items-center">
                            <div><input class="form-control" type="text" name="name" value='{{ request('name') }}'
                                    placeholder="Name">
                            </div>
                            <div><input class="btn btn-outline-dark px-3 rounded-pill" type="submit" value="OK">
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
                        <div class="h4">
                            Price
                        </div>
                        <div class="d-flex gap-1 align-items-center">
                            <div>
                                <input class="btn btn-outline-secondary" placeholder="Min." type="number" name="price_min"
                                    min="0" style="width: 100%;" value="{{ request('price_min') ?? 0 }}">
                            </div>
                            <div>-</div>
                            <div>
                                <input class="btn btn-outline-secondary" placeholder="Max." type="number" name="price_max"
                                    min="0" style="width: 100%;" value="{{ request('price_max') ?? '' }}">
                            </div>
                            <div>
                                <input class="btn btn-outline-dark px-3 rounded-pill" type="submit" value="OK"
                                    style="width: 100%;">
                            </div>
                        </div>
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
                    </div>
                    <!-- stack or Grid -->
                    @if (is_null(request('product_show')) || request('product_show') == 'stack')
                        @include('search.include.products-stack')
                    @else
                        @include('search.include.products-grid')
                    @endif
                    <!-- suppliers  -->
                </div>

                <div class="p-4 bg-white d-flex justify-content-center">
                    {{ $products->appends([
                            'per_page' => request('per_page'),
                            'supplier_id' => request('supplier_id'),
                            'product_show' => request('product_show'),
                            'code' => request('code'),
                            'name' => request('name'),
                            'is_variant' => request('is_variant'),
                            'price_min' => request('price_min'),
                            'price_max' => request('price_max'),
                            'category_type_id' => request('category_type_id'),
                            'category_id' => request('category_id'),
                            'country_id' => request('country_id'),
                        ])->links() }}
                </div>
            </form>
        </section>
    </main>
@endsection
