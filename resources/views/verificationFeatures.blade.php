<x-indexMaster>

    @section('verificationFeatures')

        @can('viewBlueVerifiedContent', Auth()->user())
            <div class="feed__header">
                <h2>What Twitter Blue gives you: </h2>
            </div>

            <div class="container">
                <h1>Twitter Blue Features</h1>
                <div class="feature">
                    <h2>Undo Tweet</h2>
                    <p>With Twitter Blue, you can undo a tweet within a certain time frame after you've posted it. Simply tap "Undo" and your tweet will not be visible to your followers.</p>
                </div>
                <div class="feature">
                    <h2>Collections</h2>
                    <p>Twitter Blue allows you to organize your favorite tweets into collections, so you can easily find them later. Create collections for different topics, events, or interests.</p>
                </div>
                <div class="feature">
                    <h2>Longer videos</h2>
                    <p>Post longer videos  You’ll finally be able to post longer videos to Twitter.</p>
                </div>
                <button class="feature-button"><a href="{{ route('show.numberVerification') }}">Cancel subscription</a></button>
            </div>
        @endcan



   @cannot('viewBlueVerifiedContent', Auth()->user())

    <div class="feed__header">
        <h2>Verification Features</h2>
    </div>

    <div class="container">
        <h1>Twitter Blue Features</h1>
        <div class="feature">
            <h2>Undo Tweet</h2>
            <p>With Twitter Blue, you can undo a tweet within a certain time frame after you've posted it. Simply tap "Undo" and your tweet will not be visible to your followers.</p>
        </div>
        <div class="feature">
            <h2>Collections</h2>
            <p>Twitter Blue allows you to organize your favorite tweets into collections, so you can easily find them later. Create collections for different topics, events, or interests.</p>
        </div>
        <div class="feature">
            <h2>Longer videos</h2>
            <p>Post longer videos  You’ll finally be able to post longer videos to Twitter.</p>
        </div>
        <button class="feature-button"><a href="{{ route('show.numberVerification') }}">Verify number</a></button>
    </div>
        @endcannot

@endsection

</x-indexMaster>
