@extends('layouts.default')

@section('content')
    {!! Form::model($invoice, ['route' => ['invoices.update', $invoice], 'method' => 'PUT']) !!}
    <div class="d-flex justify-content-between align-content-center mb-3">
        <div>
            <h1>{{ __('Edit invoice') }}</h1>
        </div>
        <div>
            <div class="btn-group">
                @can('read invoices')
                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-info">
                        {{ __('Return') }}
                    </a>
                @endcan

                @can('update invoice')
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save changes') }}
                    </button>
                @endcan

            </div>
        </div>
    </div>
    <div class="row">
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
                        <tr>
                            <td colspan="4">{!! Field::select('customer', null, $invoice->customer->id, ['tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}</td>
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
                            <td colspan="3">{!! Field::date('delivery_at', null, ['tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
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
        <div class="col-md-4 offset-md-8 mt-4">
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
                                {!! Field::text('discount', null, ['ph' => __('Discount'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Tax') }}</th>
                            <td>({{ round($invoice->tax_rate) }}%) ${{ number_format($invoice->tax, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Total') }}</th>
                            <td>${{ number_format($invoice->total, 2, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection