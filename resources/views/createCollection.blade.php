<x-indexMaster>

    @section('createCollection')

        <div class="feed__header">
            <h2>Create Collection</h2>
        </div>

        <div class="message_header_container">
            <div class="sticky-div"><a href="{{ route('show.bookmarks') }}">Bookmarks</a></div>
            <div class="sticky-div"><a href="{{ route('show.collection') }}">Collections</a></div>
        </div>

    <div class="form">
        <form action="{{ route('store.collection') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-container ic1">
                <label for="name">Collection Name</label>
                <input type="text" id="name" name="collection_name">
            </div>
            <div class="input-container ic1">
                <label for="description">Collection Description</label>
                <textarea id="description" name="comment"></textarea>
            </div>
                <label for="image">Collection Image</label>
                <input type="file" name="image_path">
            <div class="input-container ic1">
                <label for="posts">Add Posts</label>
                <select id="posts" name="posts" multiple>
                    <!-- options for bookmarked posts -->
                </select>
            </div>
            <button type="submit">Create Collection</button>
        </form>
    </div>
    @endsection
</x-indexMaster>

