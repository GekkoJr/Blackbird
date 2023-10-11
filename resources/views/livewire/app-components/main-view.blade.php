<div class="mainView">
    {{-- In work, do what you enjoy. --}}
    {{-- This components mostly handels the logic of the app --}}
    @if($channel != 'placeholder')
        <livewire:app-components.recive-message channel="{{ $channel }}"></livewire:app-components.recive-message>
        <livewire:app-components.send-message channel="{{ $channel }}"></livewire:app-components.send-message>
    @else
        <p>TODO: FRIENDS</p>
    @endif
</div>
