<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @foreach($messages as $message)
        <div>
            <p>
                {{ $message['fromUser'] . " - " . $message['message'] }}
            </p>
        </div>
    @endforeach
</div>
