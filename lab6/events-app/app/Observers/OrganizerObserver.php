<?php

namespace App\Observers;

use App\Models\Organizer;
use Illuminate\Support\Facades\Log;

class OrganizerObserver
{
    /**
     * Handle the Organizer "created" event.
     */
    public function created(Organizer $organizer): void
    {
        session()->flash('message', "New organizer is created: {$organizer->full_name}");
    }

    /**
     * Handle the Organizer "updated" event.
     */
    public function updated(Organizer $organizer): void
    {
        Log::info('Updated organizer: ' . $organizer->id, $organizer->getChanges());
    }

    /**
     * Handle the Organizer "deleted" event.
     */
    public function deleted(Organizer $organizer): void
    {
        Log::warning('Deleted organizer: ' . $organizer->id);
    }

    /**
     * Handle the Organizer "restored" event.
     */
    public function restored(Organizer $organizer): void
    {
        //
    }

    /**
     * Handle the Organizer "force deleted" event.
     */
    public function forceDeleted(Organizer $organizer): void
    {
        //
    }
}
