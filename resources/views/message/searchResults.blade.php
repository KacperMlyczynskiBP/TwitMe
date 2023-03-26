<x-indexMaster>

@section('searchResults')
<div class="feed">
    <div class="feed__header">
        <h2>Messages</h2>
        <div class="widgets__input">
            <form method="POST" action="{{ route('search.user') }}">
                @csrf
                <span class="material-icons widgets__searchIcon"> search </span>
                <input type="text" placeholder="Search for users..." name="body"/>
            </form>
        </div>
    </div>
    <div class="message_header_container">
        <div class="sticky-div"><a href="{{ route('create.messages') }}">Last Messages</a></div>
        <div class="sticky-div"><a href="{{ route('create.search.users') }}">Search Users</a></div>
    </div>
    <div class="messages-section">
        @foreach($users as $user)
            <div class="message">
                <a href="{{ route('create.chat', ['user' => $user]) }}">
                <div class="message__header">
                    <img src="{{$user->user_image_path}}" alt="Profile Image">
                    <h3 class="message__username">{{$user->username}}</h3>
                </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

@endsection

</x-indexMaster>
