<x-adminMaster>

    @section('editTable')
        <div><h1><a href="{{ route('showCreateTable') }}">Add Table</a></h1></div>
        <div class="table">
            <div class="table-header">
                <div class="header__item"><a>Name:</a></div>
                <div class="header__item"><a>People that can seat:</a></div>
                <div class="header__item"><a>Availability:</a></div>
            </div>
            <div class="table-content">
                @foreach($tables as $table)
                    <div class="table-row">
                        <div class="table-data">{{$table->id}}</div>
                        <div class="table-data">{{$table->people_number}}</div>
                        <div class="table-data">{{$table->availability}}</div>
                        <div> <td rowspan="2"> e & d</td></div>
                    </div>
                @endforeach

            </div>
        </div>
    @endsection
</x-adminMaster>
