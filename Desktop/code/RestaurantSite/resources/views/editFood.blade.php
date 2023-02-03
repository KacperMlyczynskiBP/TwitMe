<x-adminMaster>

    @section('editFood')
        <div><h1><a href="{{ route('renderAddDish') }}">Add food</a></h1></div>
    <div class="table">
        <div class="table-header">
            <div class="header__item"><a>Name</a></div>
            <div class="header__item"><a>Type</a></div>
            <div class="header__item"><a>Description</a></div>
            <div class="header__item"><a>Price</a></div>
        </div>
        <div class="table-content">
            @foreach($dishes as $id=>$dish)
            <div class="table-row">
                    <div class="table-data">{{$dish->name}}</div>
                    <div class="table-data">{{$dish->dish_id}}</div>
                    <div class="table-data">{{$dish->body}}</div>
                    <div class="table-data">{{$dish->price}}</div>
                    <div> <td rowspan="2">
                        <a>Edit</a>
                        <a href="{{ route('deleteDish', $dish->id) }}">Delete</a>
                        </td></div>
{{--                    <div><livewire:discount :dishId="$d->id" :wire:key="$d->id" /></div>--}}
            </div>
                 @endforeach

        </div>
    </div>
    @endsection



</x-adminMaster>
