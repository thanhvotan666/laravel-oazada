@extends('layouts.admin')
@section('title', request()->getHost() . ': Admin - User - Create')
@section('content')

    <div class="container">
        <h1>Create User</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Username<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email<sup class="text-danger">*</sup></label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password<sup class="text-danger">*</sup></label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu<sup
                        class="text-danger">*</sup></label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="email" name="address">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="role" class="form-label">Role<sup class="text-danger">*</sup></label>
                    <select class="form-select" id="role" name="role">
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                        <option value="supplier">Supplier</option>
                        <option value="supplier">Writer</option>
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
                <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
@endsection
