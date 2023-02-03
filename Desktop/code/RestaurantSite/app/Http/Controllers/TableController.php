<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TableController extends Controller
{

    protected $fillable=[
        'people_number',
    ];

//    public function __construct(){
//        $this->middleware('auth');
//    }

    public function showEditTable(){
        $tables=\App\Models\Table::all();
        $tables->sortBy('people_number');
        return view('editTable', compact('tables'));
    }

    public function showCreateTable(){
        $tables=\App\Models\Table::all();
        return view('createTable', compact('tables'));
    }

    public function createTable(Request $request){
         $input=$request->all();

         $table=\App\Models\Table::create($input);

    }


}
