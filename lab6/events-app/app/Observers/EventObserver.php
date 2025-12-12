<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        session()->flash('message', "New event is created: {$event->name}");
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        Log::info('Updated event: ' . $event->id, $event->getChanges());

        if ($event->isDirty('date')) {
            $originalDate = $event->getOriginal('date');
            Log::info("Event date '{$event->name}' is changed from {$originalDate} to {$event->date}");
        }
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        session()->flash('message', "Event '{$event->name}' is canceled.");
        Log::warning('Deleted/Canceled event: ' . $event->id);
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        //
    }
}
