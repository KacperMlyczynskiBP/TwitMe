<x-indexMaster>


@section('messages')


    <div class="feed__header">
        <h2>Messages</h2>
    </div>

    <div class="message_header_container">
        <div class="sticky-div"><a href="{{ route('create.messages') }}">Last Messages</a></div>
        <div class="sticky-div"><a href="{{ route('create.searchUsers') }}">Search Users</a></div>
    </div>
    <div class="messages-section">
        @foreach($messages as $message)
        <div class="message">
                @inject('user', 'App\Helpers\FindUser')
            <a href="{{ route('create.chat', ['user'=>$user->findUser($message)]) }}">
                @inject('user_image_path','App\Helpers\FindUserImagePath')
                <div class="message__header">
                <img src="{{asset($user_image_path->findOtherUserImagePath($message))}}" alt="Profile Image">
                @inject('username','App\Helpers\FindUsername')
                <h3 class="message__username">{{$username->findOtherUserUsername($message)}}</h3>
                <p class="message__timestamp">{{$message->created_at}}</p>

            </div>

            <div class="message__content">
                <p>{{$message->text}}.</p>
            </div>
            </a>
        </div>
        @endforeach
    </div>

@endsection

</x-indexMaster>

