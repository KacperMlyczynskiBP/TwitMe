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
        if ($code === session()->get('code')) {
            return redirect()->route('show.verification');
        } else {
            return redirect()->back();
        }
    }


    public function sendSMSverification(phoneNumberRequest $request){
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');
        $twilio = new Client('AC2e8db15799de93a0e89e009822249ea6', '68b683b06816cd7230875303153a8259');
        $code = random_int(1111, 9999);

        try {
            session()->put('code', $code);
            $authMessage = $twilio->messages->create($request->phone_number, [
                'body' => 'Click Here to Authenticate' . ' ' . $code,
                'from' => +15077040512
            ]);

            return redirect()->route('enter.verification.code')->with('success', 'Authentication code sent successfully.');

        } catch (\Exception $exception) {

            return redirect()->back()>with('error', 'Error with authentication' . $exception->getMessage());        }
    }
}


