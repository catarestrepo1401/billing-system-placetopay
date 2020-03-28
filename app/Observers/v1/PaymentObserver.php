<?php

namespace App\Observers\v1;

use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentObserver
{
    /**
     * Handle the Payment "creating" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function creating(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "created" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "updating" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function updating(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
