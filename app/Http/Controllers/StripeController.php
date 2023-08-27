<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Support\Facades\DB;

class StripeController extends Controller
{
    public function __construct()
    {
        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);
    }


    public function checkout($id)
    {

        $content = Content::find($id);
        
        if (!$content) {
            return redirect('/');
        }
        
        $user = $content->user;
        $amount = $content->price;
        $product = $content->title;
        $product_desc = $content->description;
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [

                [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $amount*100,  // Amount in cents, so $500 is 50000 cents
                        'product_data' => [
                            // 'creator' => $user->name,
                            'name' => $product,
                            'description' => $product_desc,
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        session()->put('transaction',['user'=>$user->id,'amount'=>$amount]);
        return redirect()->away($checkout_session->url);
    }

    function success() {
        if (session()->has('transaction')) {
            ['user'=>$user_id, 'amount'=>$amount] = session()->pull('transaction');
            $deduction_ratio = 20;
            DB::select('call deposit(?,?,?)',[$amount,$deduction_ratio,$user_id]);
            return view('pages.success')->with('message','Purchasing successful');
        }else{
            return redirect('/');
        }
    }
}
