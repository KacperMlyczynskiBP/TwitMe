       <x-indexMaster>

    @section('enterVerification')
    <div class="feed__header">
        <h2>Number verification </h2>
    </div>

    <div class="container">
        <h1>Verify your phone number with code</h1>
        <div class="feature">
            <form method="POST" action="{{ route('verificate.number') }}">
                @csrf
                <input type="text" name="validation_code">
                <button type="submit" class="feature-button">Enter code</button>
            </form>
        </div>
    </div>
    @endsection

        </x-indexMaster>

