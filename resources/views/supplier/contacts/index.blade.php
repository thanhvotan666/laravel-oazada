@extends('layouts.supplier')

@section('title', 'Contacts')
@section('content')
    <div class="container-fluid d-flex flex-column gap-4 ">
        <div class="p-5 d-flex flex-column gap-4">
            <div class="d-flex justify-content-between">
                <div class="h2 fw-bold ">
                    Orders
                </div>

                <div></div>
                {{-- <a class="h2 fw-bold btn btn-success px-3">
                    Add
                </a> --}}
            </div>
            @include('include.showAlert')
            <div class="container-fluid bg-white border rounded-4">
                <form class="" method="GET" action="">
                    <div class="navbar">
                        <div class="container-fluid">
                            <div class="d-flex gap-3 p-4 w-100  ">
                                <div class="input-group" style="width: 100%;">
                                    <span class="input-group-text bg-white " id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search products"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                                    aria-label="Toggle navigation">
                                    <div class="text-success d-flex align-items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z" />
                                        </svg>
                                        Filter
                                    </div>
                                </button>
                            </div>

                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar"
                                aria-labelledby="offcanvasDarkNavbarLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Filter orders</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body d-flex flex-column gap-4">
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            onclick="document.getElementById('status').disabled = !this.checked;"
                                            @checked(request('status'))>
                                        <label class="w-25" for="status">
                                            STATUS
                                        </label>
                                        <select name="status" id="status"
                                            class="form-control select-control fs-6 fw-semibold"
                                            @disabled(request('status', '') === '')>
                                            <option @selected(request('status', '') === 'pending') value="pending">pending</option>
                                            <option @selected(request('status', '') === 'processing') value="processing">processing</option>
                                            <option @selected(request('status', '') === 'shipping') value="shipping">shipping</option>
                                            <option @selected(request('status', '') === 'shipped') value="shipped">shipped</option>
                                            <option @selected(request('status', '') === 'canceled') value="canceled">canceled</option>
                                        </select>
                                    </div>

                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            onclick="document.getElementById('min_total').disabled = !this.checked;"
                                            @checked(request('min_total'))>
                                        <label class="w-25" for="min_total">
                                            Min total
                                        </label>
                                        <input type="number" name="min_total" id="min_total"
                                            value="{{ request('min_total', 0) }}" @disabled(!request('min_total'))>
                                    </div>

                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input me-1"
                                            onclick="document.getElementById('max_total').disabled = !this.checked;"
                                            @checked(request('max_total'))>
                                        <label class="w-25" for="max_total">
                                            Max total
                                        </label>
                                        <input type="number" name="max_total" id="max_total"
                                            value="{{ request('max_total', 0) }}" @disabled(!request('max_total'))>
                                    </div>

                                    <div class="text-center">
                                        <input type="submit" value="Filter" class="btn btn-orange">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Contacts</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Requirement</th>
                                    <th scope="col">Recommend</th>
                                    <th scope="col">Business card</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr class="small">
                                        <th scope="row">
                                            <div class="text-info">
                                                #{{ $contact->id }}
                                            </div>
                                        </th>
                                        <td>
                                            {{ $contact->user->name }}
                                        </td>
                                        <td style="max-width: 500px">
                                            {{ $contact->requirement }}
                                        </td>
                                        <td>
                                            @if ($contact->recommed)
                                                <div class="text-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-sign-railroad-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.05.435c-.58-.58-1.52-.58-2.1 0L4.224 3.162 8 6.94l3.777-3.777L9.049.435Zm3.274 7.425v-.862h.467c.28 0 .467.154.467.44 0 .28-.182.421-.475.421h-.459Z" />
                                                        <path
                                                            d="M12.838 4.223 9.06 8l3.777 3.777 2.727-2.728c.58-.58.58-1.519 0-2.098zm.03 2.361c.591 0 .935.334.935.844a.79.79 0 0 1-.485.748l.536 1.074h-.59l-.467-.994h-.473v.994h-.521V6.584h1.064Zm-1.091 6.254L8 9.06l-3.777 3.777 2.728 2.727c.58.58 1.519.58 2.098 0zm-8.953-5.84v.861h.46c.292 0 .474-.14.474-.421 0-.286-.188-.44-.467-.44z" />
                                                        <path
                                                            d="M3.162 11.777 6.94 8 3.162 4.223.435 6.951c-.58.58-.58 1.519 0 2.098zm-.86-5.193h1.065c.592 0 .936.334.936.844 0 .39-.242.654-.485.748l.536 1.074h-.59l-.467-.994h-.473v.994h-.521V6.584Z" />
                                                    </svg> true
                                                </div>
                                            @else
                                                <div class="text-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-sign-railroad-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.05.435c-.58-.58-1.52-.58-2.1 0L4.224 3.162 8 6.94l3.777-3.777L9.049.435Zm3.274 7.425v-.862h.467c.28 0 .467.154.467.44 0 .28-.182.421-.475.421h-.459Z" />
                                                        <path
                                                            d="M12.838 4.223 9.06 8l3.777 3.777 2.727-2.728c.58-.58.58-1.519 0-2.098zm.03 2.361c.591 0 .935.334.935.844a.79.79 0 0 1-.485.748l.536 1.074h-.59l-.467-.994h-.473v.994h-.521V6.584h1.064Zm-1.091 6.254L8 9.06l-3.777 3.777 2.728 2.727c.58.58 1.519.58 2.098 0zm-8.953-5.84v.861h.46c.292 0 .474-.14.474-.421 0-.286-.188-.44-.467-.44z" />
                                                        <path
                                                            d="M3.162 11.777 6.94 8 3.162 4.223.435 6.951c-.58.58-.58 1.519 0 2.098zm-.86-5.193h1.065c.592 0 .936.334.936.844 0 .39-.242.654-.485.748l.536 1.074h-.59l-.467-.994h-.473v.994h-.521V6.584Z" />
                                                    </svg> false
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($contact->business_card)
                                                <div class="text-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-sign-railroad-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.05.435c-.58-.58-1.52-.58-2.1 0L4.224 3.162 8 6.94l3.777-3.777L9.049.435Zm3.274 7.425v-.862h.467c.28 0 .467.154.467.44 0 .28-.182.421-.475.421h-.459Z" />
                                                        <path
                                                            d="M12.838 4.223 9.06 8l3.777 3.777 2.727-2.728c.58-.58.58-1.519 0-2.098zm.03 2.361c.591 0 .935.334.935.844a.79.79 0 0 1-.485.748l.536 1.074h-.59l-.467-.994h-.473v.994h-.521V6.584h1.064Zm-1.091 6.254L8 9.06l-3.777 3.777 2.728 2.727c.58.58 1.519.58 2.098 0zm-8.953-5.84v.861h.46c.292 0 .474-.14.474-.421 0-.286-.188-.44-.467-.44z" />
                                                        <path
                                                            d="M3.162 11.777 6.94 8 3.162 4.223.435 6.951c-.58.58-.58 1.519 0 2.098zm-.86-5.193h1.065c.592 0 .936.334.936.844 0 .39-.242.654-.485.748l.536 1.074h-.59l-.467-.994h-.473v.994h-.521V6.584Z" />
                                                    </svg> true
                                                </div>
                                            @else
                                                <div class="text-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-sign-railroad-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.05.435c-.58-.58-1.52-.58-2.1 0L4.224 3.162 8 6.94l3.777-3.777L9.049.435Zm3.274 7.425v-.862h.467c.28 0 .467.154.467.44 0 .28-.182.421-.475.421h-.459Z" />
                                                        <path
                                                            d="M12.838 4.223 9.06 8l3.777 3.777 2.727-2.728c.58-.58.58-1.519 0-2.098zm.03 2.361c.591 0 .935.334.935.844a.79.79 0 0 1-.485.748l.536 1.074h-.59l-.467-.994h-.473v.994h-.521V6.584h1.064Zm-1.091 6.254L8 9.06l-3.777 3.777 2.728 2.727c.58.58 1.519.58 2.098 0zm-8.953-5.84v.861h.46c.292 0 .474-.14.474-.421 0-.286-.188-.44-.467-.44z" />
                                                        <path
                                                            d="M3.162 11.777 6.94 8 3.162 4.223.435 6.951c-.58.58-.58 1.519 0 2.098zm-.86-5.193h1.065c.592 0 .936.334.936.844 0 .39-.242.654-.485.748l.536 1.074h-.59l-.467-.994h-.473v.994h-.521V6.584Z" />
                                                    </svg> false
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($contact->reply)
                                                <div class="text-success">Replied</div>
                                            @else
                                                <button class="btn btn-outline-warning" value="{{ $contact->id }}"
                                                    onclick="reply(this);" data-bs-toggle="modal"
                                                    data-bs-target="#replyModal" type="button">Reply</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-3 d-flex align-items-center gap-4 justify-content-center">
                            <div>
                                <label for="per_page">Num of row:</label>
                                <select name="per_page" id="per_page" onchange="this.form.submit()"
                                    class="form-select">
                                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                            </div>
                        </div>

                        <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                            {{ $contacts->appends([
                                    'per_page' => request('per_page'),
                                    'status' => request('status'),
                                ])->links() }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reply: </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="replyForm" action="{{ route('supplier.contacts.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Id : #</label>
                            <input type="text" class="form-control" name="supplier_contact_id"
                                id="supplier_contact_id" value="" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Message:</label>
                            <input type="text" class="form-control" name="message" id="message"
                                placeholder="Enter message" required value="">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function reply(element) {
            const replyForm = document.getElementById('replyForm');
            replyForm.querySelector('#supplier_contact_id').value = element.value;
            replyForm.querySelector('#message').value = '';
        }
    </script>
@endsection
