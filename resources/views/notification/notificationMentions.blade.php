<x-indexMaster>


@section('notificationsMentions')
    <div class="feed__header">
        <h2>Mentions</h2>
    </div>

        <div class="message_header_container">
            <div class="sticky-div"><a href="{{ route('show.notifications') }}">All</a></div>
            <div class="sticky-div"><a href="{{ route('show.notifications.verified') }}">Verified</a></div>
            <div class="sticky-div"><a href="#">Mentions</a></div>
        </div>

    <div class="messages-section">
        @foreach($notifications as $notification)
            <div class="message">
                <div class="message__header">
                    {{--                            <img src="{{$notification->user_image_path}}" alt="Profile Image">--}}
                    {{--                            <h3 class="message__username">{{$notification->username}}</h3>--}}
                    <p class="message__timestamp">12.02.2023</p>
                </div>
                <div class="message__content">
                    @inject('username','\App\Helpers\FindUsername')
                    <p>{{$username->findUsername($notification->sender_id)}}
                        {{ $notification->comment}}
                    </p>
                </div>
            </div>
        @endforeach
    </div>


@endsection
</x-indexMaster>
