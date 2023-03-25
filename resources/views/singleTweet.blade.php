<x-indexMaster>
@section('singleTweet')
<div class="feed__header">
        <h2>Thread</h2>
    </div>

    <div class="post">
        <div class="post__avatar">
            <img
                    src="{{asset($user->user_image_path)}}"
            />
        </div>

        <div class="post__body">
            <div class="post__header">
                <div class="post__headerText">
                    <h3>
                        @inject('username','App\Helpers\FindUsername')
                        <div>{{$username->findUsername($post->user_id)}}</div>
                        <span class="post__headerSpecial"
                        ><span class="material-icons post__badge"> verified </span>@somanathg</span
                        >
                    </h3>
                </div>
                <div class="post__headerDescription">
                    <p>{{ $post->body }}</p>
                </div>
            </div>
            <img
                    src="{{asset($post->image_path)}}"
                    alt=""
            />
            <div class="post__footer">
                <span class="material-icons"> repeat </span>
                <a href="{{ route('like.tweet', ['postId'=>$post->id, 'userId'=>$post->user_id]) }}"><span
                            class="material-icons"> favorite_border </span></a>
                @inject('count','App\Helpers\CountLikes')
                <div><a href="{{ route('list.posts.likes', ['postId'=>$post->id]) }}">{{$count->countLikesOnTweets($post->id)}}</a></div>
                <a> Views: {{ $post->view_counts }}</a>

                <a href="{{ route('save.bookmark', ['postId'=>$post->id]) }}"><span class="material-icons"> publish </span></a>
            </div>
        </div>
    </div>

    <div class="tweetBox">
        <form action="{{ route('store.tweet.reply') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="tweetbox__input">
                <img
                        src="{{asset($userPath)}}"
                />
                <input type="text" name="body" placeholder="Tweet your reply"/>
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <input type="hidden" name="user_id" value="{{$user->id}}">

            </div>
            <div class="media">
                <label for="file-upload" class="custom-file-upload">
                    <img class="custom-file-upload" src="{{asset('images/R.jpg')}}"
                         height="20px" width="20px">
                    <input type="file" name="tweetMedia" class="custom-file-upload">
                </label>
            </div>
            <button name="tweetSubmit" class="tweetBox__tweetButton">Tweet</button>
        </form>
    </div>

    @foreach($comments as $comment)
        <div class="post">
            <div class="post__avatar">
                <img
                        src="{{asset($comment->user_image_path)}}"
                />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            @inject('username','App\Helpers\FindUsername')
                            <div>
                                <a href="{{ route('create.profile', ['id'=>$comment->user_id]) }}">{{$username->findUsername($comment->user_id)}}</a>
                            </div>
                            <span class="post__headerSpecial"
                            ><span class="material-icons post__badge"> verified </span>@somanathg</span
                            >
                        </h3>
                    </div>
                    <a href="{{ route('show.single', ['postId'=>$comment->id]) }}">
                        @inject('username','App\Helpers\FindUsername')
                        <div><h3>replying to</h3> <a href={{ route('create.profile', ['id'=>$comment->user_id]) }}">
                        @inject('username','App\Helpers\FindWhoToReply')
                         {{ $username->FindWhoToReply($comment->reply_id)}}</a></div>
                        <div class="post__headerDescription">
                            <p>{{ $comment->body }}</p>
                        </div>
                </div>
                <img
                                                src="{{asset($comment->image_path)}}"
                        alt=""
                />
                <div class="post__footer">
                    <span class="material-icons"> repeat </span>
                    <a href="{{ route('like.tweet', ['postId'=>$comment->id, 'userId'=>$comment->user_id]) }}"><span class="material-icons"> favorite_border </span></a>
                    @inject('count','App\Helpers\CountLikes')
                    <div><a href="{{ route('list.posts.likes', ['postId'=>$comment->id]) }}">{{$count->countLikesOnTweets($comment->id)}}</a></div>
                    <a href="{{ route('save.bookmark', ['postId'=>$comment->id]) }}"><span class="material-icons"> publish </span></a>
                </div>
            </div>
        </div>
        </a>
    @endforeach

@endsection
    </x-indexMaster>

