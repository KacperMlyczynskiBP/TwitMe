<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Services\GoogleService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Laravel\Socialite\Facades\Socialite;


class GoogleController
{
    protected $googleService;

    public function __construct(GoogleService $googleService){
        $this->googleService = $googleService;
    }

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

        $this->googleService->storeUser($input);

        return redirect()->route('index');
    }
}
