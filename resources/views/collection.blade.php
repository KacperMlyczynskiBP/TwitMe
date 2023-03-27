<x-indexMaster>

    @section('collection')

        <div class="feed__header">
            <h2>Collections</h2>
        </div>

        <div class="message_header_container">
            <div class="sticky-div"><a href="{{ route('show.bookmarks') }}">Bookmarks</a></div>
            <div class="sticky-div"><a href="{{ route('create.collection') }}">Create collection</a></div>
        </div>

        {{--   posts start --}}
        @foreach($collections as $collection)
            <div class="post">
                <div class="post__avatar">
                    <div class="profile-picture">
                        <img src="{{asset($collection->user_image_path)}}" width="48px" height="48px">
                    </div>
                </div>
                <div class="post__body">
                    <div class="post__header">
                        <div class="post__headerText">
                            <h3>

                                <span class="post__headerSpecial"
                                ><span class="material-icons post__badge"> verified </span><div></div>
</span>
                            </h3>
                        </div>
                        <a href="{{ route('show.single.collection', ['post'=>$post]) }}">
                            <div class="post__headerDescription">
                                <p>{{ $collection->body }}</p>
                            </div>
                    </div>
                    <img
                        src="/images/{{$collection->image_path}}"
                        alt=""
                    />
                    <div class="post__footer">
                        <span class="material-icons"> repeat </span>
                        <a href="#"><span
                                class="material-icons"> favorite_border </span></a>
                        <div><a href="#"></a></div>

                        <a href="#"><span class="material-icons"> publish </span></a>
                    </div>
                    </a>
                </div>
            </div>
        @endforeach

    @endsection
</x-indexMaster>
