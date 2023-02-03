<x-adminMaster>

    @section('editDishType')
        <div><h1><a href="{{ route('renderAddDish') }}">Add DishType</a></h1></div>
        <div class="table">
            <div class="table-header">
                <div class="header__item"><a>Name</a></div>
            </div>
            <div class="table-content">
                @foreach($dishType as $dT)
                    <div class="table-row">
                        <div class="table-data">{{$dT->name}}</div>
                        <div>E & D</div>
                    </div>
                @endforeach

            </div>
        </div>
    @endsection
</x-adminMaster>
