@foreach ($categories as $category)
    <div class="categoryHeader @if ($category->id == $categories[0]->id) fw-bold bg-grey @endif"
        id = "categoryHeader{{ $category->id }}">
        <a href="{{ route('category', ['id' => $category->id]) }}" onmouseover="loadTimeOutDHP({{ $category->id }})">
            {{ $category->name }}
        </a>
    </div>
@endforeach
