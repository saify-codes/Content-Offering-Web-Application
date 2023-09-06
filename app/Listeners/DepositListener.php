<?php

namespace App\Listeners;

use App\Events\Deposit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DepositListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Deposit $event): void
    {
        $deduction_ratio = 20;
        DB::select('call deposit(?,?,?)',[$event->amount,$deduction_ratio,$event->user_id]);
    }
}
