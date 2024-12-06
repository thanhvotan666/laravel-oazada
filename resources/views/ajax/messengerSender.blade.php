<div class="d-flex gap-4 m-2">
    <input type="hidden" name="sender" id='sender' value="{{ $sender }}">
    <input type="hidden" name="receiver" id='receiver' value="{{ $receiver }}">
    <input type="text" name="message" class="form-control" placeholder="Enter your message" required>
    <button type="button" class="btn btn-orange" onclick="sendMessage({{ $receiver }})">Send</button>
</div>
<div class="p-3 h-100 d-flex flex-column gap-2 overflow-y-scroll" id="receive-messages">
    @foreach ($messages as $message)
        <div class="text-{{ $message->sender == $sender ? 'end' : 'start' }}">
            <div class="text-secondary" style="font-size: 10px">{{ $message->created_at }}</div>
            <div class="bg-white p-2" style="font-size: 13px">{{ $message->message }}</div>
        </div>
    @endforeach
</div>
