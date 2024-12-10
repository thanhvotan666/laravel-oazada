@extends('layouts.admin')

@section('title',  request()->getHost() .' - Admin - Supplier')
@section('content')
    <div class="container-fluid d-flex flex-column gap-4 ">
        <div class="p-5 d-flex flex-column gap-4">
            <div class="d-flex justify-content-between">
                <div class="h2 fw-bold ">
                    Supplier
                </div>
                <a href="{{ route('admin.suppliers.create') }}" class="h2 fw-bold btn btn-success px-3">
                    Add
                </a>
            </div>
            @include('include.showAlert')
            <div class="container-fluid bg-white border rounded-4">
                <form action="{{ route('admin.suppliers.index') }}">
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
                                        placeholder="Search by supplier name ..." aria-label="Username"
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
                                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Filter Suppliers</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body d-flex flex-column gap-4">
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('company_name')) ?: 'checked' }}
                                            onclick="document.getElementById('company_name').disabled = !this.checked;">
                                        <label class="w-25" for="company_name">
                                            Company
                                        </label>
                                        <input type="text" name="company_name" id="company_name" class="form-control"
                                            {{ is_null(request('company_name')) ? 'disabled' : '' }}
                                            value="{{ request('company_name') }}">
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('email')) ?: 'checked' }}
                                            onclick="document.getElementById('email').disabled = !this.checked;">
                                        <label class="w-25" for="email">
                                            Email
                                        </label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            {{ is_null(request('email')) ? 'disabled' : '' }}
                                            value="{{ request('email') }}">
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('address')) ?: 'checked' }}
                                            onclick="document.getElementById('address').disabled = !this.checked;">
                                        <label class="w-25" for="address">
                                            Address
                                        </label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            {{ is_null(request('address')) ? 'disabled' : '' }}
                                            value="{{ request('address') }}">
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('website')) ?: 'checked' }}
                                            onclick="document.getElementById('website').disabled = !this.checked;">
                                        <label class="w-25" for="website">
                                            Website
                                        </label>
                                        <input type="text" name="website" id="website" class="form-control"
                                            {{ is_null(request('website')) ? 'disabled' : '' }}
                                            value="{{ request('website') }}">
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            {{ is_null(request('phone_number')) ?: 'checked' }}
                                            onclick="document.getElementById('phone_number').disabled = !this.checked;">
                                        <label class="w-25" for="phone_number">
                                            Phone
                                        </label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                            {{ is_null(request('phone_number')) ? 'disabled' : '' }}
                                            value="{{ request('phone_number') }}">
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
                                    <th scope="col">Company</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Website</th>
                                    <th scope="col">User</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="result">
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <th scope="row">{{ $supplier->id }}</th>
                                        <td class="">{{ $supplier->name }}</td>
                                        <td class="">{{ $supplier->company_name }}</td>
                                        <td class="">{{ $supplier->email }}</td>
                                        <td class="">
                                            <a href="{{ 'http://' . $supplier->website }}">{{ $supplier->website }}</a>
                                        </td>
                                        <td class="">{{ $supplier->user->name }}</td>
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
                                                        href="{{ route('admin.suppliers.show', ['supplier' => $supplier->id]) }}">View</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('admin.suppliers.edit', ['supplier' => $supplier->id]) }}">Edit</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action=""></form>
                                                    <form
                                                        action="{{ route('admin.suppliers.destroy', ['supplier' => $supplier->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this supplier?')">
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
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                            </div>
                        </div>
                        <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                            {{ $suppliers->appends([
                                    'per_page' => request('per_page'),
                                    'name' => request('name'),
                                    'address' => request('address'),
                                    'email' => request('email'),
                                    'phone_number' => request('phone_number'),
                                    'company_name' => request('company_name'),
                                    'user_id' => request('user_id'),
                                    'website' => request('website'),
                                    'tax_code' => request('tax_code'),
                                    'bank_account_number' => request('bank_account_number'),
                                    'bank_name' => request('bank_name'),
                                ])->links() }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
