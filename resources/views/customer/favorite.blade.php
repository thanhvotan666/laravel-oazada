@extends('layouts.app')

@section('title',  request()->getHost() .' - Favorites')
@section('content')
    <main class="container-fluid py-4 bg-grey">
        <div class="container">
            <h1>Favorites <small class="small text-secondary">({{ count($favorites) }})</small></h1>
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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-hover m-0">
                <thead>
                    <tr class="table-warning">
                        <th scope="col"></th>
                        <th scope="col">PRODUCTS</th>
                        <th scope="col">VARIANT</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">STOCK</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($favorites as $favorite)
                        <tr class="small">
                            <th class="text-secondary" scope="row">
                                <img src="{{ $favorite->productVariant->product->image }}" alt="" width="50"
                                    height="50">
                            </th>
                            <td class="text-truncate" style="max-width:300px;">
                                <a href="{{ route('product', ['id' => $favorite->productVariant->product->id]) }}"
                                    class="link-info link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                                    {{ $favorite->productVariant->product->code }} -
                                    {{ $favorite->productVariant->product->name }}
                                </a>
                            </td>
                            <td class="">{{ $favorite->productVariant->options->pluck('value')->join(', ') }}</td>
                            <td>${{ $favorite->productVariant->price }} </td>
                            <td>{{ $favorite->productVariant->stock }}</td>
                            <td>
                                <form action="{{ route('remove-out-favorite', ['id' => $favorite->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('add-to-cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="quantity" id='form_quantity' value="1">
                                    <input type="hidden" name="product_id" id='form_product_id'
                                        value="{{ $favorite->productVariant->product->id }}">
                                    <input type="hidden" name="options" id='form_options'
                                        value="{{ $favorite->productVariant->options->pluck('value')->join(',') }}">
                                    <button type="submit" class="btn btn-orange fw-bold">
                                        Add to Cart
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
