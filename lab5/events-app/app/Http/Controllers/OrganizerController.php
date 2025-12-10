<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organizer\OrganizerStoreRequest;
use App\Http\Requests\Organizer\OrganizerUpdateRequest;
use App\Models\Organizer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Factory|View
    {
        $search = $request->input('search');

        $organizers = Organizer::when($search, function ($query, $search) {
            $query->where('full_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('organizers/index', compact('organizers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('organizers/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizerStoreRequest $request): RedirectResponse
    {
        Organizer::create($request->validated());

        return redirect()->route('organizers.index')->with('success', 'Organizer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Organizer $organizer)
    {
        $events = $organizer->events;

        return view('organizers/show', compact('organizer', 'events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organizer $organizer): View|Factory
    {
        return view('organizers.edit', compact('organizer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizerUpdateRequest $request, Organizer $organizer): RedirectResponse
    {
        $organizer->update($request->validated());

        return redirect()->route('organizers.index')->with('success', 'Organizer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizer $organizer): RedirectResponse
    {
        $organizer->delete();

        return redirect()->route('organizers.index')->with('success', 'Organizer deleted successfully.');
    }
}
