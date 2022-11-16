<?php

namespace App\Http\Controllers;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function follow(Request $request){
        (new UserService())->follow($request);
        return redirect()->back();
    }
}
