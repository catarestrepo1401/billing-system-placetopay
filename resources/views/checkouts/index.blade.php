@extends('layouts.blank')

@section('content')
    <div class="card">
        <div class="card-body">
            {{ Form::open(['route' => ['checkouts.execute', $invoice->document_number], 'method' => 'POST']) }}
            <h5 class="text-center">
                {{ __('Amount payable') }}
            </h5>

            <h1 class="text-center">
                ${{ number_format($invoice->total, 2, ',', '.') }}
            </h1>

            <p class="text-center">
                {{ __('Your payment will be processed securely, through a payment processor.') }}
            </p>

            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <img src="https://dev.placetopay.com/web/wp-content/uploads/2020/03/p2p-logo-default.svg"
                         class="img-fluid" alt="Placetopay">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                Continuar
            </button>
            {{ Form::close() }}
        </div>
    </div>
@endsection