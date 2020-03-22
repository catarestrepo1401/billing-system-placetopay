<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * @var PlacetoPay
     */
    private $placetopay;

    public function __construct()
    {
        $this->placetopay = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
            'type' => PlacetoPay::TP_REST
        ]);
    }

    public function index(Request $request, $document_number)
    {
        $invoice = Invoice::where('document_number', $document_number)
            ->firstOrFail();

        return view('checkouts.index', compact('invoice'));
    }

    public function execute(Request $request, $document_number)
    {
        $invoice = Invoice::where('document_number', $document_number)
            ->firstOrFail();

        $payment = new Payment();
        $payment->fill([
            'status' => 'pending',
            'method' => 'debit_card',
            'amount' => $invoice->total
        ]);
        $payment->invoice()->associate($invoice);
        $payment->customer()->associate($invoice->customer);
        $payment->save();

        $response = $this->placetopay->request([
            'payment' => [
                'reference' => $invoice->document_number,
                'description' => __('Bill payment'),
                'amount' => [
                    'currency' => 'COP',
                    'total' => $invoice->total,
                ],
            ],
            'expiration' => now()->addHour(24)->toIso8601String(),
            'returnUrl' => route('checkouts.process', $payment),
            'ipAddress' => request()->ip(),
            'userAgent' => request()->userAgent(),
        ]);

        if ($response->isSuccessful()) {
            $payment->update(['identifier' => $response->requestId]);

            return redirect()->to($response->processUrl());
        } else {
            dd($response->status()->message());
        }
    }

    public function process(Request $request, Payment $payment)
    {
        $response = $this->placetopay->query($payment->identifier);

        if ($response->isSuccessful()) {
            if ($response->status()->isApproved()) {

                $payment->update(['status' => 'finalizado']);
                $payment->invoice()->update(['status' => 'pagada']);
            }
        } else {

            dd($response->status()->message());
            $payment->update(['status' => 'fallido']);
        }
    }
}
