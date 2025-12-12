<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organizer\OrganizerStoreRequest;
use App\Http\Requests\Organizer\OrganizerUpdateRequest;
use App\Models\Organizer;
use App\Repositories\Event\EventRepository;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Organizer\OrganizerRepository;
use App\Repositories\Organizer\OrganizerRepositoryInterface;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    protected OrganizerRepositoryInterface $organizerRepository;
    protected EventRepositoryInterface $eventRepository;

    public function __construct(OrganizerRepositoryInterface $organizerRepository, EventRepositoryInterface $eventRepository)
    {
        $this->organizerRepository = $organizerRepository;
        $this->eventRepository = $eventRepository;
    }


    public function index()
    {
        $search = request()->input('search');
        $eventId = request()->input('event_id');

        $events = $this->eventRepository->all();

        $organizers = $this->organizerRepository->search($search);

        return view('organizers.index', compact('organizers', 'events', 'search', 'eventId'));
    }

    public function create()
    {
        $events = $this->eventRepository->paginate(100);

        return view('organizers.create', compact('events'));
    }

    public function store(OrganizerStoreRequest $request): RedirectResponse
    {
        $this->organizerRepository->create($request->validated());

        return redirect()->route('organizers.index')
            ->with('success', 'Organizer created successfully');
    }

    public function show($id): View|Factory|Application
    {
        $organizer = $this->organizerRepository->find($id);

        return view('organizers.show', compact('organizer'));
    }

    public function edit($id)
    {
        $organizer = $this->organizerRepository->find($id);

        return view('organizers.edit', compact('organizer'));
    }

    public function update(OrganizerUpdateRequest $request, $id)
    {
        $organizer = $this->organizerRepository->find($id);

        $this->organizerRepository->update($organizer, $request->validated());

        return redirect()
            ->route('organizers.index')
            ->with('success', 'Organizer updated successfully.');
    }

    public function destroy($id)
    {
        $organizer = $this->organizerRepository->find($id);

        $this->organizerRepository->delete($organizer);

        return redirect()->route('organizers.index')
            ->with('success', 'Organizer deleted successfully');
    }
}


//class OrganizerController extends Controller
//{
//    /**
//     * Display a listing of the resource.
//     */
//
//    protected OrganizerRepository $organizerRepository;
//
//    public function __construct(OrganizerRepository $organizerRepository)
//    {
//        $this->organizerRepository = $organizerRepository;
//    }
//
//    public function index(Request $request): Factory|View
//    {
//        $search = $request->input('search');
//
//        $organizers = Organizer::when($search, function ($query, $search) {
//            $query->where('full_name', 'like', "%{$search}%")
//                ->orWhere('email', 'like', "%{$search}%")
//                ->orWhere('phone', 'like', "%{$search}%");
//        })
//            ->latest()
//            ->paginate(5)
//            ->withQueryString();
//
//        return view('organizers/index', compact('organizers'));
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create(): View
//    {
//        return view('organizers/create');
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(OrganizerStoreRequest $request): RedirectResponse
//    {
//        Organizer::create($request->validated());
//
//        return redirect()->route('organizers.index')->with('success', 'Organizer created successfully.');
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(Organizer $organizer)
//    {
//        $events = $organizer->events;
//
//        return view('organizers/show', compact('organizer', 'events'));
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(Organizer $organizer): View|Factory
//    {
//        return view('organizers.edit', compact('organizer'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(OrganizerUpdateRequest $request, Organizer $organizer): RedirectResponse
//    {
//        $organizer->update($request->validated());
//
//        return redirect()->route('organizers.index')->with('success', 'Organizer updated successfully.');
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(Organizer $organizer): RedirectResponse
//    {
//        $organizer->delete();
//
//        return redirect()->route('organizers.index')->with('success', 'Organizer deleted successfully.');
//    }
//}

