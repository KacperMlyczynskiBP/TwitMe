<x-indexMaster>
    @section('chat')
    <div class="feed">
    <div class="feed__header">
        <h2>Messages</h2>
    </div>

    <div class="message_header_container">
        <div class="sticky-div"><a href="{{ route('create.messages') }}">Last Messages</a></div>
        <div class="sticky-div"><a href="{{ route('create.search.users') }}">Search Users</a></div>
    </div>
    <div class="messages-section">
        <div class="chat-window">
                <div class="chat-header">
                    <img src="{{asset($user->user_image_path)}}" alt="Profile Image">
                    <h3 class="chat-username">{{$user->username}}</h3>
                </div>
                <div class="chat-messages">
                    @foreach($messages as $message)
                    <div class="message">
                        <img src="{{asset($message->user_image_path)}}" alt="Profile Image">
                        <div class="message-content">
                            <p>{{$message->text}}</p>
                            <p class="message-timestamp">{{$message->created_at}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <form action="{{ route('store.message') }}" method="POST" class="chat-form">
                        @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <input type="text" name="message" placeholder="Type a message...">
                    <button type="submit">submit</button>
                </form>
            </div>
        </div>

</div>

    @endsection
</x-indexMaster>

