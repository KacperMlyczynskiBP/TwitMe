@extends('components.indexMaster')


@section('sidebar')
<div class="sidebar">
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
        <h2>Notifications</h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> mail_outline </span>
        <h2><a href="{{ route('create.messages') }}">Messages</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> bookmark_border </span>
        <h2>Bookmarks</h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> check </span>
        <h2><a href="{{ route('show.verificationFeatures') }}">TwittMe Blue</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> perm_identity </span>
        <h2><a href="{{ route('create.profile', ['id'=>Auth()->user()->id]) }}">Profile</a></h2>
    </div>

    <div class="sidebarOption">
        <span class="material-icons"> more_horiz </span>
        <div class="dropdown">
            <h2>More</h2>
            <div class="dropdown_content">
                <div class="sidebarOption-dropdown">

                </div>
            </div>
        </div>
    </div>
    <button class="sidebar__tweet">Tweet</button>
</div>

