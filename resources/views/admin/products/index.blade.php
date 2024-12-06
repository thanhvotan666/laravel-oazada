@extends('layouts.admin')

@section('title', 'Products')
@section('content')
    <div class="container-fluid d-flex flex-column gap-4 ">
        <div class="p-5 d-flex flex-column gap-4">
            <div class="d-flex justify-content-between">
                <div class="h2 fw-bold ">
                    Products
                </div>
                {{-- <a href="{{ route('admin.products.create') }}" class="h2 fw-bold btn btn-success px-3">
                    Add 
                </a> --}}
            </div>
            @include('include.showAlert')
            <div class="container-fluid bg-white border rounded-4">
                <form action="{{ route('admin.products.index') }}">
                    <div class="navbar">
                        <div class="container-fluid">
                            <div class="d-flex gap-3 p-4 w-100  ">
                                <div class="input-group" style="width: 100%;">
                                    <button class="input-group-text bg-white " id="basic-addon1" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg>
                                    </button>
                                    <input name="name" type="text" class="form-control"
                                        placeholder="Search by user name ..." aria-label="Username"
                                        aria-describedby="basic-addon1" value="{{ request('name') }}">
                                </div>
                                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                                    aria-label="Toggle navigation">
                                    <div class="text-success d-flex align-items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z" />
                                        </svg>
                                        Filter
                                    </div>
                                </button>
                            </div>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar"
                                aria-labelledby="offcanvasDarkNavbarLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Filter products</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body d-flex flex-column gap-4">
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('code')) ?: 'checked' }}>
                                        <label class="w-25" for="code">
                                            Code
                                        </label>
                                        <input type="text" name="code" id="code" class="form-control"
                                            {{ is_null(request('code')) ? 'disabled' : '' }} value="{{ request('code') }}">
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('description')) ?: 'checked' }}>
                                        <label class="w-25" for="description">
                                            Description
                                        </label>
                                        <input type="text" name="description" id="description" class="form-control"
                                            {{ is_null(request('description')) ? 'disabled' : '' }}
                                            value="{{ request('description') }}">
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('is_variant')) ?: 'checked' }}>
                                        <label class="w-25">
                                            Is Variant
                                        </label>
                                        <select name="is_variant" id="" class="dropdown-item form-select"
                                            {{ is_null(request('is_variant')) ? 'disabled' : '' }}>
                                            <option value="0" {{ request('is_variant') == 0 ? 'selected' : '' }}>
                                                None</option>
                                            <option value="1" {{ request('is_variant') == 1 ? 'selected' : '' }}>
                                                Have</option>
                                        </select>
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('hidden')) ?: 'checked' }}>
                                        <label class="w-25">
                                            Hidden
                                        </label>
                                        <select name="hidden" id="" class="dropdown-item form-select"
                                            {{ is_null(request('hidden')) ? 'disabled' : '' }}>
                                            <option value="0" {{ request('hidden') == 0 ? 'selected' : '' }}>
                                                unhidden</option>
                                            <option value="1" {{ request('hidden') == 1 ? 'selected' : '' }}>
                                                hidden</option>
                                        </select>
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('category_id')) ?: 'checked' }}>
                                        <label class="w-25">
                                            Category
                                        </label>
                                        <select name="category_id" id="" class="dropdown-item form-select"
                                            {{ is_null(request('category_id')) ? 'disabled' : '' }}>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('supplier_id')) ?: 'checked' }}>
                                        <label class="w-25">
                                            Supplier
                                        </label>
                                        <select name="supplier_id" id="" class="dropdown-item form-select"
                                            {{ is_null(request('supplier_id')) ? 'disabled' : '' }}>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}"
                                                    {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                    {{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" value="Filter" class="btn btn-orange">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Is Variant</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Hidden</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="result">
                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $product->id }}</th>
                                        <td class="">{{ $product->code }}</td>
                                        <td class="">{{ $product->name }}</td>
                                        <td class="">
                                            <img class="rounded-5" src="{{ asset($product->image) }}" alt=""
                                                height="60px">
                                        </td>
                                        <td class="{{ $product->is_variant == 0 ? 'text-white' : 'text-success' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-stack" viewBox="0 0 16 16">
                                                <path
                                                    d="m14.12 10.163 1.715.858c.22.11.22.424 0 .534L8.267 15.34a.6.6 0 0 1-.534 0L.165 11.555a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.66zM7.733.063a.6.6 0 0 1 .534 0l7.568 3.784a.3.3 0 0 1 0 .535L8.267 8.165a.6.6 0 0 1-.534 0L.165 4.382a.299.299 0 0 1 0-.535z" />
                                                <path
                                                    d="m14.12 6.576 1.715.858c.22.11.22.424 0 .534l-7.568 3.784a.6.6 0 0 1-.534 0L.165 7.968a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0z" />
                                            </svg>
                                        </td>
                                        <td class="">{{ $product->category->name }}</td>
                                        <td class="">{{ $product->supplier->name }}</td>
                                        <td class="">
                                            <form action=""></form>
                                            <form
                                                action="{{ route('admin.products.update', ['product' => $product->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name='edit_hidden'
                                                    class="btn {{ $product->hidden == 0 ? 'text-success' : 'text-danger' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-noise-reduction"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m.5-.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m-5 7a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1.5-1.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1-1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1-1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1-1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1-1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-3 5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m.5-.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                                        <path
                                                            d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M1 8a7 7 0 0 1 12.83-3.875.5.5 0 1 0 .15.235q.197.322.359.667a.5.5 0 1 0 .359.932q.201.658.27 1.364a.5.5 0 1 0 .021.282 7 7 0 0 1-.091 1.592.5.5 0 1 0-.172.75 7 7 0 0 1-.418 1.091.5.5 0 0 0-.3.555 7 7 0 0 1-.296.454.5.5 0 0 0-.712.453c0 .111.036.214.098.297a7 7 0 0 1-.3.3.5.5 0 0 0-.75.614 7 7 0 0 1-.455.298.5.5 0 0 0-.555.3 7 7 0 0 1-1.092.417.5.5 0 1 0-.749.172 7 7 0 0 1-1.592.091.5.5 0 1 0-.282-.021 7 7 0 0 1-1.364-.27A.498.498 0 0 0 5.5 14a.5.5 0 0 0-.473.339 7 7 0 0 1-.668-.36A.5.5 0 0 0 5 13.5a.5.5 0 1 0-.875.33A7 7 0 0 1 1 8" />
                                                    </svg>{{ $product->hidden == 0 ? 'unhidden' : ' hidden' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-end">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16"
                                                class="btn btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                            </svg>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('product', ['id' => $product->id]) }}">View</a>
                                                </li>
                                                {{-- <li><a class="dropdown-item"
                                                        href="{{ route('admin.products.edit', ['product' => $product->id]) }}">Edit</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action=""></form>
                                                    <form
                                                        action="{{ route('admin.products.destroy', ['product' => $product->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item text-danger">Remove</button>
                                                    </form>
                                                </li> --}}
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-3 d-flex align-items-center gap-4 justify-content-center">
                            <div>
                                <label for="per_page">Num of row:</label>
                                <select name="per_page" id="per_page" onchange="this.form.submit()"
                                    class="form-select">
                                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                            </div>
                        </div>
                        <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                            {{ $products->appends([
                                    'per_page' => request('per_page'),
                                    'name' => request('name'),
                                    'category_id' => request('category_id'),
                                ])->links() }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const parentDiv = this.closest('.d-flex');
                const inputElements = parentDiv.querySelectorAll('input, select');

                inputElements.forEach(element => {
                    element.disabled = !this
                        .checked;
                });
            });
        });
    </script>
@endsection
