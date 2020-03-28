<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PaymentResource;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $payment = new Payment();
        $query = $payment->newQuery()
            ->ofStatus($request->get('status'))
            ->ofIdentifier($request->get('identifier'))
            ->ofMethod($request->get('method'))
            ->ofAmount($request->get('amount'))
            ->latest('updated_at');

        if ($request->has('no_paged')) {
            $payments = $query->get();
        } else {
            $payments = $query->paginate($request->get('per_page'));
        }

        return PaymentResource::collection($payments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return PaymentResource
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = new Payment;
        $payment->fill($request->validated());
        $payment->save();

        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Payment $payment
     * @return PaymentResource
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Payment $payment
     * @return PaymentResource
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->fill($request->validated());
        $payment->save();

        return new PaymentResource($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Payment $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json('', 204);
    }
}