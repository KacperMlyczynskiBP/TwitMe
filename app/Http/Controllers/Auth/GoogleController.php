<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class GoogleController
{
   public function redirect(){
       return SociaLite::driver('google')->redirect();
   }


   public function handleCallback(){
       try {
           $user = SociaLite::driver('google')->user();
           $findUser = User::where('google_id', $user->id)->first();

           if ($findUser) {
               Auth()->login($findUser);
               return redirect()->route('index');
           } else {
               $newUser=User::create([
                   'username'=>$user->name,
                   'password'=>Hash::make('google'),
                   'google_id'=>$user->id,
                   'email'=>$user->email,
               ]);
               Auth()->login($newUser);
               return redirect()->route('index');
      }
       } catch (\Exception $e){
//           return back()->withErrors($e->getMessage());
           dd('sss');
       }
   }
}
