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

        .main-wrapper {
            background-image: url("./images/twitter.png");
            background-position: 0 50%;
            background-size: 100% auto;
            border-radius: 4px 4px 0px 0px;
            height:95px;
            width:100%;
        }
        #profile-link{
            background-color: #fff;
            border-radius: 6px;
            display: inline-block;
            float: left;
            margin:-30px 5px 0px 8px;
            max-width:100%;
            padding:1px;
            vertical-align: bottom;
        }
        #profile-img{
            border:2px solid #fff;
            border-radius: 7px;
            color:#fff;
            height:72px;
            width:72px;
        }
        #profile-marg{
            margin:5px 0px 0px;
        }
        #profile-name{
            font-size:18px;
            font-weight: 700;
            line-height: 21px;
        }
        #profile-name a{
            color:inherit;
        }
        #profile-state{
            padding:15px;
        }
        #profile-Arrange{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin:0;
            min-width:100%;
            padding:0px;
        }
        ul#profile-Arrange{
            list-style: none;
            margin:0;
            padding:0;
        }
        #profile-details a:hover{
            text-decoration: none;
        }
        #profile-number{
            display: block;
            font-size: 18px;
            font-weight: 500;
            transition: color 0.15s ease-in-out 0s;
        }
        #profile-label{
            color:#8899a6;
            font-size:10px;
            letter-spacing: 0.02em;
            overflow: hidden;
            float: left;
            text-transform: uppercase;
            transition: color 0.15s ease-in-out 0s;
        }


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
        <h2>{{ Auth()->user()->username }}</h2>
    </div>

    <div>This is your picturre</div>
    <a class="profile-bg main-wrapper d-block"></a>
    <div>
        <a href="#" id="profile-link">
            <img src="images/user.jpg" id="profile-img">
        </a>
        <div id="profile-marg">
            <div id="profile-name">
                <a href="#"></a>
            </div>
            <span>
                @if(session('user'))
                  <a href="#">@<span></span></a>
              </span>
            @endif

            Edit your Profile
        </div>
        <div id="profile-state">
            <ul id="profile-Arrange">
                {{--                    <li id="profile-details">--}}
                    {{--                        <a href="#">--}}
                        {{--                            <span class="d-block" id="profile-label">Tweets</span>--}}
                        {{--                            <span id="profile-number">--}}
{{--                            9.840--}}
{{--                        </span>--}}
                        {{--                        </a>--}}
                    {{--                    </li>--}}
                <li id="profile-details">
                    <a href="#">
                        <span class="d-block" id="profile-label">Following</span>
                        <span id="profile-number">
                            @inject('count','App\Http\Helpers\CountFollowers')
                            {{$count->countFollows()}}
                        </span>
                    </a>
                </li>
                <li id="profile-details">
                    <a href="#">
                        <span class="d-block" id="profile-label">Followers</span>
                        <span id="profile-number">
                           {{$count->countFollowers()}}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div>simple text</div>
    <div>
        <a href="{{ route('create.profileTweets') }}">Tweets</a>
        <a href="">Tweets and replies</a>
        <a href="">Media</a>
        <a href="{{ route('create.profileLikes') }}">Likes</a>
    </div>

    <div>
        @yield('tweets')
        @yield('tweetsReplies')
        @yield('likes')
    </div>

</div>
<!-- feed ends -->

<!-- widgets starts -->
<div class="widgets">
    <div class="widgets__input">
        <span class="material-icons widgets__searchIcon"> search </span>
        <input type="text" placeholder="Search Twitter" />
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
