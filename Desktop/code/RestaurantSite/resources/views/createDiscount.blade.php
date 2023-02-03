<x-adminMaster>
    @section('createDishes')


        <form method="POST" action="{{ route('addDish') }}">
            @csrf
            <label>
                <input type="text"  name="name" placeholder="dish"/>
            </label>
            <label>
                <input type="text" name="weight" placeholder="weight">
            </label>
            <label>
                <input type="text" name="body" placeholder="description">
            </label>
            <select name="dish_id">
                @foreach($dishType as $dishT)
                    {{--                         <input type="hidden" name="dishId" value="{{$dishT->id}}">--}}
                    <option name="dish_name">{{$dishT->name}}</option>
                @endforeach
            </select>
            <input type="file" class="image_style" name="image">
            <input type="submit" name="submit">

        </form>

    @endsection

</x-adminMaster>
