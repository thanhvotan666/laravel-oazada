@extends('layouts.admin')

@section('title', 'Supplier edit')
@section('content')

    <div class="container">
        <h1>Edit Supplier</h1>
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
        <form method="POST" action="{{ route('admin.suppliers.update', ['supplier' => $supplier->id]) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="name" name="name" required
                    value="{{ $supplier->name }}">
            </div>
            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name"
                    value="{{ $supplier->company_name }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $supplier->email }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $supplier->address }}">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                    value="{{ $supplier->phone_number }}">
            </div>
            <div class="mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ $supplier->website }}">
            </div>

            <div class="mb-3">
                <label for="tax_code" class="form-label">Tax Code</label>
                <input type="text" class="form-control" id="tax_code" name="tax_code" value="{{ $supplier->tax_code }}">
            </div>
            <div class="mb-3">
                <label for="bank_account_number" class="form-label">Bank Account Number</label>
                <input type="text" class="form-control" id="bank_account_number" name="bank_account_number"
                    value="{{ $supplier->bank_account_number }}">
            </div>
            <div class="mb-3">
                <label for="bank_name" class="form-label">Bank Name</label>
                <input type="text" class="form-control" id="bank_name" name="bank_name"
                    value="{{ $supplier->bank_name }}">
            </div>

            <div class="mb-3">
                <label for="contact_person" class="form-label">Contact Person</label>
                <input type="text" class="form-control" id="contact_person" name="contact_person"
                    value="{{ $supplier->contact_person }}">
            </div>
            <div class="mb-3">
                <label for="contact_title" class="form-label">Contact Title</label>
                <input type="text" class="form-control" id="contact_title" name="contact_title"
                    value="{{ $supplier->contact_title }}">
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">User<sup class="text-danger">*</sup></label>
                <select class="form-select" id="user_id" name="user_id">
                    <option value="{{ $supplier->user->id }}" selected>{{ $supplier->user->name }}</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
