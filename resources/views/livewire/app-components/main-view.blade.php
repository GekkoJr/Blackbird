<div>
    {{-- In work, do what you enjoy. --}}
    @if($channel != 'placeholder')
        @foreach($messages as $message)
            {{ $message->message }}
        @endforeach
    @else
        <p>TODO: FRIENDS</p>
    @endif
</div>
