<div x-data="{ toggle: 1 }">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="FriendsNav">
        <button x-on:click="toggle = 1">All</button>
        <button class="AddFriendBtn" x-on:click="toggle = 2">Add</button>
        <button x-on:click="toggle = 3">Pending</button>
    </div>
    <div x-show="toggle === 1">
        <livewire:app-components.friends-components.show-all></livewire:app-components.friends-components.show-all>
    </div>
    <div x-show="toggle === 2">
        <livewire:app-components.friends-components.search></livewire:app-components.friends-components.search>
    </div>
    <div x-show="toggle === 3">
        <livewire:app-components.friends-components.pending></livewire:app-components.friends-components.pending>
    </div>
    <livewire:test></livewire:test>
</div>
