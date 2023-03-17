<?php

namespace App\Http\Controllers;

use App\Http\Requests\phoneNumberCodeRequest;
use App\Http\Requests\phoneNumberRequest;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class VerificateNumberController extends Controller
{

    public function enterVerificationCode(){
        return view('enterVerificationCode');
    }

    public function verification(){
        return view('verification');
    }

    public function verificateNumber(){
        return view('verificationNumber');
    }

    public function verificatePhoneNumber(phoneNumberCodeRequest $request){
        $code = array_values($request->only('validation_code'));
        $code = intval($code[0]);

        $number = session()->get('phone_number');
        $phone_number = substr($number, 3, 10);

        if ($code === session()->get('code')) {
            $user = Auth()->user();
            $user->phone_number = $phone_number;
            $user->phone_verified = true;
            $user->save();

            session()->forget('phone_number');

            return redirect()->route('show.verification');
        } else {
            return redirect()->back();
        }
    }


    public function sendSMSverification(phoneNumberRequest $request){
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');
        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
        $code = random_int(1111, 9999);

        try {
            $authMessage = $twilio->messages->create($request->phone_number, [
                'body' => 'Click Here to Authenticate' . ' ' . $code,
                'from' => $from
            ]);
            session()->put('phone_number', $request->phone_number);
            session()->put('code', $code);
            return redirect()->route('enter.verification.code')->with('success', 'Authentication code sent successfully.');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Error with authentication' . $exception->getMessage());
        }
    }
}


