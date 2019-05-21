<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Cart;
use Session;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index(){

        return view('checkout');
    }

    public function pay(){

        Stripe::setApiKey("sk_test_fVV0woA6z7j6SVZTnMVDRmVP");

        $token = request()->stripeToken;
        $charge = Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'Selling books',
            'source' => $token,
        ]);

        Session::flash('success', 'Purchased successfully');
        Cart::destroy();

        Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSuccessful);
        return redirect('/');
    }
}
