<x-adminMaster>
    @section('createDishes')


         <form method="POST" action="{{ route('addDish') }}">
             <div class="form">
             @csrf
                 <div class="input-container ic1">
                     <input type="text" class="input" name="name" placeholder="" autofocus="autofocus" value=""><br>
                     <label for="name" class="placeholder">Dish Name</label>
                 </div>
                 <div class="input-container ic1">
                     <input type="text" class="input" name="weight" placeholder="" autofocus="autofocus" value=""><br>
                     <label for="weight" class="placeholder">Weight</label>
                 </div>
                 <div class="input-container ic1">
                     <input type="text" class="input" name="body" placeholder="" autofocus="autofocus" value=""><br>
                     <label for="body" class="placeholder">Body</label>
                 </div> <br>
                 <select class="input-select" name="dish_id">
                     @foreach($dishType as $dishT)
                     <option name="dish_name">{{$dishT->name}}</option>
                     @endforeach
                 </select>
             <input type="file" class="" name="image">
               <input type="submit" class="submit" name="submit">
             </div>
         </form>

    @endsection

</x-adminMaster>


{{--<div class="form">--}}
{{--    <div class="form-container">--}}
{{--        <div class="input-container ic1">--}}
{{--            <input type="text" class="input" name="customerName" placeholder="" autofocus="autofocus" value=""><br>--}}
{{--            <label for="firstname" class="placeholder">Full name</label>--}}
{{--        </div>--}}
{{--        <div class="input-container ic1">--}}
{{--            <input id="email" class="input" type="text" placeholder=" " />--}}
{{--            <label for="email" class="placeholder">Email</label>--}}
{{--        </div>--}}
{{--        <div class="input-container ic1">--}}
{{--            <input type="datetime-local" class="input" name="reservationDate" placeholder="" value=""><br>--}}
{{--            <label for="Reservation Date" class="placeholder">Reservation Date</label>--}}
{{--        </div>--}}
{{--        <input type="hidden" name="table_id" value="">--}}
{{--        <div class="input-container ic1">--}}
{{--            <input type="text" class="input" name="people" placeholder="" value=""><br>--}}
{{--            <label for="Number of people" class="placeholder">Number of people</label>--}}
{{--        </div>--}}


{{--        <button type="text" name="submit" class="submit">submit</button>--}}
{{--    </div>--}}
{{--</div>--}}
