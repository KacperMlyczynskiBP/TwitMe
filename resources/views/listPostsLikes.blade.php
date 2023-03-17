<x-indexMaster>
@section('listPostsLikes')
<div class="feed__header">
        <h2>Users who liked post</h2>
    </div>


    {{--   posts start --}}
    @foreach($users as $user)
        <div class="post">
            <div class="post__avatar">
                <div class="profile-picture">
                    <img src="{{asset($user->user_image_path)}}" width="48px" height="48px">
                </div>
            </div>
            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            @inject('username','App\Helpers\FindUsername')
                            <div>
                                <a href="{{ route('create.profile', ['id'=>$user->id]) }}">{{$username->findUsername($user->id)}}</a>
                            </div>
                            <span class="post__headerSpecial"
                            ><span class="material-icons post__badge"> verified </span><div>@ {{$username->findUsername($user->id)}}</div>
</span
>
                        </h3>
                    </div>

                    <div class="post__headerDescription">

                    </div>
                </div>
                <img
                    src="/images/{{$user->image_path}}"
                    alt=""
                />
                <div class="post__footer">

                </div>
            </div>
        </div>
    @endforeach
    @endsection
</x-indexMaster>
