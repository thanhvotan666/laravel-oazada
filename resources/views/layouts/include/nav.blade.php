<nav class="navbar navbar-expand-lg navbar-top">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ route('index') }}"><img src="{{ asset('storage/image/logo.png') }}"
                alt="Logo" style="height: 40px;"></a>
        <!-- Search Bar -->
        <form action="{{ route('search.index') }}" id="search-bar" class="input-group mx-3"
            style="min-width: 350px; width: 100%; max-width: 500px; border-radius: 50px; border: 1px solid #ccc; overflow: hidden;">

            <!-- Dropdown for Products -->
            <div class="d-flex" style="width: 150px;">
                <select class=" form-select form-select-sm btn btn-light border-end border-0"
                    aria-label=".form-select-lg example">
                    <option value="1" selected>Products</option>
                </select>
            </div>

            <!-- Text Input -->
            <input type="text" class="form-control border-0" name="name" placeholder="new phone 2024"
                aria-label="Search" style="border-radius: 0;">

            <!-- Camera Icon -->
            <span class="input-group-text bg-white border-0" style="cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-camera-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                    <path
                        d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0" />
                </svg>
            </span>

            <!-- Search Button -->
            <span class="input-group-text bg-white border-0" style="cursor: pointer;">
                <button class="btn text-white rounded-pill" type="submit" style="background-color: #ff6600;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                    Search
                </button>
            </span>
        </form>
        <!--edit-->
        <!-- Right-side Options  -->
        <div class="d-flex align-items-center gap-3">
            <!-- Location edit -->
            <div class="dropdown" style="float:right;">
                <div class=" text-decoration-none">
                    <div class="small text-change">Deliver to:</div>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/image/country/Vietnam.png') }}" alt="Vietnam Flag"
                            style="height: 20px;" class="me-1">
                        <span class="text-change">VN</span>
                    </div>
                </div>
                <div class="dropdown-content lh-lg p-4" style="z-index: 30">
                    <div>
                        <div class="">
                            <div class="fw-bold ">Specify your location</div>
                            <div>Shipping options and frees vary based on your
                                location</div>
                        </div>
                    </div>
                    <a href="" class="btn btn-orange d-flex rounded-pill justify-content-center">Add
                        address</a>
                    <hr>
                    <div class="d-flex flex-column gap-4">
                        <select name="" id="" class="p-2 d-flex rounded-3">
                            <option value="vietnam">
                                <div>
                                    Viet Nam
                                </div>
                            </option>
                            <option value="america">America</option>
                        </select>
                        <input type="text" placeholder="Postal code 701000" class="d-flex rounded-3 border border-3">
                    </div>
                    <div class="pt-4">
                        <a href="" class="btn btn-orange d-flex rounded-pill justify-content-center">Save</a>
                    </div>
                </div>
            </div>
            <!-- Language edit -->
            <div class="dropdown" style="float:right;">
                <!--edit-->
                <a href="#" class="text-change text-decoration-none">
                    <img src="{{ asset('storage/image/icon/earth-icon.png') }}" alt="Language"
                        style="filter: invert(100%);">
                    English-USD
                </a>
                <div class="dropdown-content lh-lg p-4" style="z-index: 30">
                    <div href="#">
                        <div>
                            <div class="fw-bold">Set language and currency</div>
                            <div>Select your preferrend language and currency.</div>
                            <div>You can update the settings at any time.</div>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="language">Language</label>
                        <select name="language" id="language" class="p-2 rounded-3">
                            <option value="English">English</option>
                            <option value="Vietnam">Vietnam</option>
                        </select>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="currency">Currency</label>
                        <select name="currency" id="currency" class="p-2 rounded-3">
                            <option value="USD">USD - US Dollar</option>
                            <option value="VND">VND - Viet Nam Dong</option>
                        </select>
                    </div>
                    <a href="#">
                        <a class="btn btn-orange d-flex rounded-pill justify-content-center">Save</a>
                    </a>
                </div>
            </div>
            <!-- Messages -->
            <div class="dropdown" style="float:right;">
                <!--edit-->
                <a href="#" class="dropbtn text-change" onclick="showMessenger()"><img
                        src="{{ asset('storage/image/icon/message-icon.png') }}" alt="Message"
                        style="filter: invert(100%);"></a>
                <div class="dropdown-content lh-lg p-4" style="z-index: 30">
                    <div href="#">
                        <div>
                            <div class="fw-bold">Messages</div>
                            <div></div>
                        </div>
                    </div>
                    <a href="#">
                        <a href="" class="btn d-flex rounded-pill justify-content-center btn-orange">View
                            details</a>
                    </a>
                </div>
            </div>
            <!-- Orders -->
            <div class="dropdown" style="float:right;">
                <a href="{{ route('orders') }}" class="dropbtn text-change"><img
                        src="{{ asset('storage/image/icon/bill-icon.png') }}" alt="Bill"
                        style="filter: invert(100%);"></a>
                <div class="dropdown-content" style="z-index: 30">
                    <div class="p-4 fw-bold">Orders</div>
                    <div class="px-4 fs-4 fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                            class="bi bi-piggy-bank-fill" viewBox="0 0 16 16" style="color: #ff6600;">
                            <path
                                d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595m7.173 3.876a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199m-8.999-.65a.5.5 0 1 1-.276-.96A7.6 7.6 0 0 1 7.964 3.5c.763 0 1.497.11 2.18.315a.5.5 0 1 1-.287.958A6.6 6.6 0 0 0 7.964 4.5c-.64 0-1.255.09-1.826.254ZM5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0" />
                        </svg>
                        Trade Assurance
                    </div>
                    <div class="px-4 d-flex align-items-center">
                        <div><img src="{{ asset('storage/image/icon/defender.svg') }}" alt="Safe & easy payments"
                                width="30px">
                        </div>
                        <div>Safe & easy payments</div>
                    </div>
                    <div class="px-4 d-flex align-items-center">
                        <div><img src="{{ asset('storage/image/icon/money-circle.svg') }}" alt="Safe & easy payments"
                                width="30px">
                        </div>
                        <div>Money - back policy</div>
                    </div>
                    <div class="px-4 d-flex align-items-center">
                        <div><img src="{{ asset('storage/image/icon/shipping.svg') }}" alt="Safe & easy payments"
                                width="30px">
                        </div>
                        <div>Shipping & logistics services</div>
                    </div>
                    <div class="px-4 d-flex align-items-center">
                        <div><img src="{{ asset('storage/image/icon/colet.svg') }}" alt="Safe & easy payments"
                                width="30px">
                        </div>
                        <div>After sales protections</div>
                    </div>
                    <!--edit-->
                    <a href="#" class="text-secondary">Learn more</a>
                </div>
            </div>
            <!-- Cart -->
            <div class="dropdown" style="float:right;">
                <a href="{{ route('cart') }}" class="dropbtn text-change">
                    <img src="{{ asset('storage/image/icon/cart-icon.png') }}" alt="Cart"
                        style="filter: invert(100%);">
                </a>
                <div class="dropdown-content" style="z-index: 30" id='resultHeaderCart'>

                </div>
            </div>
            <!-- Avatar -->
            <div class="dropdown" style="float:right;">
                <div class="dropbtn btn text-change">
                    <img src="{{ asset('storage/image/icon/avatar-icon.png') }}" alt="Avatar"
                        style="filter: invert(100%);">
                </div>
                @if (auth()->check())
                    <div class="dropdown-content fw-bold" style="z-index: 30">
                        <a href="#">
                            Hi, {{ auth()->user()->name }}
                            <hr>
                        </a>
                        <a href="{{ route('cart') }}">Cart</a>
                        <a href="{{ route('orders') }}">Orders</a>
                        <a href="{{ route('favorite') }}">Favorite</a>
                        <a href="{{ route('profile') }}">
                            Account
                            <hr>
                        </a>
                        <a href="{{ route('logout') }}">
                            <div class="text-muted">Sign out</div>
                        </a>
                    </div>
                @else
                    <div class="dropdown-content fw-bold" style="z-index: 30">
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-bottom d-flex flex-column m-0 p-0">
    <div class="container-fluid" style="position: relative;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-change" id="navbarNavDarkDropdown">
            <ul class="navbar-nav w-100 justify-content-between">
                <li class="nav-item">
                    <div class="nav-link d-flex ">
                        <div class="nav-link event-nav text-dark">
                            <span class="navbar-toggler-icon"></span>
                            All categories
                        </div>
                        <div class="nav-link event-nav text-dark">
                            Featured selections
                        </div>
                        <div class="nav-link event-nav text-dark">
                            Trade Assurance
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <div class="nav-link d-flex ">
                        <div class="nav-link event-nav text-dark">
                            Buyer Central
                        </div>
                        <div class="nav-link event-nav text-dark">
                            Help Center
                        </div>
                        <div class="nav-link event-nav text-dark">
                            Get the app
                        </div>
                        <div class="nav-link text-dark">
                            <!--edit-->
                            <a href="">Become a suppiler</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- All caterogies -->
    <div id="all-categories" class="container-fluid d-none block-drop bg-white"
        style="position: absolute;top: 100%;z-index: 20">
        <div class="row lh-lg" style="width: 100%;">
            <!-- Cột đầu tiên: Mục chính -->
            <div class="col-md-3 category-list border">
                @foreach ($categoryTypes as $categoryType)
                    <div class="categoryTypeHeader @if ($categoryType->id == $categoryTypes[0]->id) fw-bold bg-grey @endif"
                        id='categoryTypeHeader{{ $categoryType->id }}'
                        onmouseover="loadTimeOutDHC({{ $categoryType->id }})">
                        {{ $categoryType->name }}
                    </div>
                @endforeach
            </div>

            <!-- Cột thứ hai: Mục phụ -->
            <div class="col-md-4 subcategory-list border" id="resultHeaderCategory">
            </div>

            <!-- Cột thứ ba: Mục phụ nữa -->
            <div class="col-md-5 sub-subcategory-list border" id="resultHeaderProduct">
            </div>
        </div>
    </div>
    <!-- Featured selections -->
    <div id="featured-selections" class="container-fluid d-none block-drop bg-white"
        style="position: absolute;top: 100%;z-index: 20">
        <div class="row gap-3 py-5" style="border-top: 2px solid black ;width: 100%;">
            <div class="col-md-8 row justify-content-center gap-3">
                <div class="col-xxl-3">
                    <a href=""
                        class="border border-3 border-dark d-flex flex-column justify-content-center align-items-center"
                        style="width: 250px; height: 150px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                            class="bi bi-award" viewBox="0 0 16 16">
                            <path
                                d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z" />
                            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z" />
                        </svg>
                        <div>Top ranking</div>
                    </a>
                </div>
                <div class="col-xxl-3">
                    <a href=""
                        class="border border-3 border-dark d-flex flex-column justify-content-center align-items-center"
                        style="width: 250px; height: 150px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                            class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            <path
                                d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                        </svg>
                        <div>New arrivals</div>
                    </a>
                </div>
                <div class="col-xxl-3">
                    <a href=""
                        class="border border-3 border-dark d-flex flex-column justify-content-center align-items-center"
                        style="width: 250px; height: 150px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                            class="bi bi-tag" viewBox="0 0 16 16">
                            <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0" />
                            <path
                                d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1m0 5.586 7 7L13.586 9l-7-7H2z" />
                        </svg>
                        <div>Saving spotlight</div>
                    </a>
                </div>
            </div>
            <div class="col-md-3" style="border-left: 2px solid black;">
                <ul style="list-style-type: none; line-height: 40px;">
                    <li>Sample Center</li>
                    <li>Online Trade Show </li>
                    <li>Tips</li>
                    <li>LIVE</li>
                    <li>Global suppliers </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Trade Assurance -->
    <div id="trade-assurance" class="container-fluid d-none block-drop bg-white"
        style="position: absolute;top: 100%;z-index: 20">
        <div class="d-flex py-5" style="border-top: 2px solid black ;width: 100%;">
            <div class="lh-lg px-5" style="width: 50%;">
                <div class="fs-2 fw-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                        class="bi bi-piggy-bank-fill" viewBox="0 0 16 16" style="color: #ff6600;">
                        <path
                            d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595m7.173 3.876a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199m-8.999-.65a.5.5 0 1 1-.276-.96A7.6 7.6 0 0 1 7.964 3.5c.763 0 1.497.11 2.18.315a.5.5 0 1 1-.287.958A6.6 6.6 0 0 0 7.964 4.5c-.64 0-1.255.09-1.826.254ZM5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0" />
                    </svg>
                    Trade Assurance
                </div>
                <div class="fs-1 fw-bold">
                    Enjoy protection from paument to
                    delivery.
                </div>
                <a class="fw-bold btn text-white rounded-pill px-5" style="background-color: #ff6600;">
                    Learn more
                </a>
            </div>
            <div class="row gap-5" style="width: 50%;">
                <div class="col-sm-5 bg-grey justify-content-between align-items-center rounded-4 d-flex fw-bold">
                    <div class="rounded-circle justify-content-center align-items-center d-flex"
                        style="width: 60px;height: 60px;">
                        <img src="{{ asset('storage/image/icon/defender.svg') }}" alt="Safe & easy payments">
                    </div>
                    <div>Safe & easy payments</div>
                    <div class="text-end ps-2" style="font-size: 50px;">&rarr;</div>
                </div>
                <div class="col-sm-5 bg-grey justify-content-between align-items-center rounded-4 d-flex fw-bold">
                    <div class="rounded-circle justify-content-center align-items-center d-flex"
                        style="width: 60px;height: 60px;">
                        <img src="{{ asset('storage/image/icon/money-circle.svg') }}" alt="Safe & easy payments">
                    </div>
                    <div>Money - back policy</div>
                    <div class="text-end ps-2" style="font-size: 50px;">&rarr;</div>
                </div>
                <div class="col-sm-5 bg-grey justify-content-between align-items-center rounded-4 d-flex fw-bold">
                    <div class="rounded-circle justify-content-center align-items-center d-flex"
                        style="width: 60px;height: 60px;">
                        <img src="{{ asset('storage/image/icon/shipping.svg') }}" alt="Safe & easy payments">
                    </div>
                    <div>Shipping & logistics services</div>
                    <div class="text-end ps-2" style="font-size: 50px;">&rarr;</div>
                </div>
                <div class="col-sm-5 bg-grey justify-content-between align-items-center rounded-4 d-flex fw-bold">
                    <div class="rounded-circle justify-content-center align-items-center d-flex"
                        style="width: 60px;height: 60px;">
                        <img src="{{ asset('storage/image/icon/colet.svg') }}" alt="Safe & easy payments">
                    </div>
                    <div>After sales protections</div>
                    <div class="text-end ps-2" style="font-size: 50px;">&rarr;</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Buyer Central -->
    <div id="buyer-central" class="container-fluid d-none block-drop bg-white"
        style="position: absolute;top: 100%;z-index: 20">
        <div class="d-flex py-5" style="border-top: 2px solid black ;width: 100%;">
            <div class="d-flex flex-wrap justify-content-between lh-lg gap-5" style="width: 100%;">
                <div class="col-md-2 d-flex flex-column">
                    <div><a href=""><strong>Get started</strong></a></div>
                    <div><a href="">What is OAZADA.com </a></div>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <div><a href=""><strong>Why OAZADA.com</strong></a></div>
                    <div><a href="">What is OAZADA.com </a></div>
                    <div><a href="">Membership program </a></div>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <div><a href=""><strong>Trade services</strong></a></div>
                    <div><a href="">Trade Assurance </a></div>
                    <div><a href="">Logistics Services </a></div>
                    <div><a href="">Letter of Credit </a></div>
                    <div><a href="">Produc tion monitoring & inspection services </a></div>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <div><a href=""><strong>Resources</strong></a></div>
                    <div><a href="">Success stories </a></div>
                    <div><a href="">Blogs </a></div>
                    <div><a href="">Industry reports </a></div>
                    <div><a href="">Help Center </a></div>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <div><a href=""><strong>Webinars</strong></a></div>
                    <div><a href="">Overview </a></div>
                    <div><a href="">Meet the peers </a></div>
                    <div><a href="">Ecommerce Acedamy </a></div>
                    <div><a href="">How to source on OAZADA.com </a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Help center -->
    <div id="help-center" class="container-fluid d-none block-drop bg-white"
        style="position: absolute;top: 100%;z-index: 20">
        <div class="row gap-3 py-5" style="border-top: 2px solid black ;width: 100%;">
            <div class="col-md-8 d-flex justify-content-around gap-3">
                <div class="">
                    <a href=""
                        class="border border-3 border-dark d-flex flex-column justify-content-center align-items-center"
                        style="width: 250px; height: 150px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                            class="bi bi-person-workspace" viewBox="0 0 16 16">
                            <path
                                d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                            <path
                                d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z" />
                        </svg>
                        <div>For buyers</div>
                    </a>
                </div>
                <div class="">
                    <a href=""
                        class="border border-3 border-dark d-flex flex-column justify-content-center align-items-center"
                        style="width: 250px; height: 150px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                            class="bi bi-buildings" viewBox="0 0 16 16">
                            <path
                                d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
                            <path
                                d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z" />
                        </svg>
                        <div>For suppliers</div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 d-flex flex-column justify-content-around ps-5"
                style="border-left: 2px solid black;">
                <a href="">Open a dispute</a>
                <a href="">Repost IPR infringement </a>
                <a href="">Report abuse</a>
            </div>
        </div>
    </div>
    <!-- Get the app -->
    <div id="get-the-app" class="container-fluid d-none block-drop bg-white"
        style="position: absolute;top: 100%;z-index: 20">
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-3 py-5"
            style="border-top: 2px solid black ;width: 100%;">
            <div class="lh-lg col-md-3">
                <div class="fw-bold">Get the OAZADA.comm app</div>
                <div>Find products, communicate with suppliers, and manage and
                    pay for your orders with the Alibaba.com app anytime,
                    anywhere.</div>
                <div><a href="" class="text-muted">Learn more</a></div>
            </div>
            <div class="d-flex flex-column">
                <a href=""><img src="{{ asset('storage/image/temp/app-store.png') }}" alt="app-store"
                        height="100"></a>
                <a href=""><img src="{{ asset('storage/image/temp/ch-play.png') }}" alt="ch-play"
                        height="100"></a>
            </div>
            <div>
                <img src="{{ asset('storage/image/temp/QR.png') }}" alt="" width="220" height="220">
            </div>
        </div>
    </div>
</nav>
