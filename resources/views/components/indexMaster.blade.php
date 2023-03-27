<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>TwittMe</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font1-awesome/5.15.3/css/all.min.css"
            integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
            crossorigin="anonymous"
    />
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
<!-- sidebar ends -->

<!-- feed starts -->

<div class="feed">

<div>

@yield('collection')
@yield('createCollection')
@yield('bookmarks')
@yield('explore')
@yield('listPostsLikes')
@yield('singleTweet')
@yield('enterVerification')
@yield('verificationNumber')
@yield('verificationFeatures')
@yield('verification')
@yield('followers')
@yield('following')
@yield('chat')
@yield('messages')
@yield('searchResults')
@yield('searchUser')
@yield('notifications')
@yield('notificationsVerified')
@yield('notificationsMentions')

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
            <div style="display:block; width:348px; height:82px;">
                <a>Trends to be applied</a><br>
                500ktweets
            </div>


        </blockquote>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
</div>
<!-- widgets ends -->
</body>
</html>
