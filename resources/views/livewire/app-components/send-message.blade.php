<div>
    {{-- Be like water. --}}
    <input type="text" wire:model="message">
    <button wire:click="sendMessage">Send</button>
    {{ $channel }}
</div>
