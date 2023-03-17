<x-indexMaster>

    @section('bookmarks')

         <div class="feed__header">
                <h2>Bookmarks</h2>
            </div>

        {{--   posts start --}}
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
                                <span class="post__headerSpecial"
                                ><span class="material-icons post__badge"> verified </span><div>@ {{$username->findUsername($post->user_id)}}</div>
</span
>
                            </h3>
                        </div>
                        <a href="{{ route('show.single', ['postId'=>$post->id]) }}">
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
                        @inject('count','App\Helpers\CountLikes')
                        <div>{{$count->countLikesOnTweets($post->id)}}</div>
                        <span class="material-icons"> publish </span>
                    </div>
                    </a>
                </div>
            </div>
        @endforeach

@endsection
</x-indexMaster>
