<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payments = Payment::ofStatus($request->get('status'))
            ->ofIdentifier($request->get('identifier'))
            ->ofMethod($request->get('method'))
            ->ofAmount($request->get('amount'))
            ->latest()
            ->paginate();

        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment = new Payment();

        return view('payments.create', compact('payment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = new Payment();
        $payment->fill($request->all());

        if ($request->has('invoice')) {
            $invoice = Invoice::findOrFail($request->get('invoice'));
            $payment->invoice()->associate($invoice);
        }

        $payment->customer()->associate($payment->invoice->customer);

        $payment->save();

        Alert::success(__('The record was successfully stored.'));

        return redirect()->route('invoices.show', $payment->invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->fill($request->all());
        $payment->update();

        Alert::success(__('The record was successfully updated.'));

        return redirect()->route('payments.show', $payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        Alert::success(__('The record was successfully destroyed.'));

        return redirect()->route('payments.index');
    }
}
