<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlueCheckFormularRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;

class StripeController extends Controller
{
    public function handlePayment(BlueCheckFormularRequest $request){
      $user = Auth()->user();
      $expiry = $request->expiry;
      $exp_month = substr($expiry, 0, 2);
      $exp_year = '20' . substr($expiry, 3, 2);
//        4242424242424242

      Stripe::setApiKey('sk_test_51MlssGLtoAujopNlOdiELeOdzgRReZ1cXA3zHYE0op7eOQC1yAmqDM8NKo8vSXaLww6l1ZkMyUvfkaPp010PYi7R004vqmIHej');

      try {
          $token = \Stripe\Token::create([
              'card' => [
                  'number' => $request->credit_card,
                  'exp_month' => $exp_month,
                  'exp_year' => $exp_year,
                  'cvc' => $request->cvv,
                  'address_country' => $request->address_country,
                  'address_city' => $request->address_city,
              ],
          ]);

          $charge = Charge::create([
              'amount' => 200,
              'currency' => 'pln',
              'source' => $token->id,
              'description' => 'Payment for TwitMe Blue subscription',
          ]);


          if ($charge->status === Charge::STATUS_SUCCEEDED) {
               $user->blue_verified = true;
               $user->save();

              return redirect()->route('index');
          }
      } catch (\Exception $exception){
          return redirect()->back()->with('error', 'Error' . $exception->getMessage());
      }
    }
}
