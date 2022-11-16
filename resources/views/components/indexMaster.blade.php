<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TwittMe</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font1-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous"
    />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            --twitter-color: #50b7f5;
            --twitter-background: #e6ecf0;
        }

        /**/


        .sidebarOption {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .sidebarOption .material-icons,
        .fa-twitter {
            padding: 20px;
        }

        .sidebarOption h2 {
            font-weight: 800;
            font-size: 20px;
            margin-right: 20px;
        }

        .sidebarOption:hover {
            background-color: var(--twitter-background);
            border-radius: 30px;
            color: var(--twitter-color);
            transition: color 100ms ease-out;
        }

        .sidebarOption.active {
            color: var(--twitter-color);
        }

        .sidebar__tweet {
            width: 100%;
            background-color: var(--twitter-color);
            border: none;
            color: white;
            font-weight: 900;
            border-radius: 30px;
            height: 50px;
            margin-top: 20px;
        }

        body {
            display: flex;
            height: 100vh;
            max-width: 1300px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 10px;
        }

        .sidebar {
            border-right: 1px solid var(--twitter-background);
            flex: 0.2;

            min-width: 250px;
            margin-top: 20px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .fa-twitter {
            color: var(--twitter-color);
            font-size: 30px;
        }

        /* feed */
        .feed {
            flex: 0.5;
            border-right: 1px solid var(--twitter-background);
            min-width: fit-content;
            overflow-y: scroll;
        }

        .feed__header {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 100;
            border: 1px solid var(--twitter-background);
            padding: 15px 20px;
        }

        .feed__header h2 {
            font-size: 20px;
            font-weight: 800;
        }

        .feed::-webkit-scrollbar {
            display: none;
        }

        .feed {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* tweet box */
        .tweetbox__input img {
            border-radius: 50%;
            height: 40px;
        }

        .tweetBox {
            padding-bottom: 10px;
            border-bottom: 8px solid var(--twitter-background);
            padding-right: 10px;
        }

        .tweetBox form {
            display: flex;
            flex-direction: column;
        }

        .tweetbox__input {
            display: flex;
            padding: 20px;
        }

        .tweetbox__input input {
            flex: 1;
            margin-left: 20px;
            font-size: 20px;
            border: none;
            outline: none;
        }

        .tweetBox__tweetButton {
            background-color: var(--twitter-color);
            border: none;
            color: white;
            font-weight: 900;

            border-radius: 30px;
            width: 80px;
            height: 40px;
            margin-top: 20px;
            margin-left: auto;
        }

        /* post */
        .post__avatar img {
            border-radius: 50%;
            height: 40px;
        }

        .post {
            display: flex;
            align-items: flex-start;
            border-bottom: 1px solid var(--twitter-background);
            padding-bottom: 10px;
        }

        .post__body img {
            width: 450px;
            object-fit: contain;
            border-radius: 20px;
        }

        .post__footer {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .post__badge {
            font-size: 14px !important;
            color: var(--twitter-color);
            margin-right: 5px;
        }

        .post__headerSpecial {
            font-weight: 600;
            font-size: 12px;
            color: gray;
        }

        .post__headerText h3 {
            font-size: 15px;
            margin-bottom: 5px;
        }

        .post__headerDescription {
            margin-bottom: 10px;
            font-size: 15px;
        }

        .post__body {
            flex: 1;
            padding: 10px;
        }

        .post__avatar {
            padding: 20px;
        }

        /* widgets */
        .widgets {
            flex: 0.3;
        }

        .widgets__input {
            display: flex;
            align-items: center;
            background-color: var(--twitter-background);
            padding: 10px;
            border-radius: 20px;
            margin-top: 10px;
            margin-left: 20px;
        }

        .widgets__input input {
            border: none;
            background-color: var(--twitter-background);
        }

        .widgets__searchIcon {
            color: gray;
        }

        .widgets__widgetContainer {
            margin-top: 15px;
            margin-left: 20px;
            padding: 20px;
            background-color: #f5f8fa;
            border-radius: 20px;
        }

        .widgets__widgetContainer h2 {
            font-size: 18px;
            font-weight: 800;
        }
        /* post */
        .post__avatar img {
            border-radius: 50%;
            height: 40px;
        }

        .post {
            display: flex;
            align-items: flex-start;
            border-bottom: 1px solid var(--twitter-background);
            padding-bottom: 10px;
        }

        .post__body img {
            width: 450px;
            object-fit: contain;
            border-radius: 20px;
        }

        .post__footer {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .post__badge {
            font-size: 14px !important;
            color: var(--twitter-color);
            margin-right: 5px;
        }

        .post__headerSpecial {
            font-weight: 600;
            font-size: 12px;
            color: gray;
        }

        .post__headerText h3 {
            font-size: 15px;
            margin-bottom: 5px;
        }

        .post__headerDescription {
            margin-bottom: 10px;
            font-size: 15px;
        }

        .post__body {
            flex: 1;
            padding: 10px;
        }

        .post__avatar {
            padding: 20px;
        }

        /* widgets */
        .widgets {
            flex: 0.3;
        }

        .widgets__input {
            display: flex;
            align-items: center;
            background-color: var(--twitter-background);
            padding: 10px;
            border-radius: 20px;
            margin-top: 10px;
            margin-left: 20px;
        }

        .widgets__input input {
            border: none;
            background-color: var(--twitter-background);
        }

        .widgets__searchIcon {
            color: gray;
        }

        .widgets__widgetContainer {
            margin-top: 15px;
            margin-left: 20px;
            padding: 20px;
            background-color: #f5f8fa;
            border-radius: 20px;
        }

        .widgets__widgetContainer h2 {
            font-size: 18px;
            font-weight: 800;
        }
    </style>
</head>
<body>
<!-- sidebar starts -->
<div class="sidebar">
    <i class="fab fa-twitter"></i>
    <div class="sidebarOption active">
        <span class="material-icons"> home </span>
        <h2><a href="{{ route('index')}}">Home</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> search </span>
        <h2>Explore</h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> notifications_none </span>
        <h2>Notifications</h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> mail_outline </span>
        <h2>Messages</h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> bookmark_border </span>
        <h2>Bookmarks</h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> list_alt </span>
        <h2>Lists</h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> perm_identity </span>
        <h2><a href="{{ route('create.profile', ['username'=>Auth()->user()->username]) }}">Profile</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> more_horiz </span>
        <h2>More</h2>
    </div>
    <button class="sidebar__tweet">Tweet</button>
</div>
<!-- sidebar ends -->

<!-- feed starts -->

<div class="feed">
    <div class="feed__header">
        <h2>Home</h2>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <input type="submit" name="logout">
        </form>
    </div>

    <!-- tweetbox starts -->
    <div class="tweetBox">
        <form action="{{ route('store.tweet') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="tweetbox__input">
                <img
                    src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
                    alt=""
                />
                <input type="text" name="body" placeholder="What's happening?" />
            </div>
            <div class="media">
                <input type="file" name="tweetMedia" class="">
            </div>
            <button name="tweetSubmit" class="tweetBox__tweetButton">Tweet</button>
        </form>
    </div>

    <!-- tweetbox ends -->
    {{--   posts start --}}
    @foreach($posts as $post)
        <a href="{{ route('show.single', ['postId'=>$post->id]) }}">
            <div class="post">
                <div class="post__avatar">
                    <img
                        src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
                        alt=""
                    />
                </div>

                <div class="post__body">
                    <div class="post__header">
                        <div class="post__headerText">
                            <h3>
                                @inject('username','App\Http\Helpers\FindUsername')
                                <div>{{$username->findUsername($post->user_id)}}</div>
                                <span class="post__headerSpecial"
                                ><span class="material-icons post__badge"> verified </span><div>@ {{$username->findUsername($post->user_id)}}</div>
</span
>
                            </h3>
                        </div>
                        <div class="post__headerDescription">
                            <p>{{ $post->body }}</p>
                        </div>
                    </div>
                    <img
                        src="/images/{{$post->image_path}}"
                        alt=""
                    />
                    <div class="post__footer">
                        <span class="material-icons"> repeat </span>
                        <a href="{{ route('like.tweet', ['postId'=>$post->id]) }}"><span class="material-icons"> favorite_border </span></a>
                        @inject('count','App\Http\Helpers\CountLikes')
                        <div>{{$count->countLikesOnTweets($post->id)}}</div>
                        <span class="material-icons"> publish </span>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>
<!-- feed ends -->

<!-- widgets starts -->
<div class="widgets">
    <div class="widgets__input">
        <form method="POST" action="{{ route('search') }}">
            @csrf
            <span class="material-icons widgets__searchIcon"> search </span>
            <input type="text" placeholder="Search Twitter" name="body" />
        </form>
    </div>

    <div class="widgets__widgetContainer">
        <h2>What's happening?</h2>
        <blockquote class="twitter-tweet">
            <p lang="en" dir="ltr">
                Sunsets don&#39;t get much better than this one over
                <a href="https://twitter.com/GrandTetonNPS?ref_src=twsrc%5Etfw">@GrandTetonNPS</a>.
                <a href="https://twitter.com/hashtag/nature?src=hash&amp;ref_src=twsrc%5Etfw"
                >#nature</a
                >
                <a href="https://twitter.com/hashtag/sunset?src=hash&amp;ref_src=twsrc%5Etfw"
                >#sunset</a
                >
                <a href="http://t.co/YuKy2rcjyU">pic.twitter.com/YuKy2rcjyU</a>
            </p>
            &mdash; US Department of the Interior (@Interior)
            <a href="https://twitter.com/Interior/status/463440424141459456?ref_src=twsrc%5Etfw"
            >May 5, 2014</a
            >
        </blockquote>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
</div>
<!-- widgets ends -->
</body>
</html>
