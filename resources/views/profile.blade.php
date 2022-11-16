<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Twitter Profile</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            outline: none;
            box-sizing: border-box;
        }

        body {
            background: #e6ecf0;
            font-family: "Helvetica Neue", "Helvetica", Arial, sans-serif;
            text-rendering: optimizeLegibility !important; /* font sempre com o melhor estilo possivel */
            -webkit-font-smoothing: antialiased !important; /* font sempre com o melhor estilo possivel */
            padding-bottom: 100px;
        }

        .container {
            display: flex;
            width: 1200px;
            padding: 0 30px;
            justify-content: space-between;
        }

        header#main-header {
            height: 46px;
            display: flex;
            position: relative;
            z-index: 1;
            justify-content: center;
            background-color: #FFF;
            box-shadow: 0 1px 1px #00000040;
        }

        header#main-header nav {
            display: flex;
            align-items: center;
        }

        header#main-header nav ul {
            display: flex;
            list-style: none;
        }

        header#main-header nav ul li {
            display: flex;
            align-items: center;
            font-size: 13px;
            color: #667580;
            font-weight: bold;
            margin-left: 30px;
        }

        header#main-header nav ul li:hover {
            cursor: pointer;
        }

        header#main-header nav ul li:first-child {
            margin: 0px;
        }

        header#main-header nav ul li img {
            margin-right: 7px;
        }

        header#main-header div.side {
            display: flex;
            align-items: center;
        }

        header#main-header div.side input {
            width: 220px;
            height: 34px;
            padding: 0 30px 0px 12px;
            border-radius: 16px;
            color: #667581;
            font-size: 12px;
            background: #F5F8FA;
            border: solid 1px #E6ECF0;
            background-repeat: no-repeat;
            background-position: 190px center;
            background-image: url('images/search.svg');
        }

        header#main-header div.side img {
            width: 34px;
            height: 34px;
            margin: 0px 15px;
            border-radius: 50%;
        }

        header#main-header div.side button {
            width: 90px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0px;
            color: #FFF;
            font-size: 14px;
            font-weight: bold;
            border-radius: 16px;
            background: #3BB9E3;
        }
        .button{
            width: 90px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0px;
            color: #FFF;
            font-size: 14px;
            font-weight: bold;
            border-radius: 16px;
            background: #3BB9E3;
        }

        div.banner {
            width: 100%;
            height: 380px;
            color: #FFF;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #3BB9E3;
        }

        .bar {
            height: 60px;
            display: flex;
            justify-content: center;
            background-color: #FFF;
            box-shadow: 0 1px 1px #00000040;
        }

        .bar .container {
            align-items: center;
            padding-left: 285px;
        }

        .bar .container ul {
            display: flex;
            height: 100%;
            list-style: none;
        }

        .bar .container ul li {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 15px;
            margin: 0 15px;
            position: relative;
        }

        .bar .container ul li.active::after {
            content: '';
            left: 0;
            width: 100%;
            height: 3px;
            bottom: 0;
            position: absolute;
            background: #3BB9E3;
        }

        .bar .container ul li span {
            color: #667580;
            font-size: 12px;
            font-weight: bold;
        }

        .bar .container ul li strong {
            color: #667580;
            font-size: 18px;
            margin-top: 2px;
            font-weight: bold;
        }

        .bar .container ul li.active strong {
            color: #3BB9E3;
        }

        .bar .container .actions .button {
            width: 90px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            border: 0px;
            color: #3BB9E3;
            font-size: 14px;
            font-weight: bold;
            border-radius: 16px;
            border: 1px solid #3BB9E3;
            background-color: #FFF;
        }

        .bar .container .actions {
            display: flex;
        }

        .wrapper-content {
            display: flex;
            justify-content: center;
        }

        .wrapper-content aside.profile {
            width: 260px;
        }

        .wrapper-content aside.profile img.avatar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin-top: -130px;
            border: 5px solid #FFF;
        }

        .wrapper-content aside.profile h1 {
            font-size: 21px;
            margin-top: 10px;
            color: #1f2226;
        }

        .wrapper-content aside.profile span {
            font-size: 14px;
            color: #53626C;

        }

        .wrapper-content aside.profile p {
            font-size: 14px;
            color: #1f2226;
            margin-top: 15px;
        }

        .wrapper-content aside.profile ul {
            margin-top: 20px;
            list-style: none;
        }

        .wrapper-content aside.profile ul.list li {
            font-size: 14px;
            color: #657786;
            display: flex;
            margin-top: 5px;
            align-items: center;
        }

        .wrapper-content aside.profile li:first-child {
            margin: 0;
        }

        .wrapper-content aside.profile ul.list img {
            margin-right: 10px;
        }

        .wrapper-content aside.profile .widget {
            margin-top: 20px;
        }

        .wrapper-content aside.profile .widget strong {
            font-weight: normal;
            color: #3BB9E3;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .wrapper-content aside.profile .widget strong img {
            margin-right: 5px;
        }

        .wrapper-content aside.profile .followers ul {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            align-content: flex-start;
            list-style: none;
        }

        .wrapper-content aside.profile .followers ul li {
            height: 45px;
            width: 45px;
            flex: 1 0 auto;
            border-radius: 50%;
            background: #D0D5D9;
            margin: 0 5px 10px 0px;
        }

        .wrapper-content aside.profile .images ul {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            align-content: flex-start;
            list-style: none;
        }

        .wrapper-content aside.profile .images li {
            width: 80px;
            height: 80px;
            flex-shrink: 0;
            border-radius: 8px;
            background: #D0D5D9;
            margin: 0 5px 5px 0px;
        }

        .wrapper-content .timeline {
            flex: 1;
            background: #FFF;
            margin: 10px 20px 0px;
        }

        .wrapper-content .timeline nav {
            border-bottom: 1px solid #E6ECF0;
            padding: 10px 15px;
        }

        .wrapper-content .timeline nav a {
            text-decoration: none;
            color: #3BB9E3;
            font-size: 18px;
            font-weight: bold;
            margin-left: 20px;
        }

        .wrapper-content .timeline nav a:first-child {
            margin: 0;
        }

        .wrapper-content .timeline nav a.active {
            margin: 0;
            color: #1f2226;
        }

        .wrapper-content .timeline nav a.tweets {
            list-style: none;
        }

        .wrapper-content .timeline ul.tweets li {
            border-bottom: 1px solid #e6ecf0;
            padding: 10px 15px;
            display: flex;
        }

        .wrapper-content .timeline ul.tweets li > img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
        }

        .wrapper-content .timeline ul.tweets li .info {
            margin-left: 10px;
            display: flex;
            flex-direction: column;
        }

        .wrapper-content .timeline ul.tweets li .info strong {
            font-size: 14px;
            color: #1f2326;
        }

        .wrapper-content .timeline ul.tweets li .info strong span {
            font-size: 13px;
            color: #1f2326;
            font-weight: normal;
        }

        .wrapper-content .timeline ul.tweets li .info p {
            font-size: 14px;
            color: #1f2326;
            margin-top: 5px;
        }

        .wrapper-content .timeline ul.tweets li .actions {
            display: flex;
            margin-top: 20px;
        }

        .wrapper-content .timeline ul.tweets li .actions a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #667580;
            font-weight: bold;
            font-size: 12px;
            margin-left: 30px;
        }

        .wrapper-content .timeline ul.tweets li .actions a:first-child {
            margin-left: 0px;
        }

        .wrapper-content .timeline ul.tweets li .actions a img {
            margin-right: 5px;
        }

        .wrapper-content aside.widgets {
            width: 290px;
            margin-top: 10px;
        }

        .wrapper-content aside.widgets .widget {
            padding: 15px;
            background: #FFF;
        }

        .wrapper-content aside.widgets .widget .title {
            display: flex;
            align-items: baseline;
        }

        .wrapper-content aside.widgets .widget .title strong {
            font-size: 18px;
            color: #1F2226;
        }

        .wrapper-content aside.widgets .widget .title a {
            color: #3BB9E3;
            font-size: 12px;
            position: relative;
            text-decoration: none;
            padding-left: 10px;
        }

        .wrapper-content aside.widgets .widget .title a::before {
            content: "";
            width: 2px;
            height: 2px;
            margin-left: 5px;
            margin-right: 50px;
            border-radius: 50%;
            background: #222222;
            position: absolute;
            left: 2px;
            top: 6px;
        }

        .wrapper-content aside.widgets .follow ul {
            list-style: none;
            margin-top: 10px;
        }

        .wrapper-content aside.widgets .follow ul li {
            display: flex;
            justify-content: space-between;
            padding-bottom: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #CCD6DD;
        }

        .wrapper-content aside.widgets .follow ul li:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border: 0;
        }

        .wrapper-content aside.widgets .follow ul li .profile {
            display: flex;
            align-items: center;
        }

        .wrapper-content aside.widgets .follow ul li .profile img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
        }

        .wrapper-content aside.widgets .follow ul li .profile .info {
            display: flex;
            margin-left: 10px;
            flex-direction: column;
        }

        .wrapper-content aside.widgets .follow ul li .profile .info strong {
            font-size: 14px;
            color: #1F2326;
        }

        .wrapper-content aside.widgets .follow ul li .profile .info strong span {
            color: #9A9A9A;
            font-weight: normal;
        }

        .wrapper-content aside.widgets .follow ul li .profile .info button {
            height: 27px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 4px;
            width: 90px;
            font-weight: bold;
            font-size: 14px;
            color: #3BB9E3;
            border-radius: 16px;
            border: 1px solid #3BB9E3;
            background: #FFF;
        }

        .wrapper-content aside.widgets .follow ul li > a {
            color: #CCD6DD;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>

<header id="main-header">
    <div class="container">
        <nav>
            <ul>
                <li><img src="images/home.svg" alt="Home">Home</li>
                <li><img src="images/notification.svg" alt="Home">Notifications</li>
                <li><img src="images/message.svg" alt="Home">Messages</li>
            </ul>
        </nav>
        <img src="images/logo.svg" alt="Logo">
        <div class="side">
            <input type="text" placeholder="Search on Twitter">
            <img src="images/avatar.png" alt="Avatar">
            <button>Tweet</button>
        </div>
    </div>
</header>

<div class="banner">
    <h1>Twitter do Gabriel de Jesus</h1>
</div>

<div class="bar">
    <div class="container">
        <ul>
            <li class="active">
                <span>Tweets</span>
                <strong>345</strong>
            </li>

            <li>
                <span>Followings</span>
                <strong>321</strong>
            </li>

            <li>
                <span>Followers</span>
                <strong>34</strong>
            </li>

            <li>
                <span>Favorites</span>
                <strong>12</strong>
            </li>
        </ul>

        <div class="actions">
            <button>Follow</button>
            <img src="images/more.svg" alt="More">
        </div>
    </div>
</div>

<div class="wrapper-content">
    <div class="container">
        <aside class="profile">
            <img src="images/avatar.png" class="avatar" alt="Gabriel de Jesus">
            <h1>Gabriel de jesus</h1>
            <span>devgabrieldejeuss</span>
            <p>❤️ Simply passionate about creating and transforming interfaces!</p>

            <ul class="list">
                <li><img src="images/place.svg" alt="Place">Rio de Janeiro, Brasil</li>
                <li><img src="images/url.svg" alt="URL">gabrieldesenvolvedor.com</li>
                <li><img src="images/joined.svg" alt="Joined">Joined October 2020</li>
                <li><img src="images/born.svg" alt="Born">Born the 19th of December 1998</li>
            </ul>

            <div class="widget followers">
                <strong><img src="images/followers.svg" alt="Followers"> 180 followers that you know</strong>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

            <div class="widget images">
                <strong><img src="images/images.svg" alt="Images"> 266 Photos and videos</strong>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

        </aside>

        <section class="timeline">
            <nav>
                <a href="" class="active">Tweets</a>
                <a href="">Tweets and replies</a>
                <a href="">Medias</a>
            </nav>

            <ul class="tweets">
                <li>
                    <img src="images/avatar.png" alt="Avatar">
                    <div class="info">
                        <strong>{{$user->username}} <span>@botdogb</span></strong>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia, vitae doloribus eum repudiandae odio.</p>

                        <div class="actions">
                            <a href=""><img src="images/comments.svg" alt="Comments"> 3</a>
                            <a href=""><img src="images/retweet.svg" alt="Retweet"> 8</a>
                            <a href=""><img src="images/like.svg" alt="Like"> 3</a>
                        </div>
                    </div>
                </li>
            </ul>
        </section>

        <aside class="widgets">
            <div class="widget follow">
                <div class="title">
                    <strong>Who to follow</strong>
                    <a href="">Refresh</a>
                    <a href="">View all</a>
                </div>

                <ul>
                    @foreach($users as $user)
                    <li>
                        <div class="profile">
                            <img src="images/avatar.png" alt="Avatar">
                            <div class="info">
                                <strong>{{$user->username}} <span>@botdogb</span></strong>
                                <form method="POST" action="{{ route('follow.user') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
{{--                                    <button>Follow</button>--}}
                                    <input type="submit" name="follow" class="button" placeholder="follow">
                                </form>
                            </div>
                        </div>
                        <a href="">x</a>
                    </li>
                        @endforeach
                </ul>

            </div>
        </aside>
    </div>
</div>


</body>
</html>
