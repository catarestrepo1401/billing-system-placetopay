<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\InvoiceResource;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $invoice = new Invoice();
        $query = $invoice->newQuery()
            ->ofDocumentNumber($request->get('document_number'))
            ->ofDocumentType($request->get('document_type'))
            ->ofExpiredDate($request->get('expired_at'))
            ->ofDeliveryDate($request->get('delivery_at'))
            ->ofTotal($request->get('total'))
            ->latest('updated_at');

        if ($request->has('no_paged')) {
            $invoices = $query->get();
        } else {
            $invoices = $query->paginate($request->get('per_page'));
        }

        return InvoiceResource::collection($invoices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return InvoiceResource
     */
    public function store(StoreInvoiceRequest $request)
    {
        $invoice = new Invoice;
        $invoice->fill($request->validated());
        $invoice->save();

        return new InvoiceResource($invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
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
        $invoice->fill($request->validated());
        $invoice->save();

        return new InvoiceResource($invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json('', 204);
    }
}
