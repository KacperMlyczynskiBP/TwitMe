<x-master>

    @include('navbar')

@section('reservation')
    <div class="reservation">
      <form method="POST" action="{{ route('reserve.table') }}">
          @csrf

          <div class="form">
              <div class="form-container">
              <div class="input-container ic1">
                  <input type="text" class="input" name="customerName" placeholder="" autofocus="autofocus" value=""><br>
                  <label for="firstname" class="placeholder">Full name</label>
              </div>
                  <div class="input-container ic1">
                      <input id="email" class="input" type="text" placeholder=" " />
                      <label for="email" class="placeholder">Email</label>
                  </div>
              <div class="input-container ic1">
                  <input type="datetime-local" class="input" name="reservationDate" placeholder="" value=""><br>
                  <label for="Reservation Date" class="placeholder">Reservation Date</label>
              </div>
                  <input type="hidden" name="table_id" value="">
                  <div class="input-container ic1">
                      <input type="text" class="input" name="people" placeholder="" value=""><br>
                      <label for="Number of people" class="placeholder">Number of people</label>
                  </div>


              <button type="text" name="submit" class="submit">submit</button>
              </div>
          </div>

{{--        <label>Full Name</label><br>--}}
{{--        <input type="text" name="customerName" placeholder="FirstName LastName" autofocus="autofocus" value=""><br>--}}
{{--        <label>Email address</label><br>--}}
{{--        <input type="text" name="customerEmail" value=""><br>--}}
{{--        <label>Arrival date*:</label><br>--}}
{{--        <input type="datetime-local" name="reservationDate" placeholder="m/d/y" value=""><br>--}}
{{--        <label>Number of people</label><br>--}}

{{--                  <input type="text" name="people" value=""><br>--}}
{{--        <label>Discount Coupon code:</label><br>--}}
{{--        <input type="text" name="dis_code" value=""><br>--}}
{{--          <button type="submit" name="submit">Reserve</button>--}}
      </form>
    </div>
    @endsection
</x-master>
