<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GoogleService
{


    public function storeUser($input){
        return User::create([
            'username'=>$input['name'],
            'password'=>Hash::make('google'),
            'google_id'=>$input['id'],
            'email'=>$input['email'],
            'date_of_birth'=>$input['date_of_birth'],
            'user_image_path'=>'https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png',
        ]);
    }
}
