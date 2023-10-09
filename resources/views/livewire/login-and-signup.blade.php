<div>
    {{-- Be like water. --}}
    @if( $login)
        <livewire:Login></livewire:Login>
    @else
        <livewire:signup></livewire:signup>
    @endif
</div>
