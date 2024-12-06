@extends('layouts.admin')

@section('title', 'Catrgory Types')
@section('content')
    <div class="container-fluid d-flex flex-column gap-4 ">
        <div class="p-5 d-flex flex-column gap-4">
            <div class="d-flex justify-content-between">
                <div class="h2 fw-bold ">
                    Category types
                </div>
                <button class="h2 fw-bold btn btn-success px-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    Add
                </button>
            </div>
            @include('include.showAlert')
            <div class="container-fluid bg-white border rounded-4">
                <form action="{{ route('admin.category_types.index') }}" method="GET">
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
                                        placeholder="Search by category type name ..." aria-label="name"
                                        aria-describedby="basic-addon1" value="{{ request('name') }}">
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
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="result">
                                @foreach ($categoryTypes as $categoryType)
                                    <tr>
                                        <th scope="row">{{ $categoryType->id }}</th>
                                        <td class="">{{ $categoryType->name }}</td>
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
                                                        href="{{ route('admin.categories.index', ['category_type_id' => $categoryType->id]) }}">View</a>
                                                </li>
                                                <li>
                                                    <div class="btn dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal{{ $categoryType->id }}">
                                                        Edit
                                                    </div>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action=""></form>
                                                    <form
                                                        action="{{ route('admin.category_types.destroy', ['category_type' => $categoryType->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this category type?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit"class="dropdown-item text-danger"
                                                            value="Remove">
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
                                <select name="per_page" id="per_page" onchange="this.form.submit()" class="form-select">
                                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                            </div>
                        </div>
                        <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                            {{ $categoryTypes->appends([
                                    'per_page' => request('per_page'),
                                    'name' => request('name'),
                                ])->links() }}
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add Category Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addCategoryForm" action="{{ route('admin.category_types.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Type Name</label>
                                <input type="text" class="form-control" name="name" id="createCategoryTypeName"
                                    placeholder="Enter category name" required>
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
    @foreach ($categoryTypes as $categoryType)
        <div class="modal fade" id="editCategoryModal{{ $categoryType->id }}" tabindex="-1"
            aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category Type
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="categoryForm"
                            action="{{ route('admin.category_types.update', ['category_type' => $categoryType->id]) }}"
                            method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Category Type
                                    Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter category name" required value="{{ $categoryType->name }}">
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
