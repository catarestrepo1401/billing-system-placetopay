@extends('layouts.default')

@section('content')
    <div class="d-flex justify-content-between align-content-center mb-3">
        <div>
            <h1>{{ __('Invoice details') }}</h1>
        </div>
        <div>
            {!! Form::open(['route' => ['invoices.destroy', $invoice], 'method' => 'DELETE']) !!}
            <div class="btn-group">
                <a href="{{ route('invoices.index') }}" class="btn btn-light">
                    {{ __('Return') }}
                </a>
                <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-warning">
                    {{ __('Edit') }}
                </a>
                <button type="submit" class="btn btn-danger">
                    {{ __('Delete') }}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th>{{ __('Identification') }}</th>
                            <td colspan="3">{{ $invoice->customer->identification }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('First name') }}</th>
                            <td colspan="3">{{ $invoice->customer->first_name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Last name') }}</th>
                            <td colspan="3">{{ $invoice->customer->last_name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Email') }}</th>
                            <td colspan="3">{{ $invoice->customer->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th>{{ __('Document number') }}</th>
                            <td colspan="3">{{ $invoice->document_number }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Expired at') }}</th>
                            <td colspan="3">{{ $invoice->expired_at->toDateString() }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Delivery at') }}</th>
                            <td colspan="3">{{ optional($invoice->delivery_at)->toDateString() }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <thead>
                        <tr>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Unit price') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if ($invoice->items->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">
                                    {{ __('No items have been added.') }}
                                </td>
                            </tr>
                        @endif

                        @foreach($invoice->items as $item)
                            <tr>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->pivot->description }}</td>
                                <td>{{ $item->pivot->quantity }}</td>
                                <td>{{ $item->pivot->unit_price }}</td>
                                <td>{{ $item->pivot->total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3>{{ __('Payments') }}</h3>
                </div>
                <div>
                    <a href="{{ route('payments.create', ['invoice' => $invoice, 'total' => $invoice->total]) }}"
                       class="btn btn-primary btn-sm">
                        {{  __('Create') }}
                    </a>
                </div>
            </div>

            <table class="table table-sm">
                <thead>
                <tr>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Identifier') }}</th>
                    <th>{{ __('Method') }}</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice->payments as $payment)
                    <tr>
                        <td>{{ $payment->created_at->toDateString() }}</td>
                        <td>{{ $payment->identifier }}</td>
                        <td>{{ __(ucfirst($payment->method)) }}</td>
                        <td>${{ number_format($payment->amount, 2, ',', '.') }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>
                            <a href="{{ route('payments.show', $payment) }}" class="btn btn-primary btn-sm">
                                {{ __('Details') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="alert alert-primary" role="alert">
                <strong>{{ __('Payment link') }}</strong> {{ route('checkouts.index', $invoice->document_number) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th>{{ __('Subtotal') }}</th>
                            <td>${{ number_format($invoice->subtotal, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Net') }}</th>
                            <td>${{ number_format($invoice->net, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Discount') }}</th>
                            <td>({{ round($invoice->discount_rate) }}%)
                                ${{ number_format($invoice->discount, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Tax') }}</th>
                            <td>({{ round($invoice->tax_rate) }}%)
                                ${{ number_format($invoice->tax, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('total') }}</th>
                            <td>${{ number_format($invoice->total, 2, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection