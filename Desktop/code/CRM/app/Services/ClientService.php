<?php

namespace App\Services;

use App\Events\SendEmailEvent;
use App\Models\Client;

class ClientService
{


    public function storeClient($request){
        Client::create($request->validated());
        Event(new SendEmailEvent($request->contact_email));
    }
}
