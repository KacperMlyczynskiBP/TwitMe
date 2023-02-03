<x-adminMaster>

    @section('editFood')
        <div><h1><a href="{{ route('renderAddDish') }}">Add food</a></h1></div>
        {{--        <div><h1><a href="{{ route('') }}">Add discount</a></h1></div>--}}
        <div class="table">
            <div class="table-header">
                <div class="header__item"><a>Name</a></div>
                <div class="header__item"><a>Type</a></div>
                <div class="header__item"><a>Description</a></div>
                <div class="header__item"><a>Price</a></div>
            </div>
            <div class="table-content">
                @foreach($dish as $id=>$d)
                    <div class="table-row">

                        <div class="table-data">{{$d->name}}</div>
                        <div class="table-data">{{$d->dish_id}}</div>
                        <div class="table-data">{{$d->body}}</div>
                        <div class="table-data">{{$d->price}}</div>
                        <div> <td rowspan="2"> e & d</td></div>
                        <select name="">
                            <option></option>
                        </select>
                        {{--                    <div><livewire:discount :dishId="$d->id" :wire:key="$d->id" /></div>--}}
                    </div>
                @endforeach

            </div>
        </div>
    @endsection



</x-adminMaster>
