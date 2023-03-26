<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use Illuminate\Http\{RedirectResponse,Request};

class UserController extends Controller{

    protected $userService;

    public function __construct(UserService $userService){
       $this->userService = $userService;
    }

    public function follow(Request $request): RedirectResponse{
        $this->userService->follow($request);
        return redirect()->back();
    }

}
