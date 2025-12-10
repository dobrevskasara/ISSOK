<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $services = Service::all();

        $sum = Service::all()->count();
        $total = 0;

        $array = Service::all()->all();
        foreach ($array as $value) {
            $total = $total + $value->price;
        }


        return view('services/index', compact('services', 'sum', 'total'));
    }

    public function create()
    {
        return view('services/create');
    }

    public function store(Request $request): RedirectResponse
    {
        Service::query()->create($request->all());

        return redirect()->route('services.index');
    }

    public function edit(Service $service)
    {
        return view('services/edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $service->update($request->all());

        return redirect()->route('services.index');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('services.index');
    }
}
