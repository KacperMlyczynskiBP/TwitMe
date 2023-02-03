<x-adminMaster>

    @section('editReservation')
        <div><h1><a href="">Add Table</a></h1></div>
        <div class="table">
            <div class="table-header">
                <div class="header__item"><a>Active Reservation</a></div>
                <div class="header__item"><a>People that can seat:</a></div>
                <div class="header__item"><a>Availability:</a></div>
                <div class="header__item"><a>Customer name</a></div>
                <div class="header__item"><a>Customer email</a></div>
                <div class="header__item"><a>Reservation Date</a></div>
            </div>
            <div class="table-content">
{{--                NOT DONE YET PLEASE UPDATE--}}
                @foreach($reservations as $r)
                    <div class="table-row">
                              <?php $currentDate=\Carbon\Carbon::now(); ?>
                               <?php $secondDate=\Carbon\Carbon::now(); ?>
                                <?php $date=$r->reservationDate;?>
                              <?php $result=$currentDate->gt($date)?>
                                    @if($result === false)
//{{--                                  @if($r->reservationDate->ls($currentDate) === true)--}}
                             <div class="table-data"><h1><a href="">Active</a></h1></div>
                                  @else
                                      <div class="table-data"><h1>Not Active</h1></div>
                                  @endif
                        <div class="table-data">{{$r->people}}</div>
                            <div class="table-data"></div>
                        <div class="table-data">{{$r->customerName}}</div>
                        <div class="table-data">{{$r->customerEmail}}</div>
                        <div class="table-data">{{$r->reservationDate}}</div>
                        <div> <td rowspan="2"> e & d</td></div><br>
                    </div>
                @endforeach

            </div>
            {{$reservations->links()}}
        </div>
    @endsection
</x-adminMaster>
