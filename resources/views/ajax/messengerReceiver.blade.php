@foreach ($messages as $message)
    <button type="button" class="p-2 border btn btn-outline-primary d-flex gap-3 rounded-3 justify-content-between"
        onclick="loadTimeOutSender({{ $message['user']->id }})">
        <div class="fw-semibold">{{ $message['user']->name }}</div>
        <div class="text-warning">
            @if ($message['new'])
                New
            @endif
        </div>
    </button>
@endforeach
