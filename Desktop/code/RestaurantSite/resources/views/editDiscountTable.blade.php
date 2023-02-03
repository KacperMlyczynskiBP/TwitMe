<x-adminMaster>

    @section('editFood')
        <div><h1><a href="{{ route('renderAddDish') }}">Add Food</a></h1></div>
        <div class="table">
            <div class="table-header">
                <div class="header__item"><a>Name</a></div>
                <div class="header__item"><a>Type</a></div>
                <div class="header__item"><a>Description</a></div>
                <div class="header__item"><a>Price</a></div>
            </div>
            <div class="table-content">
                <form method="POST" action="{{ route('applyDiscount') }}"
                @foreach($dishes as $dish)
                    <div class="table-row">
                        <div class="table-data">{{$dish->name}}</div>
                        <div class="table-data">{{$dish->dish_id}}</div>
                        <div class="table-data">{{$dish->body}}</div>
                        <div class="table-data">{{$dish->price}}</div>
                        <div>
                            <select name="discount">
                                <?php for($i=0; $i++; $i<100);?>
                                <option>
                                    <?php echo $i; ?>
                             </option>
                            </select>
                        </div>
                    </div>
                @endforeach
                 <a href=""><h1>Apply discount</h1></a>
            </form>
            </div>
            </div>
        </div>
    @endsection
</x-adminMaster>
