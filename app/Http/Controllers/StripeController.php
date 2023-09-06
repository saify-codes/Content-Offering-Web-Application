<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Support\Facades\Event;
use App\Events\Deposit;
use App\Events\StoreLicenceKey;

class StripeController extends Controller
{

    public function __construct()
    {
    }


    public function checkout($id)
    {
        $content = Content::find($id);

        if (!$content) {
            return redirect()->back();
        }

        $licence_key = keygen();
        $user = $content->user;
        $amount = $content->price;
        $product = $content->title;
        $product_desc = $content->description;

        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [

                [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $amount * 100,  // Amount in cents, so $500 is 50000 cents
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
            'metadata' => [
                'creator_id' => $user->id,
                'content_id' => $content->id,
                'licence_key' => $licence_key,
                // Add more metadata fields if needed
            ],
        ]);

        session()->put('transaction', $licence_key);
        return redirect()->away($checkout_session->url);
    }

    function success()
    {
        $licence_key = session()->pull('transaction');
        if ($licence_key) {
            return view('pages.success', ['message' => 'Purchasing done', 'licence_key' => $licence_key]);
        }
        return redirect('/');
    }

    function cancel()
    {
        return session()->pull('transaction')
            ? view('pages.cancel', ['message' => 'Purchasing failed'])
            : redirect('/');
    }

    function payment_status()
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_9e34bb042c0d3929b4e844973e530100e74133d5d98aeb1ea5f2d1e58760af56';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('')->status(400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('')->status(400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                if ($session->payment_status === 'paid') {

                    // Extracting metadata
                    $creator_id = $session->metadata->creator_id;
                    $content_id = $session->metadata->content_id;
                    $licence_key = $session->metadata->licence_key;
                    $amount = $session->amount_total / 100; // divide by hundred to get amount in dollars$
                    $customer_email = $session->customer_details->email; // divide by hundred to get amount in dollars$
                    error_log($licence_key);
                    Event::dispatch(new Deposit($creator_id, $amount));
                    Event::dispatch(new StoreLicenceKey($content_id, $licence_key, $customer_email));
                }

            default:
                echo 'Received unknown event type ' . $event->type;
        }
    }
}
