@extends('layouts.app')

@section('title', 'Profile')
@section('content')
    <main class="container-fluid bg-grey">
        @include('include.showAlert')
        <div class="contrainer">
            <div class="d-flex px-4 justify-content-between align-items-center">
                <div class="h1">Customer details</div>
                <div>
                    <button class="btn btn-light fw-bold text-danger border" style="width: 200px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path
                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                        </svg> Delete
                    </button>
                    <button class="btn btn-light fw-bold border" style="width: 200px;" data-bs-toggle="modal"
                        data-bs-target="#resetPassword">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-key-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg> Reset Password
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 d-flex flex-column">
                    <div class="p-3">
                        <div class="border rounded-4 p-4 bg-white">
                            <div class="d-flex gap-4">
                                <img src="{{ asset($user->avatar) }}" alt="avatar" width="150" height="150">
                                <div>
                                    <div class="h2 fw-bold">
                                        {{ $user->name }}
                                        <button class="h2 fw-bold btn px-3 text-success" data-bs-toggle="modal"
                                            data-bs-target="#updateNameUser">
                                            Edit
                                        </button>
                                    </div>
                                    <div>
                                        Joined
                                        @if (now()->diffInYears($user->created_at) != 0)
                                            {{ now()->diffInYears($user->created_at) }} years ago
                                        @elseif (now()->diffInMonths($user->created_at) != 0)
                                            {{ now()->diffInMonths($user->created_at) }} months ago
                                        @elseif (now()->diffInDays($user->created_at) != 0)
                                            {{ now()->diffInDays($user->created_at) }} days ago
                                        @elseif (now()->diffInHours($user->created_at) != 0)
                                            {{ now()->diffInHours($user->created_at) }} hours ago
                                        @else
                                            {{ now()->diffInMinutes($user->created_at) ?? 0 }} munites ago
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div>
                                <hr>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>Total Spent</div>
                                    <div class="h4 ">${{ $orders->sum('total') ?? 0 }}</div>
                                </div>
                                <div>
                                    <div>Last Order</div>
                                    <div class="h4">
                                        @if ($orders->isEmpty())
                                            No orders yet
                                        @elseif (now()->diffInYears($orders->max('created_at')) != 0)
                                            {{ now()->diffInYears($orders->max('created_at')) }} years ago
                                        @elseif (now()->diffInMonths($orders->max('created_at')) != 0)
                                            {{ now()->diffInMonths($orders->max('created_at')) }} months ago
                                        @elseif (now()->diffInDays($orders->max('created_at')) != 0)
                                            {{ now()->diffInDays($orders->max('created_at')) }} days ago
                                        @elseif (now()->diffInHours($orders->max('created_at')) != 0)
                                            {{ now()->diffInHours($orders->max('created_at')) }} hours ago
                                        @else
                                            {{ now()->diffInMinutes($orders->max('created_at')) ?? 0 }} munites ago
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div>Total Orders</div>
                                    <div class="h4 text-end">{{ $orders->count() ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex flex-column">
                    <div class="p-3 h-100">
                        <div class="border rounded-4 p-4 d-flex flex-column justify-content-between h-100 bg-white">
                            <div class="fw-bold h4">
                                Default Address
                                <button class="h2 fw-bold btn px-3 text-success" data-bs-toggle="modal"
                                    data-bs-target="#updateAddressUser">
                                    Edit
                                </button>
                            </div>
                            <div>
                                <div class="fw-bold">Address</div>
                                <div>
                                    {{ $user->address }}
                                </div>
                            </div>
                            <div>
                                <div class="fw-bold">Email</div>
                                <div>{{ $user->email }}</div>
                            </div>
                            <div>
                                <div class="fw-bold">Phone</div>
                                <div>{{ $user->phone_number }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 fs-4">
                <strong>Orders</strong>
                <small class="text-secondary">({{ $orders->count() }})</small>
            </div>
            <div class="p-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ORDER</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">DELIVERY METHOD</th>
                            <th scope="col">DATE</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col">VIEW</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="small">
                                <th scope="row">
                                    <div class="text-info">
                                        #{{ $order->id }}
                                    </div>
                                </th>
                                <td>
                                    <div class="p-1 rounded-3 fw-bold 
                                    @switch($order->status)
                                        @case('pending')
                                            bg-info text-white
                                            @break
                                        @case('processing')
                                            bg-primary text-white
                                            @break
                                        @case('shipping')
                                            bg-warning text-white
                                            @break
                                        @case('shipped')
                                            bg-success text-white
                                            @break
                                        @case('canceled')
                                            bg-danger text-white
                                            @break
                                    @endswitch"
                                        style="width: fit-content">
                                        {{ $order->status }}
                                    </div>
                                </td>
                                <td>
                                    {{ $order->delivery_method }}
                                </td>
                                <td>
                                    {{ $order->created_at }}
                                </td>
                                <td class="fw-semibold">
                                    ${{ $order->total }}
                                </td>
                                <td>
                                    <a href="{{ route('order', ['id' => $order->id]) }}" style="color:purple">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                            fill="currentColor" class="bi bi-eyeglasses" viewBox="0 0 16 16">
                                            <path
                                                d="M4 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4m2.625.547a3 3 0 0 0-5.584.953H.5a.5.5 0 0 0 0 1h.541A3 3 0 0 0 7 8a1 1 0 0 1 2 0 3 3 0 0 0 5.959.5h.541a.5.5 0 0 0 0-1h-.541a3 3 0 0 0-5.584-.953A2 2 0 0 0 8 6c-.532 0-1.016.208-1.375.547M14 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-4 fs-4">
                <strong>Ratings & reviews</strong>
                <small class="text-secondary">({{ $reviews->count() ?? 0 }})</small>
            </div>
            <div class="p-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">PRODUCT</th>
                            <th scope="col">RATING</th>
                            <th scope="col">REVIEW</th>
                            <th scope="col">DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr class="small">
                                <th scope="row">
                                    <img src="{{ $review->product->image }}" alt="" height="40" width="40">
                                </th>
                                <td class="text-truncate" style="min-width: 200px;">
                                    <a class="text-info"
                                        href="">{{ $review->product->code . ' - ' . $review->product->name }}</a>
                                </td>
                                <td class="text-warning" style="min-width: 120px;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->star)
                                            <svg class="text-warning" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-star-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        @else
                                            <svg class="text-warning" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-star"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </td>
                                <td class="small text-wrap">
                                    {{ $review->review }}
                                <td style="min-width: 150px;">{{ $review->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="updateNameUser" tabindex="-1" aria-labelledby="updateNameUserLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateNameUserLabel">Edit Name </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="nameForm" action="{{ route('update-name-user') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter name" value="{{ $user->name }}" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateAddressUser" tabindex="-1" aria-labelledby="updateAddressUserLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateAddressUserLabel">Edit Default Address </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addressForm" action="{{ route('update-address-user') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ $user->address }}"
                                    placeholder="Enter address" value="">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->email }}"
                                    placeholder="Enter email">
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone_number"
                                    value="{{ $user->phone_number }}" placeholder="Enter phone">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
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
@endsection
