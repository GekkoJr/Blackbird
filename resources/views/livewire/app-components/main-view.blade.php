<div>
    {{-- In work, do what you enjoy. --}}
    @if($channel != 'placeholder')
        @foreach($messages as $message)
            <div>
                <p>
                {{ $message->fromUser . " - " . $message->message }}
                </p>
            </div>

        @endforeach
        <livewire:app-components.send-message channel="{{ $channel }}"></livewire:app-components.send-message>
    @else
        <p>TODO: FRIENDS</p>
    @endif
</div>
