<div class="reciveMessage">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @foreach($messages as $message)
        @php
            $togheter = false;
            // this pains me
            $date = new \Carbon\Carbon($message['created_at']);
            $date->format('d/m/Y H:i');
            if(isset($previousDate)) {
                $diff = $date->diffInSeconds($previousDate);
                $togheter = ($diff < 60);

                if(!$togheter) {
                    $previousDate = $date;
                }

            } else {
                $previousDate = $date;
            }

        @endphp
        <div>
            @if(!$togheter)
            <div class="nameAndTime">
                <p>{{ $message['fromUser'] }}</p>
                <p class="timeSendt">{{ $date }}</p>
            </div>
            @endif
            <div>
                <p>{{ $message['message'] }}</p>
            </div>
        </div>
    @endforeach
</div>
