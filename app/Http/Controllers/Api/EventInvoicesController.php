<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceCollection;

class EventInvoicesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Event $event)
    {
        $this->authorize('view', $event);

        $search = $request->get('search', '');

        $invoices = $event
            ->invoices()
            ->search($search)
            ->latest()
            ->paginate();

        return new InvoiceCollection($invoices);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $this->authorize('create', Invoice::class);

        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'due_at' => ['nullable', 'date', 'date'],
            'paid_at' => ['nullable', 'date', 'date'],
            'customer_id' => ['required', 'exists:customers,id'],
        ]);

        $invoice = $event->invoices()->create($validated);

        return new InvoiceResource($invoice);
    }
}
