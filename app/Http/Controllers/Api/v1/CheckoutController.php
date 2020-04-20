<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Dnetix\Redirection\PlacetoPay;
use Dnetix\Redirection\Entities\Status;
use Dnetix\Redirection\Entities\Transaction;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

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

    public function execute(Request $request, $document_number)
    {
        $invoice = Invoice::where('document_number', $document_number)
            ->firstOrFail();

        $payment = new Payment();
        $payment->fill([
            'status' => 'pending',
            'method' => 'place_to_pay',
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

            return response()->json([
                'redirectUrl' => $response->processUrl(),
                'paymentId' => $payment->id
            ], 200);

        } else {
            Alert::info(__('Payment could not be made.'));
            return redirect()->route('invoices.show', $invoice);
        }
    }

    public function process(Request $request, Payment $payment)
    {
        $response = $this->placetopay->query($payment->identifier);

        $status = $response->status()->status();

        if ($response->isSuccessful()) {
            if ($status == 'APPROVED') {
                $payment->update(['status' => 'approved']);
            } elseif ($status == 'REJECTED') {
                $payment->update(['status' => 'rejected']);
            } elseif ($status == 'PENDING') {
                $payment->update(['status' => 'pending']);
            } elseif ($status == 'FAILED') {
                $payment->update(['status' => 'failed']);
            } else {
                return $status .' es un status no verificado, contacte al administrador';
            }

            return response()->json([
                'status' => $payment->status,
                'paymentId' => $payment->id
            ], 200);
        }
    }

    public function finalized(Payment $payment)
    {
        return response()->json([
            'payment_identifier' => $payment->identifier,
            'message' => 'Your payment was '.$payment->status,
        ], 200);
    }
}