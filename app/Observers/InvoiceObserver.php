<?php

namespace App\Observers;

use App\Models\Invoice;
use Illuminate\Support\Str;

class InvoiceObserver
{
    /**
     * Handle the invoice "creating" event.
     *
     * @param \App\Models\Invoice $invoice
     * @return void
     */
    public function creating(Invoice $invoice)
    {
        if (!$invoice->document_number){
            $invoice->document_number = Str::random(8);
        }

        if (!$invoice->document_type){
            $invoice->document_type = 33;
        }

        if (!$invoice->expired_at){
            $invoice->expired_at = now()->addDays(30);
        }

        if (auth()->check()) {
            $invoice->user()->associate(auth()->user());
        }
    }

    /**
     * Handle the invoice "created" event.
     *
     * @param \App\Models\Invoice $invoice
     * @return void
     */
    public function created(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the invoice "updated" event.
     *
     * @param \App\Models\Invoice $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the invoice "deleted" event.
     *
     * @param \App\Models\Invoice $invoice
     * @return void
     */
    public function deleted(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the invoice "restored" event.
     *
     * @param \App\Models\Invoice $invoice
     * @return void
     */
    public function restored(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the invoice "force deleted" event.
     *
     * @param \App\Models\Invoice $invoice
     * @return void
     */
    public function forceDeleted(Invoice $invoice)
    {
        //
    }
}
