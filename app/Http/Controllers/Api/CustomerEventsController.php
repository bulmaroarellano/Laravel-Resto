<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventCollection;

class CustomerEventsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Customer $customer)
    {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $events = $customer
            ->events()
            ->search($search)
            ->latest()
            ->paginate();

        return new EventCollection($events);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Customer $customer)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validate([
            'guests_number' => ['required', 'numeric'],
            'date' => ['nullable', 'date', 'date'],
            'start_our' => ['required', 'date_format:H:i:s'],
            'start_end' => ['required', 'date_format:H:i:s'],
        ]);

        $event = $customer->events()->create($validated);

        return new EventResource($event);
    }
}
