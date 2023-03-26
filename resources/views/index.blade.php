<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>TwittMe</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('/node_modules/bootstrap/dist/css/bootstrap.css') }}">


</head>
<body>

<div class="sidebar">


    <!-- sidebar starts -->
    <i class="fab fa-twitter"></i>
    <div class="sidebarOption active">
        <span class="material-icons"> home </span>
        <h2><a href="{{ route('index')}}">Home</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> search </span>
        <h2><a href="{{ route('show.explore')  }}">Explore</a></h2>
    </div>


    <div class="sidebarOption">
        <span class="material-icons"> notifications_none </span>
        <h2><a href="{{ route('show.notifications') }}">Notifications</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> mail_outline </span>
        <h2><a href="{{ route('create.messages') }}">Messages</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> bookmark_border </span>
        <h2><a href="{{ route('show.bookmarks') }}">Bookmarks</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> check </span>
        <h2><a href="{{ route('show.verification.features') }}">TwittMe Blue</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> perm_identity </span>
        <h2><a href="{{ route('create.profile', ['id'=>Auth()->user()->id]) }}">Profile</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> more_horiz </span>
        <div class="dropdown_content">
            <h2>More</h2>
            <div class="sidebarOption-dropdown">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <button type="submit" name="logout" class=""><h2>Log out</h2></button>
                </form>
            </div>
        </div>
    </div>

</div>




<!-- feed starts -->

<div class="feed">
    <div class="feed__header">
        <h2>Home</h2>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- tweetbox starts -->
    <div class="tweetBox">
        <form action="{{ route('store.tweet') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="tweetbox__input">
                @if($user->user_image_path === NULL)
                    <div class="profile-picture">
                        <img
                            src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
                            alt=""
                            width="48px" height="48px"
                        />
                    </div>
                @else
                    <div class="profile-picture">
                        <img src="{{asset($user->user_image_path)}}" width="48px" height="48px">
                    </div>
                @endif
                <input type="text" name="body" placeholder="What's happening?"/>
            </div>

            <div class="media">
                <label for="file-upload" class="custom-file-upload">
                    <img class="custom-file-upload" src="{{asset('images/R.jpg')}}" height="20px" width="20px">
                    <input type="file" name="tweetMedia" class="custom-file-upload">
                </label>
            </div>
            <button name="tweetSubmit" class="tweetBox__tweetButton">Tweet</button>
        </form>
    </div>

    <!-- tweetbox ends -->
    {{-- posts start --}}
    @foreach($posts as $post)
        <div class="post">
            <div class="post__avatar">
                <div class="profile-picture">
                    <img src="{{asset($post->user_image_path)}}" width="48px" height="48px">
                </div>
            </div>
            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            @inject('username','App\Helpers\FindUsername')
                            <div>
                                <a href="{{ route('create.profile', ['id'=>$post->user_id]) }}">{{$username->findUsername($post->user_id)}}</a>
                            </div>
                            <span class="post__headerSpecial">
                                <span class="material-icons post__badge"> verified </span>
                                <div>@ {{$username->findUsername($post->user_id)}}</div>
                            </span>
                        </h3>
                    </div>
                    <a href="{{ route('show.single', ['post'=>$post]) }}">
                        <div class="post__headerDescription">
                            <p>{{ $post->body }}</p>
                        </div>
                    </a>
                </div>
                @if ($post->image_path)
                    @if (Str::endsWith($post->image_path, '.mp4') || Str::endsWith($post->image_path, '.mov') || Str::endsWith($post->image_path, '.avi'))
                        <video controls width="504px" height="504px">
                            <source src="{{ asset('images/'.$post->image_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <img src="{{ asset($post->image_path) }}" alt="Tweet media">
                    @endif
                @endif
                <div class="post__footer">
                    <span class="material-icons"> repeat </span>
                    <a href="{{ route('like.tweet', ['post'=>$post, 'userId'=>$post->user_id]) }}"><span
                            class="material-icons"> favorite_border </span></a>
                    @inject('count','App\Helpers\CountLikes')
                    <div><a href="{{ route('list.posts.likes', ['post'=>$post]) }}">{{$count->countLikesOnTweets($post->id)}}</a></div>
                    <a> Views: {{ $post->view_counts }}</a>

                    <a href="{{ route('save.bookmark', ['post'=>$post]) }}"><span class="material-icons"> publish </span></a>
                    @can('delete', [$post, Auth::user()])
                        <form method="POST" action="{{ route('undo', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    @endforeach
    <div> {{ $posts->links('vendor.pagination.simple-bootstrap-4') }}

    </div>
</div>
<!-- feed ends -->

<!-- widgets starts -->
<div class="widgets">
    <div class="widgets__input">
        <form method="POST" action="{{ route('search') }}">
            @csrf
            <span class="material-icons widgets__searchIcon"> search </span>
            <input type="text" placeholder="Search Twitter" name="body"/>
        </form>
    </div>

    <div class="widgets__widgetContainer">
        <h2>Trends for you</h2>
        <blockquote class="twitter-tweet">
            @foreach($trends as $key=>$value)
            <div style="display:block; width:348px; height:82px;">
                <a>{{$key}}</a><br>
                 {{$value}}  Tweets
            </div>
            @endforeach


        </blockquote>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
</div>
<!-- widgets ends -->
</body>
</html>
