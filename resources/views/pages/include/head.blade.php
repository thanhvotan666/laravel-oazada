<div class="container-fluid p-0 bg-grey">
    <div class="d-flex gap-4 align-items-center justify-content-center py-2">
        <img src="{{ asset($supplier->user->avatar) }}" alt="" height="200px">
        <div>
            <div class="fw-bold">{{ $supplier->name }}</div>
            <div class="d-flex gap-5">
                <div>
                    @if (now()->diffInYears($supplier->created_at))
                        != 0)
                        {{ now()->diffInYears($supplier->created_at) }} years ago
                    @elseif (now()->diffInMonths($supplier->created_at) != 0)
                        {{ now()->diffInMonths($supplier->created_at) }} months ago
                    @else
                        {{ now()->diffInDays($supplier->created_at) }} days ago
                    @endif
                </div>
                <div>{{ $supplier->address }}</div>
            </div>
            <div>
                <div>Main categories:</div>
                <div>{{ $categorySupplier->pluck('name')->join(', ') }}</div>
            </div>
        </div>
    </div>
    <div class="bg-dark p-3">
        <div class="d-flex justify-content-center gap-5">
            <div><a class="text-white" href="{{ route('supplier', ['id' => $supplier->id]) }}">Home</a></div>
            <div><a class="text-white" href="{{ route('supplier-product', ['id' => $supplier->id]) }}">Products</a>
            </div>
            <div><a class="text-white" href="{{ route('supplier-contacts', ['id' => $supplier->id]) }}">Contacts</a>
            </div>
        </div>
    </div>
</div>
