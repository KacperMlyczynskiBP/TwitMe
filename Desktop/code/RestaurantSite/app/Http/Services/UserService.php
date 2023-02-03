<?php

namespace App\Http\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\User;

class UserService
{
    public string $email;

    /**
     * @throws UserNotFoundException
     */
    public function findByEmail($email){
        $user=User::where('email', $email)->get()->first();
        if(!$user){
            throw new UserNotFoundException('user is not found by this email ' . $email);
        }
        return $user;
    }


    }
