<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlueCheckFormularRequest;
use Illuminate\Http\RedirectResponse;
use Stripe\Charge;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function handlePayment(BlueCheckFormularRequest $request): RedirectResponse
    {
        $user = Auth()->user();
        $expiry = $request->expiry;
        $exp_month = substr($expiry, 0, 2);
        $exp_year = '20' . substr($expiry, 3, 2);
//        4242424242424242

        Stripe::setApiKey(config('services.stripe.secret'));

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
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Error' . $exception->getMessage());
        }
    }
}
