<x-profileMaster>


    @section('tweets')

        @foreach($userTweets as $tweet)
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
                    <img height="500px" width="500px"
                         src="/images/{{$tweet->image_path}}"
                         alt=""
                    />
                    @endif

                    <div class="post__footer">
                        <span class="material-icons"> repeat </span>
                        <a href="{{ route('like.tweet', ['postId'=>$tweet->id]) }}"><span class="material-icons"> favorite_border </span></a>
                        @inject('count','App\Http\Helpers\CountLikes')
                        <div>{{$count->countLikesOnTweets($tweet->id)}}</div>
                        <span class="material-icons"> publish </span>
                    </div>
                </div>
            </div>
        @endforeach

    @endsection


</x-profileMaster>

