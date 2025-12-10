<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\EventStoreRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request): View|Factory|Application
    {
        $search = $request->input('search');
        $events = Event::with('organizer')
        ->when($search, fn($query) => $query->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate(5);
        return view('events/index', compact('events'));
    }

    public function create(): Factory|View
    {
        $organizers = Organizer::all();
        return view('events/create', compact('organizers'));
    }

    public function store(EventStoreRequest $request): RedirectResponse
    {
        Event::create($request->validated());
        return redirect()->route('events.index')->with('success', 'Event created!');
    }

    public function edit(Event $event): View|Factory|Application
    {
        $organizers = Organizer::all();
        return view('events/edit', compact('event', 'organizers'));
    }
    public function update(EventUpdateRequest $request, Event $event): RedirectResponse
    {
        $event->update($request->validated());

        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function show(Event $event): View|Factory|Application
    {
        $event->loadMissing('organizer');

        return view('events/show', compact('event'));
    }

    public function destroy(Event $event ): RedirectResponse
    {
        $event->loadMissing('organizer')->delete();
        $event->delete();


        return redirect()
            ->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }
}
