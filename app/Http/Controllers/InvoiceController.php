<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:dashboard.invoice'])->only(['index', 'show']);
        $this->middleware(['permission:dashboard.invoice.create'])->only(['create', 'store']);
        $this->middleware(['permission:dashboard.invoice.edit'])->only(['edit', 'update']);
        $this->middleware(['permission:dashboard.invoice.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = Invoice::ofDocumentNumber($request->get('document_number'))
            ->ofDocumentType($request->get('document_type'))
            ->ofExpiredDate($request->get('expired_at'))
            ->ofDeliveryDate($request->get('delivery_at'))
            ->ofTotal($request->get('total'))
            ->latest()
            ->paginate();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = new Invoice();

        return view('invoices.create', compact('invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        $invoice = new Invoice();

        if ($request->has('customer')) {
            $customer = User::findOrFail($request->get('customer'));
            $invoice->customer()->associate($customer);
        }

        $invoice->save();

        Alert::success(__('The record was successfully stored.'));

        return redirect()->route('invoices.show', $invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->fill($request->all());
        $invoice->update();

        Alert::success(__('The record was successfully updated.'));

        return redirect()->route('invoices.show', $invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        Alert::success(__('The record was successfully destroyed.'));

        return redirect()->route('invoices.index');
    }
}
