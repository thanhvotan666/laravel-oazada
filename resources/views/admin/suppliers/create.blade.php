@extends('layouts.admin')

@section('title',  request()->getHost() .' - Admin - Supplier create')
@section('content')

    <div class="container">
        <h1>Create Supplier</h1>
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
        <form method="POST" action="{{ route('admin.suppliers.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="name" name="name" required value="Shop name">
            </div>
            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="Company name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="email@gmail.com">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="Address">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="0912312345">
            </div>
            <div class="mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="text" class="form-control" id="website" name="website" value="website.com">
            </div>

            <div class="mb-3">
                <label for="tax_code" class="form-label">Tax Code</label>
                <input type="text" class="form-control" id="tax_code" name="tax_code" value="tax-code">
            </div>
            <div class="mb-3">
                <label for="bank_account_number" class="form-label">Bank Account Number</label>
                <input type="text" class="form-control" id="bank_account_number" name="bank_account_number"
                    value="Bank Account Number">
            </div>
            <div class="mb-3">
                <label for="bank_name" class="form-label">Bank Name</label>
                <input type="text" class="form-control" id="bank_name" name="bank_name" value="Bank Name">
            </div>

            <div class="mb-3">
                <label for="contact_person" class="form-label">Contact Person</label>
                <input type="text" class="form-control" id="contact_person" name="contact_person" value="Contact Person">
            </div>
            <div class="mb-3">
                <label for="contact_title" class="form-label">Contact Title</label>
                <input type="text" class="form-control" id="contact_title" name="contact_title" value="Contact Title">
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">User<sup class="text-danger">*</sup></label>
                <select class="form-select" id="user_id" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create supplier</button>
        </form>
    </div>
@endsection
