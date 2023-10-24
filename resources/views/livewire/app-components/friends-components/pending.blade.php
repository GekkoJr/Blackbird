<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @foreach( $pendingList as $pending)
        @if($pending[0] === $userId->username )
        <p> {{ $userId->username }}</p>
        @else
            <p>{{ $pending[1] }}</p>
        @endif

        @if($pending[2] === $userId->id )
            <p>Waiting for accept</p>
        @else
            <p>Accept?</p>
        @endif
    @endforeach
</div>
