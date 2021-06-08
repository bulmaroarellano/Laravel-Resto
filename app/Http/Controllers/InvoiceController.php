<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Requests\InvoiceUpdateRequest;

class InvoiceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Invoice::class);

        $search = $request->get('search', '');

        $invoices = Invoice::search($search)
            ->latest()
            ->paginate(5);

        return view('app.invoices.index', compact('invoices', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Invoice::class);

        $customers = Customer::pluck('dni', 'id');
        $events = Event::pluck('id', 'id');

        return view('app.invoices.create', compact('customers', 'events'));
    }

    /**
     * @param \App\Http\Requests\InvoiceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceStoreRequest $request)
    {
        $this->authorize('create', Invoice::class);

        $validated = $request->validated();

        $invoice = Invoice::create($validated);

        return redirect()
            ->route('invoices.edit', $invoice)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        return view('app.invoices.show', compact('invoice'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $customers = Customer::pluck('dni', 'id');
        $events = Event::pluck('id', 'id');

        return view(
            'app.invoices.edit',
            compact('invoice', 'customers', 'events')
        );
    }

    /**
     * @param \App\Http\Requests\InvoiceUpdateRequest $request
     * @param \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $validated = $request->validated();

        $invoice->update($validated);

        return redirect()
            ->route('invoices.edit', $invoice)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Invoice $invoice)
    {
        $this->authorize('delete', $invoice);

        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
