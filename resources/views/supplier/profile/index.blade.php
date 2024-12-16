@extends('layouts.supplier')
@section('title',  request()->getHost() .': Profile')
@section('content')
    <main class="container-fluid bg-grey py-5">
        @include('include.showAlert')
        <div class="container-fluid row row-gap-5">
            <div class="col-lg-6 d-flex">
                <form class="container bg-white rounded-4 border p-5"
                    action="{{ route('supplier.profile.update', ['profile' => $user->supplier->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="update_supplier">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h1>Supplier</h1>

                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                    <h5 class="text-secondary ps-5">id: {{ $user->supplier->id }}</h5>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="name">Name: <sup class="text-danger">*</sup></label>
                        <div class="ms-5"> <input type="text" class="form-control" name="name"
                                value="{{ $user->supplier->name }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="company_name">Company name:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="company_name"
                                value="{{ $user->supplier->company_name }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="address">Address:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="address"
                                value="{{ $user->supplier->address }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="phone_number">Phone number:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="phone_number"
                                value="{{ $user->supplier->phone_number }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="email">Email:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="email"
                                value="{{ $user->supplier->email }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="website">Website:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="website"
                                value="{{ $user->supplier->website }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="tax_code">tax_code:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="tax_code"
                                value="{{ $user->supplier->tax_code }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="bank_account_number">bank account number:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="bank_account_number"
                                value="{{ $user->supplier->bank_account_number }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="bank_name">bank name:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="bank_name"
                                value="{{ $user->supplier->bank_name }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="contact_person">contact person:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="contact_person"
                                value="{{ $user->supplier->contact_person }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="contact_title">contact title:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="contact_title"
                                value="{{ $user->supplier->contact_title }}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 d-flex">
                <form class="container bg-white rounded-4 border p-5"
                    action="{{ route('supplier.profile.update', ['profile' => $user->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="update_user">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h1>User</h1>

                        <button class="btn btn-light fw-bold border" style="width: 200px;" data-bs-toggle="modal"
                            data-bs-target="#resetPassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-key-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                            </svg> Reset Password
                        </button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                    <h5 class="text-secondary ps-5">id: {{ $user->id }}</h5>


                    <div class="mb-3 d-flex flex-column">
                        <img src="{{ asset($user->avatar) }}" alt="" id="image">
                        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*"
                            onchange="previewImage(event)">
                    </div>


                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="name">Name: <sup
                                class="text-danger">*</sup></label>
                        <div class="ms-5"> <input type="text" class="form-control" name="name"
                                value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="email">Email: <sup
                                class="text-danger">*</sup></label>
                        <div class="ms-5"> <input type="text" class="form-control" name="email"
                                value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="address">address:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="address"
                                value="{{ $user->address }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="phone_number">Phone number:</label>
                        <div class="ms-5"> <input type="text" class="form-control" name="phone_number"
                                value="{{ $user->phone_number }}">
                        </div>
                    </div>
                    <div class="lh-lg">
                        <label class="text-capitalize fw-bold" for="country_id">
                            Country: <sup class="text-danger">*</sup>
                        </label>
                        <div class="ms-5">
                            <select name="country_id" id="country_id" class="form-control">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected($country->id == $user->country->id)>{{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="resetPassword" tabindex="-1" aria-labelledby="resetPasswordLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resetPasswordLabel">Reset Password </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addressForm" action="{{ route('reset-password') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="address" class="form-label">Now Password</label>
                                <input type="password" class="form-control" name="now_password"
                                    value="{{ old('now_password', '') }}" placeholder="Enter now password">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password"
                                    value="{{ old('new_password', '') }}" placeholder="Enter new password">
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Confirmation</label>
                                <input type="password" class="form-control" name="new_password_confirmation"
                                    value="{{ old('confirmation', '') }}" placeholder="Enter confirmation">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        //choose file 
        async function fetchImage(url) {
            const response = await fetch(url);
            const blob = await response.blob();
            const file = new File([blob], '{{ basename($user->avatar) }}', {
                type: blob.type
            });
            return file;
        }
        async function setImageInput(url) {
            const file = await fetchImage(url);
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            const inputElement = document.getElementById('avatar');
            inputElement.files = dataTransfer.files;
        }
        setImageInput('{{ asset($user->avatar) }}');

        //show image
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('image').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
