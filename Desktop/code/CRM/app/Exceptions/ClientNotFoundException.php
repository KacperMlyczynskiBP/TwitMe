<?php

namespace App\Exceptions;

use Exception;

class ClientNotFoundException extends Exception
{
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view('errors.clientNotFound');
    }
}
