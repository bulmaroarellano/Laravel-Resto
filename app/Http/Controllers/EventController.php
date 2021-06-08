<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;

class EventController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Event::class);

        $search = $request->get('search', '');

        $events = Event::search($search)
            ->latest()
            ->paginate(5);

        return view('app.events.index', compact('events', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Event::class);

        $customers = Customer::pluck('dni', 'id');

        return view('app.events.create', compact('customers'));
    }

    /**
     * @param \App\Http\Requests\EventStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventStoreRequest $request)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validated();

        $event = Event::create($validated);

        return redirect()
            ->route('events.edit', $event)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Event $event)
    {
        $this->authorize('view', $event);

        return view('app.events.show', compact('event'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $customers = Customer::pluck('dni', 'id');

        return view('app.events.edit', compact('event', 'customers'));
    }

    /**
     * @param \App\Http\Requests\EventUpdateRequest $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventUpdateRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validated();

        $event->update($validated);

        return redirect()
            ->route('events.edit', $event)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()
            ->route('events.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
