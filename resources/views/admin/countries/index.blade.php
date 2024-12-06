@extends('layouts.admin')

@section('title', 'Countries')
@section('content')
    <script>
        //choose file 
        async function fetchImage(url, basename) {
            const response = await fetch(url);
            const blob = await response.blob();
            const file = new File([blob], basename, {
                type: blob.type
            });
            return file;
        }
        async function setImageInput(url, basename, id) {
            const file = await fetchImage(url, basename);
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            const inputElement = document.getElementById(id);
            inputElement.files = dataTransfer.files;
        }
    </script>
    <div class="container-fluid d-flex flex-column gap-4 ">
        <div class="p-5 d-flex flex-column gap-4">
            <div class="d-flex justify-content-between">
                <div class="h2 fw-bold ">
                    Countries
                </div>
                <button class="h2 fw-bold btn btn-success px-3" data-bs-toggle="modal" data-bs-target="#addCountryModal">
                    Add
                </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="container-fluid bg-white border rounded-4">
                <form action="{{ route('admin.countries.index') }}" method="GET">
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
                                        placeholder="Search by country name ..." aria-label="name"
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
                                    <th scope="col">Code</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Currency</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="result">
                                @foreach ($countries as $country)
                                    <tr>
                                        <th scope="row">{{ $country->id }}</th>
                                        <td class="">{{ $country->name }}</td>
                                        <td class="">{{ $country->code }}</td>
                                        <td class="">
                                            <img src="{{ asset($country->image) }}" alt="" height="50px">
                                        </td>
                                        <td class="">{{ $country->currency }}</td>
                                        <td class="text-end">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16"
                                                class="btn btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                            </svg>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <div class="btn dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editCountryModal{{ $country->id }}">
                                                        Edit
                                                    </div>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action=""></form>
                                                    <form
                                                        action="{{ route('admin.countries.destroy', ['country' => $country->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this country?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="dropdown-item text-danger"
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
                            {{ $countries->appends([
                                    'per_page' => request('per_page'),
                                    'name' => request('name'),
                                ])->links() }}
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="addCountryModal" tabindex="-1" aria-labelledby="addCountryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCountryModalLabel">Add Country</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addCountryForm" action="{{ route('admin.countries.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Country Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter country name" required>
                            </div>
                            <div class="mb-3">
                                <label for="code" class="form-label">Country Code</label>
                                <input type="text" class="form-control" name="code"
                                    placeholder="Enter country code" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="currency" class="form-label">Country Currency</label>
                                <input type="text" class="form-control" name="currency"
                                    placeholder="Enter country currency" required>
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
    @foreach ($countries as $country)
        <div class="modal fade" id="editCountryModal{{ $country->id }}" tabindex="-1"
            aria-labelledby="editCountryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Country
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="countryForm"
                            action="{{ route('admin.countries.update', ['country' => $country->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Country
                                    Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter country name" required value="{{ $country->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="code" class="form-label">Country Code</label>
                                <input type="text" class="form-control" name="code"
                                    placeholder="Enter country code" required value="{{ $country->code }}">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image{{ $country->id }}" name="image"
                                    accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="currency" class="form-label">Country Currency</label>
                                <input type="text" class="form-control" name="currency"
                                    placeholder="Enter country currency" required value="{{ $country->currency }}">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            setImageInput('{{ asset($country->image) }}', '{{ basename($country->image) }}', 'image{{ $country->id }}');
        </script>
    @endforeach

@endsection
