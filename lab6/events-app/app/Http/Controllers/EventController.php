<?php


//namespace App\Http\Controllers;
//
//use App\Http\Requests\Event\EventStoreRequest;
//use App\Http\Requests\Event\EventUpdateRequest;
//use App\Models\Event;
//use App\Models\Organizer;
//use App\Repositories\Event\EventRepositoryInterface;
//use App\Repositories\Organizer\OrganizerRepositoryInterface;
//use Illuminate\Contracts\View\Factory;
//use Illuminate\Contracts\View\View;
//use Illuminate\Foundation\Application;
//use Illuminate\Http\RedirectResponse;
//use Illuminate\Http\Request;

//class EventController extends Controller
//{
//
//    protected EventRepositoryInterface $eventRepo;
//
//    public function __construct(EventRepositoryInterface $eventRepo)
//    {
//        $this->eventRepo = $eventRepo;
//    }
//    public function index(Request $request): View|Factory|Application
//    {
//        $search = $request->input('search');
//        $events = Event::with('organizer')
//        ->when($search, fn($query) => $query->where('name', 'like', "%{$search}%"))
//            ->latest()
//            ->paginate(5);
//        return view('events/index', compact('events'));
//
//    }
//
//    public function create(): Factory|View
//    {
//        $organizers = Organizer::all();
//        return view('events/create', compact('organizers'));
//    }
//
//    public function store(EventStoreRequest $request): RedirectResponse
//    {
//        Event::create($request->validated());
//        return redirect()->route('events.index')->with('success', 'Event created!');
//
//    }
//
//    public function edit(Event $event): View|Factory|Application
//    {
//        $organizers = Organizer::all();
//        return view('events/edit', compact('event', 'organizers'));
//    }
//    public function update(EventUpdateRequest $request, Event $event): RedirectResponse
//    {
//        $event->update($request->validated());
//
//        return redirect()
//            ->route('events.index')->with('success', 'Event updated successfully.');
//
//    }
//
//    public function show(Event $event): View|Factory|Application
//    {
//        $event->loadMissing('organizer');
//
//        return view('events/show', compact('event'));
//
//    }
//
//    public function destroy(Event $event ): RedirectResponse
//    {
//        $event->loadMissing('organizer')->delete();
//        $event->delete();
//
//
//        return redirect()
//            ->route('events.index')->with('success', 'Event deleted successfully.');
//
//    }
//}

namespace App\Http\Controllers;

use App\Http\Requests\Event\EventStoreRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Models\Event;
use App\Models\Organizer;
use App\Repositories\Event\EventRepository;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Organizer\OrganizerRepository;
use App\Repositories\Organizer\OrganizerRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function Laravel\Prompts\search;

class EventController extends Controller
{
    protected EventRepositoryInterface $eventRepository;
    protected OrganizerRepositoryInterface $organizerRepository;

    public function __construct(EventRepositoryInterface $eventRepository, OrganizerRepositoryInterface $organizerRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->organizerRepository = $organizerRepository;
    }


    public function index()
    {
        $search = request()->input('search');

        $events = $this->eventRepository->search($search);

        return view('events.index', compact('events', 'search'));
    }

    public function create()
    {
        $organizers = $this->organizerRepository->all();

        return view('events.create', compact('organizers'));
    }

    public function store(EventStoreRequest $request): RedirectResponse
    {
        $this->eventRepository->create($request->validated());

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully');
    }

    public function show($id): View|Factory|Application
    {
        $event = $this->eventRepository->find($id);

        return view('events.show', compact('event'));
    }

    public function edit($id): View|Factory|Application
    {
        $event = $this->eventRepository->find($id);
        $organizer = $this->organizerRepository->all();

        return view('events.edit', compact('event','organizer'));
    }

    public function update(int $id, array $data): Event
    {
        $event = Event::findOrFail($id);
        $event->update($data);

        return $event;

    }

    public function destroy($id)
    {
        $event = $this->eventRepository->find($id);

        $this->eventRepository->delete($event);

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully');
    }
}

