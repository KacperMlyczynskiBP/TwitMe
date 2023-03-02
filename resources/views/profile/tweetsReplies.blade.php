<x-profileMaster>


    @section('tweetsReplies')

        <div class="feed__header">
            <h2>{{ $user->username }}</h2>
        </div>

        <a class="profile-bg main-wrapper d-block"></a>
        <div>
            <a href="#" id="profile-link">
                <div class="profile-picture">
                    <img src="{{asset($user->user_image_path)}}" width="133px" height="133px">
                </div>
            </a>
            <div id="profile-marg">
                @if($user->id !== Auth()->user()->id)
                    <div class="follow" style="float:right;">
                        <form method="POST" action="{{ route('follow.user') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <input type="submit" name="follow" class="button" value="Follow" placeholder="follow">
                        </form>
                    </div>
                @else
                    <div style="float:right;" class="sidebarOption">
                        <span class="material-icons"> perm_identity </span>
                        <div><a href="{{ route('create.profileEdit', ['id'=>$user->id]) }}">Edit profile</a></div>
                    </div>
                @endif
                <div id="profile-name">
                    <a href="#"></a>
                </div>
            </div>
            <div id="profile-state">

                <ul id="profile-Arrange">

                    <li id="profile-details">
                        <a href="#">
                            <span class="d-block" id="profile-label">Following</span>
                            <span id="profile-number">
                            @inject('count','App\Helpers\CountFollowers')
                            <a href="{{ route('create.profileFollowing', ['id'=>$user->id]) }}">{{$count->countFollowers($user->id)}}</a>
                        </span>
                        </a>
                    </li>
                    <li id="profile-details">
                        <a href="#">
                            <span class="d-block" id="profile-label">Followers</span>
                            <span id="profile-number">
                                <a href="{{route('create.profileFollowers', ['id'=>$user->id])}}">{{$count->countFollows($user->id)}}</a>
                        </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="profile-navbar">
            <div class="profile-navbar-part"><a href="{{ route('create.profileTweets', ['id'=>$user->id]) }}">Tweets</a>
            </div>
            <div class="profile-navbar-part"><a href="{{ route('create.profileReplies', ['id'=>$user->id]) }}">Tweets
                    and replies</a></div>
            <div class="profile-navbar-part"><a href="{{ route('create.profileMedia', ['id'=>$user->id]) }}">Media</a>
            </div>
            <div class="profile-navbar-part"><a href="{{ route('create.profileLikes', ['id'=>$user->id]) }}">Likes</a>
            </div>
        </div>


        @foreach($userTweets as $tweet)
            <div class="post">
                <div class="post__avatar">
                    @if($tweet->user_image_path === NULL)
                        <div class="profile-picture">
                            <img
                                    src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
                                    alt=""
                                    width="48px" height="48px"
                            />
                        </div>
                    @else
                        <div class="profile-picture">
                            <img src="{{asset($tweet->user_image_path)}}" width="48px" height="48px">
                        </div>
                    @endif
                </div>

                <div class="post__body">
                    <div class="post__header">
                        <div class="post__headerText">

                            <h3>

                                @inject('username','App\Helpers\FindUsername')
                                <div>{{$username->findUsername($tweet->user_id)}}</div>
                                <span class="post__headerSpecial"
                                ><span class="material-icons post__badge"> verified </span>@somanathg</span
                                >
                            </h3>
                        </div>
                        <div class="post__headerDescription">
                            <p>{{ $tweet->body }}</p>
                        </div>
                    </div>
                    @if($tweet->image_path == Null)
                        <img
                                src="/images/{{$tweet->image_path}}"
                                alt=""
                        />
                    @else
                        <img
                                src="/images/{{$tweet->image_path}}"
                                alt=""
                        />
                    @endif

                    <div class="post__footer">
                        <span class="material-icons"> repeat </span>
                        <a href="{{ route('like.tweet', ['postId'=>$tweet->id]) }}"><span class="material-icons"> favorite_border </span></a>
                        @inject('count','App\Helpers\CountLikes')
                        <div>{{$count->countLikesOnTweets($tweet->id)}}</div>
                        <span class="material-icons"> publish </span>
                    </div>
                </div>
            </div>
        @endforeach

    @endsection


</x-profileMaster>

