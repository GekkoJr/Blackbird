<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <label>
        <span style="display: none">Search Users</span>
        <input type="text" wire:model.live="search">
    </label>
    <div class="LoadingCircle" wire:dirty>loading</div>
    <div class="UserSearchResult">
        @if($users)
            @foreach($users as $user)
                <div>
                    <p>
                         {{ $user->username }}
                    </p>
                    <button wire:click="sendRequest('{{ $user->username }}')">Add friend</button>
                </div>
            @endforeach
        @endif
    </div>
</div>
