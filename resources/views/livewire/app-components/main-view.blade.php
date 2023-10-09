<div>
    {{-- In work, do what you enjoy. --}}
    @if($channel)
        @foreach($messages as $message)
            {{ $message }}
        @endforeach
    @else
        <p>TODO: FRIENDS</p>
    @endif
</div>
