@foreach ($countries as $country)
    <div>
        <input type="checkbox" name="" id="country{{ $country->id }}" value="{{ $country->id }}">
        <img height="18" src="{{ asset($country->image) }}" alt="">
        {{ $country->name }}
    </div>
@endforeach
