@extends('layouts.admin')

@section('title', 'Categories')
@section('content')
    <div class="container-fluid d-flex flex-column gap-4 ">
        <div class="p-5 d-flex flex-column gap-4">
            <div class="d-flex justify-content-between">
                <div class="h2 fw-bold ">
                    Categories
                </div>
                <button class="h2 fw-bold btn btn-success px-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    Add
                </button>
            </div>
            @include('include.showAlert')
            <div class="container-fluid bg-white border rounded-4">
                <form action="{{ route('admin.categories.index') }}">
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
                                        placeholder="Search by category name ..." aria-label="name"
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
                                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Filter Categories</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body d-flex flex-column gap-4">
                                    <div class="d-flex">
                                        <div class="d-flex">

                                            <input type="checkbox" class="form-check-input me-1"
                                                @checked(request('category_type_id'))
                                                onclick="document.getElementById('category_type_id').disabled  = !this.checked;">

                                            <label class="w-25">
                                                Category Type
                                            </label>

                                            <select name="category_type_id" id="category_type_id"
                                                class="dropdown-item form-control border " @disabled(is_null(request('category_type_id')))>
                                                @foreach ($categoryTypes as $categoryType)
                                                    <option value="{{ $categoryType->id }}" @selected(request('category_type_id') == $categoryType->id)>
                                                        {{ $categoryType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Category type</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="result">
                                @foreach ($categories as $category)
                                    <tr class="w-100">
                                        <th scope="row">{{ $category->id }}</th>
                                        <td class="">{{ $category->name }}</td>
                                        <td class="">{{ $category->categoryType->name }}</td>
                                        <td class="text-end">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16"
                                                class="btn btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                            </svg>

                                            <ul class="dropdown-menu">
                                                {{-- edit --}}
                                                <li><a class="dropdown-item"
                                                        href="{{ route('admin.products.index', ['category_id' => $category->id]) }}">View</a>
                                                </li>
                                                <li>
                                                    <div class="btn dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal{{ $category->id }}">
                                                        Edit
                                                    </div>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action=""></form>
                                                    <form
                                                        action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item text-danger">Remove</button>
                                                    </form>
                                                </li>
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
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10
                                    </option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                            {{ $categories->appends([
                                    'per_page' => request('per_page'),
                                    'name' => request('name'),
                                    'category_type_id' => request('category_type_id'),
                                ])->links() }}
                        </div>
                    </div>
            </div>
            </form>
        </div>
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add Category </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="categoryForm" action="{{ route('admin.categories.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="name" id="createCategoryName"
                                    placeholder="Enter category name" required>
                            </div>
                            <div class="mb-3">
                                <label for="category_type_id" class="form-label">Category Type</label>
                                <select name="category_type_id" id="" class="form-select">
                                    @foreach ($categoryTypes as $categoryType)
                                        <option value="{{ $categoryType->id }}">
                                            {{ $categoryType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($categories as $category)
        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
            aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="categoryForm"
                            action="{{ route('admin.categories.update', ['category' => $category->id]) }}"
                            method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter category name" required value="{{ $category->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="category_type_id" class="form-label">Category Type</label>
                                <select name="category_type_id" id="" class="form-select">
                                    @foreach ($categoryTypes as $categoryType)
                                        <option value="{{ $categoryType->id }}"
                                            {{ $categoryType->id == $category->categoryType->id ? 'selected' : '' }}>
                                            {{ $categoryType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
