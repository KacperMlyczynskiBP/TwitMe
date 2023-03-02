<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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
