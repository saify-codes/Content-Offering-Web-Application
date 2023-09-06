<?php

namespace App\Listeners;

use App\Events\StoreLicenceKey;
use App\Models\Licence;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreLicenceKeyListener
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
    public function handle(StoreLicenceKey $event): void
    {
        Licence::create([
            'content_id' => $event->content_id,
            'key' => $event->license_key,
            'email' => $event->emial,
        ]);
    }
}
