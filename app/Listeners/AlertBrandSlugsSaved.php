<?php

namespace App\Listeners;

use App\Events\BrandSlugsJsonSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AlertBrandSlugsSaved
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
    public function handle(BrandSlugsJsonSaved $event): void
    {
        dump('Hello!');
    }
}
