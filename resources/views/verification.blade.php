<x-indexMaster>

    @section('verification')

    <div class="feed__header">
        <h2>Verification</h2>
    </div>

    <div class="container">
    <h1>Subscribe to Twitter Blue</h1>
    <form method="POST" action="{{ route('handle.payment') }}">
        @csrf
        <label for="credit-card">Credit Card Number:</label>
        <input type="text" id="credit-card" name="credit_card" required><br><br>
        <label for="expiry">Expiry Date:</label>
        <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required><br><br>
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" required><br><br>
        <label for="address_city">City:</label>
        <input type="text" id="address_city" name="address_city" required><br><br>
        <label for="address_country">Country:</label>
        <input type="text" id="address_country" name="address_country" required><br><br>
        <input type="submit" value="Subscribe">
    </form>
</div>

     @endsection

</x-indexMaster>
