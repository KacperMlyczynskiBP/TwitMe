<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function report(){

    }

    public function render($request){
        return view('userNotFound');
    }
}
