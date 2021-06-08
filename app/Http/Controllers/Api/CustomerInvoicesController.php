<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceCollection;

class CustomerInvoicesController extends Controller
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

        $invoices = $customer
            ->invoices()
            ->search($search)
            ->latest()
            ->paginate();

        return new InvoiceCollection($invoices);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Customer $customer)
    {
        $this->authorize('create', Invoice::class);

        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'due_at' => ['nullable', 'date', 'date'],
            'paid_at' => ['nullable', 'date', 'date'],
            'event_id' => ['required', 'exists:events,id'],
        ]);

        $invoice = $customer->invoices()->create($validated);

        return new InvoiceResource($invoice);
    }
}
