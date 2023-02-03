<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

//    public function __construct(){
//        $this->middleware('auth');
//    }

    public function showReservation(){
        $tables=\App\Models\Table::all();
        return view('reservation', compact('tables'));
    }

    public function showAdminReservation(){
        $reservations=Reservation::orderBy('reservationDate', 'desc')->paginate(7);
        return view('adminReservation', compact('reservations'));
    }

    public function reserveTable(ReservationStoreRequest $request){
        $input=$request->all();
        $reservation=Reservation::create($input);
        $table=\App\Models\Table::where('people_number', $request->people)->get()->first();
        $table->reservations()->save($reservation);
    }

}
