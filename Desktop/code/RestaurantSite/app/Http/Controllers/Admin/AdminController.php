<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function renderView(){
        return view('adminDashboard');
    }
}



// implement better login, implement update, delete, implement opinions from google, create some TDD and practice, add sending mail by client// and getting
//them in admin dashboard,
// add discount menu in admin dashboard
// make pagination CURRENT //ad ui
