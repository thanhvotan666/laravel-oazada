@extends('layouts.admin')

@section('title', 'Product show')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($product->is_variant == 1)
            <h6>
                <h1 class="d-inline-block">Product Details </h1>
                <a class="text-warning" href="{{ route('admin.products.edit', ['product' => $product->id]) }}">Edit</a>
            </h6>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail rounded-4"
                        style="">
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Code: </th>
                                <td>{{ $product->code }}</td>
                            </tr>
                            <tr>
                                <th>Name: </th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>Description: </th>
                                <td>{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <th>Category: </th>
                                <td>{{ $product->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Supplier: </th>
                                <td>{{ $product->supplier->name }}</td>
                            </tr>
                            <tr>
                                <th>Hidden: </th>
                                <td>{{ $product->hidden = 1 ? 'Hidden' : 'Unhiden' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Variants</th>
                            <th>Price</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->variants as $productVariant)
                            <tr>
                                <td>{{ $productVariant->id }}</td>
                                <td>
                                    <img src="{{ asset($productVariant->image) }}" alt="{{ $productVariant->name }}"
                                        height="100" class="rounded">
                                </td>
                                <td>{{ $productVariant->options->pluck('value')->join(', ') }}</td>
                                <td>${{ $productVariant->price }}</td>
                                <td>{{ $productVariant->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
        @endif

    </div>
@endsection
