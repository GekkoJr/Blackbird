<div class="mainView">
    {{-- In work, do what you enjoy. --}}
    {{-- This components mostly handels the logic of the app --}}
    @if($mode === 'channel')
        <div class="sendAndReciveContainer">
        <livewire:app-components.recive-message channel="{{ $channel }}"></livewire:app-components.recive-message>
        <livewire:app-components.send-message channel="{{ $channel }}"></livewire:app-components.send-message>
        </div>
    @elseif($mode === 'friends')
        <p>TODO: FIND FRIENDS</p>
    @endif
</div>
