@extends('layouts.admin')

@section('content')
    <main class="container">
        <h1>Edit User - Id: {{ $user->id }}</h1>
        @include('include.showAlert')
        <form method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Username<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email<sup class="text-danger">*</sup></label>
                <input type="email" class="form-control" id="email" name="email" required
                    value="{{ $user->email }}">
            </div>
            <div class="mb-3 d-flex flex-column gap-4">
                <label for="avatar" class="form-label">Avatar</label>
                <img src="{{ asset($user->avatar) }}" alt="" id="image" height="100" width="100">
                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*"
                    onchange="previewImage(event)">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="email" name="address" value="{{ $user->address }}">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                    value="{{ $user->phone_number }}">
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="role" class="form-label">Role<sup class="text-danger">*</sup></label>
                    <select class="form-select" id="role" name="role">
                        <option @selected($user->status === 'customer') value="customer">Customer</option>
                        <option @selected($user->status === 'admin') value="admin">Admin</option>
                        <option @selected($user->status === 'supplier') value="supplier">Supplier</option>
                        <option @selected($user->status === 'writer') value="writer">Writer</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="country_id" class="form-label">Country<sup class="text-danger">*</sup></label>
                    <select class="form-select" id="country_id" name="country_id">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
        </form>
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
