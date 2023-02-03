<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
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
               return view('auth.enterBirthday', compact('user'));
      }
       } catch (\Exception $e){
           return back()->withErrors($e->getMessage());
       }
   }

    public function registerGoogleUser(\Illuminate\Http\Request $request){
        $input=$request->only('date_of_birth','name','email','id');
        $newUser=User::create([
            'username'=>$input['name'],
            'password'=>Hash::make('google'),
            'google_id'=>$input['id'],
            'email'=>$input['email'],
            'date_of_birth'=>$input['date_of_birth']
        ]);
        Auth()->login($newUser);
        return redirect()->route('index');
    }
}
