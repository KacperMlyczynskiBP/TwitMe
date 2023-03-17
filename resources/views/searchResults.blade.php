<x-indexMaster>
@section('searchResults')
<div class="feed__header">
        <h2>Home</h2>
    </div>

    <!-- tweetbox starts -->
    <div class="tweetBox">
        <form action="{{ route('store.tweet') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="tweetbox__input">
                <div class="profile-picture">
                    <img src="{{asset($path)}}" width="48px" height="48px">
                </div>
                <input type="text" name="body" placeholder="What's happening?"/>
            </div>

            <div class="media">
                <label for="file-upload" class="custom-file-upload">
                    <img class="custom-file-upload" src="{{asset('images/R.jpg')}}"
                         height="20px" width="20px">
                    <input type="file" name="tweetMedia" class="custom-file-upload">
                </label>
            </div>
            <button type="submit" name="tweetSubmit" class="tweetBox__tweetButton">Tweet</button>
        </form>
    </div>

    <!-- tweetbox ends -->
    {{--   posts start --}}
    @foreach($results as $result)
        <div class="post">
            <div class="post__avatar">
                <div class="profile-picture">
                    <img src="{{asset($result->user_image_path)}}" width="48px" height="48px">
                </div>
            </div>
            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            @inject('username','App\Helpers\FindUsername')
                            <div>
                                <a href="{{ route('create.profile', ['id'=>$result->user_id]) }}">{{$username->findUsername($result->user_id)}}</a>
                            </div>
                            <span class="post__headerSpecial"
                            ><span class="material-icons post__badge"> verified </span><div>@ {{$username->findUsername($result->user_id)}}</div>
</span
>
                        </h3>
                    </div>
                    <a href="{{ route('show.single', ['postId'=>$result->id]) }}">
                        <div class="post__headerDescription">
                            <p>{{ $result->body }}</p>
                        </div>
                </div>
                <img
                        src="/images/{{$result->image_path}}"
                        alt=""
                />
                <div class="post__footer">
                    <span class="material-icons"> repeat </span>
                    <a href="{{ route('like.tweet', ['postId'=>$result->id]) }}"><span class="material-icons"> favorite_border </span></a>
                    @inject('count','App\Helpers\CountLikes')
                    <div>{{$count->countLikesOnTweets($result->id)}}</div>
                    <a href="{{ route('save.bookmark', ['postId'=>$result->id]) }}"><span class="material-icons"> publish </span></a>
                </div>
                </a>
            </div>
        </div>
    @endforeach
    @endsection
    </x-indexMaster>
