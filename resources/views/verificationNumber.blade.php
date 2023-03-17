    <x-indexMaster>

    @section('verificationNumber')

    <div class="feed__header">
        <h2>Number verification </h2>
    </div>

    <div class="container">
        <h1>Verify your phone number</h1>
        <div class="feature">
         <form method="POST" action="{{ route('send.sms.verification') }}">
             @csrf
             <input type="text" name="phone_number">
             <button type="submit" class="feature-button">Send SMS verification</button>
         </form>
        </div>
    </div>

    @endsection

    </x-indexMaster>




