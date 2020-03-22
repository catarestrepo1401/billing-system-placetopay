@extends('layouts.default')

@section('content')
    <div class="d-flex justify-content-between align items-center mb-3">
        <div>
            <h1>{{ __('Payment manager') }}</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {!! Form::model(request()->all(), ['route' => 'payments.index', 'method' => 'GET', 'class' => 'mb-3']) !!}

            <div class="row">
                <div class="col-md-2">
                    {!! Field::select('status', ['unverified' => __('Unverified'), 'pending' => __('Pending'), 'rejected' => __('Rejected'), 'verified' => __('Verified')], null, ['tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    {!! Field::number('identifier', null, ['ph' => __('Identifier'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    {!! Field::select('method', ['debit_card' => __('Debit card'), 'credit_card'=> __('Credit card'), 'cash'=> __('Cash'), 'bank_payment'=> __('Bank payment'), 'pse'=> __('PSE'), 'pay_fees'=> __('Pay fees'), 'bank_check'=> __('Bank check'), 'electronic_transfer'=> __('Electronic transfer'), 'credit_note'=> __('Credit note')], null, ['tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    {!! Field::number('amount', null, ['ph' => __('Amount'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Filter') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Identifier') }}</th>
                    <th>{{ __('Method') }}</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Available date') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->created_at }}</td>
                        <td>{{ __(ucfirst($payment->status)) }}</td>
                        <td>{{ $payment->identifier }}</td>
                        <td>{{ __(ucfirst($payment->method)) }}</td>
                        <td>${{ number_format($payment->amount, 2, ',', '.') }}</td>
                        <td>{{ $payment->available_at }}</td>
                        <td>
                            <a href="{{ route('payments.show', $payment) }}" class="btn btn-primary btn-sm float-right">
                                {{  __('Details') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        {{ $payments->appends(request()->all())->links() }}
    </div>
</div>
@endsection