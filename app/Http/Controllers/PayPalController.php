<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\UserGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function checkout(Request $request)
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $token = $paypal->getAccessToken();

        if (!isset($token['access_token'])) {
            return redirect()->route('response')->with('error', 'Failed to retrieve PayPal access token.');
        }

        $paypal->setAccessToken($token);

        $order = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => config('paypal.currency'),
                        "value" => $request->price
                    ],
                    "description" => $request->product
                ]
            ],
            "application_context" => [
                "cancel_url" => route('paypal.cancel'),
                "return_url" => route('paypal.success')
            ]
        ]);

        foreach ($order['links'] as $link) {
            if ($link['rel'] === 'approve') {
                return redirect()->away($link['href']);
            }
        }

        return redirect()->route('response')->with('error', 'Something went wrong.');
    }

    public function success(Request $request)
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $token = $paypal->getAccessToken();
        $paypal->setAccessToken($token);

        $result = $paypal->capturePaymentOrder($request->token);

        if ($result['status'] === 'COMPLETED') {
            $productName = $result['purchase_units'][0]['description'];

            $game = Game::where('title', $productName)->first();

            if ($game) {
                UserGame::create([
                    'user_id' => Auth::id(),
                    'game_id' => $game->id,
                ]);
            }

            return redirect()->route('response')->with('success', 'Payment Successful! Your purchased game is available in your library.');
        }

        return redirect()->route('response')->with('error', 'Payment failed. Please try again.');
    }

    public function cancel()
    {
        return redirect()->route('response')->with('error', 'Payment canceled.');
    }
}
