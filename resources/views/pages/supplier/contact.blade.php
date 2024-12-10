@extends('layouts.app')

@section('title', request()->getHost() . 'Contact to ' . $supplier->name)
@section('content')
    @if (!auth()->check())
        <h2 class="container-fluid text-center text-danger" style="height:600px">You need to login to continue!</h2>
    @endif
    @auth

        <form class="container my-5" method="POST" action="{{ route('check-supplier-contacts') }}">
            @csrf
            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
            <div class="d-flex flex-column gap-3">
                <div class="d-flex gap-3">
                    <div><img src="image/logo.png" alt="" height="50px"></div>
                    <div class="h1">Contact supplier</div>
                </div>
                @include('include.showAlert')
                <div class="bg-grey rounded-5 p-5">
                    <div class="d-flex flex-wrap gap-4 h4 mb-3">
                        <div>
                            To:
                            <img src="{{ asset($supplier->user->country->image) }}" alt="{{ $supplier->name }}" height="20">
                            {{ $supplier->name }}
                        </div>
                        <div>{{ $supplier->address }} </div>
                    </div>
                    <div class="container-fluid bg-white p-5 rounded-5 d-flex flex-column gap-4"
                        style="box-shadow: 0px 2px 2px 3px rgba(0, 0, 0, 0.5);">
                        <div class="h4">* Detailed requirements: </div>
                        <div>Enter product details such as color, size, materials etc. and other specification requirements
                            to receive an accurate quote.</div>
                        <div class="w-100">
                            <textarea class="w-100" name="requirement" id="requirement" rows="6" placeholder="Please type in " required>{{ old('requirement', '') }}</textarea>
                        </div>
                        <div class="p-4 bg-grey lh-lg">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-lightbulb-fill" viewBox="0 0 16 16" style="color: orange;">
                                    <path
                                        d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5" />
                                </svg>
                                Check out these questions from other buyers. Click to insert the questions in the box above.
                            </div>
                            <div class="d-flex px-4 gap-3 justify-content-between">
                                <div class="btn btn-light rounded-pill"
                                    onclick="document.getElementById('requirement').value += this.textContent.trim()+'\n';">
                                    What is the best price you can offer? </div>
                                <div class="btn btn-light rounded-pill"
                                    onclick="document.getElementById('requirement').value += this.textContent.trim()+'\n';">
                                    What is the shipping cost? </div>
                                <div class="btn btn-light rounded-pill"
                                    onclick="document.getElementById('requirement').value += this.textContent.trim()+'\n';">
                                    Do you support costumization? </div>
                                <div class="btn btn-light rounded-pill"
                                    onclick="document.getElementById('requirement').value += this.textContent.trim()+'\n';">
                                    How long will it take to ship my country?</div>
                            </div>
                        </div>
                        <div class="h3" style="color: orange;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-share" viewBox="0 0 16 16">
                                <path
                                    d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3" />
                            </svg>
                            Add attachment
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <input class="btn btn-orange fw-bold fs-3 px-5 rounded-pill" type="submit" value="Send inquiry now">
                </div>
                <div>
                    <input type="checkbox" name="recommend" id="recommend" value="{{ old('recommend', 0) }}"
                        onchange="this.value = this.checked?1:0" @checked(old('recommend'))>
                    Recommend matching suppliers if this supplier doesn't contact me on Message Center within 24 hours. RFQ
                </div>
                <div>
                    <input type="checkbox" name="business_card" id="business_card" value="{{ old('business_card', 0) }}"
                        onchange="this.value = this.checked?1:0" @checked(old('business_card'))>
                    Agree to share <strong>Business Card</strong> with supplier.
                </div>
                <div>
                    Please make sure your contact information is correct (<a href="{{ route('profile') }}"
                        style="color: blue;">View and Edit</a>). Your
                    message will
                    be sent directly to the
                    recipient(s) and will not be publicly
                    displayed. Note that if the recipient is a Gold Supplier, they can view your contact information,
                    including your registered email address. Alibaba will never
                    distribute or sell your personal information to third parties without your express permission.
                </div>
            </div>
        </form>
    @endauth
@endsection
