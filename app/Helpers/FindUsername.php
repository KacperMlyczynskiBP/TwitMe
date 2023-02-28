<?php

namespace App\Http\Helpers;

use App\Models\User;

class FindUsername
{
   public $username;

    public function findUsername($id){
        $username=User::findOrFail($id);
        return $username['username'];
    }

}
