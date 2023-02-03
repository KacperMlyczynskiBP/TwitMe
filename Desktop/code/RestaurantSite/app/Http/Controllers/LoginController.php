<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Services\UserService;


class loginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }



    public function renderLogin(){
         return view('login');
    }

    public function renderRegister(){
        return view('register');
    }

    public function register(Request $request){
        $input=$request->except(['_token','submit']);
        $password=$input['password'];
//        $hashedPassword=hash::make($password);
//        $input['password']=$hashedPassword;
//        dd($input)
        $user=User::create([
           'name'=>$input['name'],
           'password'=> hash::make($password),
           'email'=>$input['email']
        ]);

//        $user=User::insert($input);
//        dd($user);
//        dd($user);
    }


    public function login(Request $request){
        $input=$request->all();
        $email=$input['email'];
        try{
            $user=(new UserService())->findByEmail($email);
            $credentials=[
                'email'=> $user['email'],
                'password'=>$input['password']
            ];

            if(Auth::attempt($credentials)){
                return redirect()->route('showEditTable');
            } else {
                return redirect()->route('showIndex');
            }

        }catch(UserNotFoundException $exception){
            return view('errors.userNotFound' , ['error'=>$exception->getMessage()]);
        }
//        $user=User::where('email', $email)->get()->first();
//        $credentials=[
//            'email'=> $user['email'],
//            'password'=>$input['password']
//        ];
//        if(Auth::attempt($credentials)){
//            return redirect()->route('showEditTable');
//        } else {
//            return redirect()->route('showIndex');
//        }
//        try{
//            $user=(new UserService())->findByEmail($email);
//
//                Session::put('user', $user->email);
//                return redirect()->route('showEditTable');
//
//        } catch(UserNotFoundException $exception){
//                   return view('errors.userNotFound' , ['error'=>$exception->getMessage()]);
//        }

//        else{
//            Session::put('user', $user->email);
//            return redirect()->route('showEditTable');
//        }
//                return redirect()->route('showIndex')->with('error', 'Wrong credentials');
    }
}
