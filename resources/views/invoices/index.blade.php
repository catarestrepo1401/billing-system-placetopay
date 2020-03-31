@extends('layouts.default')

@section('content')
    <div class="d-flex justify-content-between align items-center mb-3">
        <div>
            <h1>{{ __('Invoice manager') }}</h1>
        </div>

        @can('create invoice')
            <div>
                <a href="{{ route('invoices.create') }}" class="btn btn-primary">
                    {{  __('Create') }}
                </a>
            </div>
        @endcan
    </div>

    <div class="card">
        <div class="card-body">
            {!! Form::model(request()->all(), ['route' => 'invoices.index', 'method' => 'GET', 'class' => 'mb-3']) !!}

            <div class="row">
                <div class="col-md-2">
                    {!! Field::text('document_number', null, ['ph' => __('Document number'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    <h6>Expired date</h6>
                    {!! Field::date('expired_at', null, ['tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    <h6>Delivery date</h6>
                    {!! Field::date('delivery_at', null, ['tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    {!! Field::text('total', null, ['ph' => __('Total'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
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
                    <th>{{ __('Document number') }}</th>
                    <th>{{ __('Expired date') }}</th>
                    <th>{{ __('Delivery date') }}</th>
                    <th>{{ __('Customer') }}</th>
                    <th>{{ __('User') }}</th>
                    <th>{{ __('Net') }}</th>
                    <th>{{ __('Total') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->document_number }}</td>
                        <td>{{ $invoice->expired_at->toDateString() }}</td>
                        <td>{{ $invoice->delivery_at->toDateString() }}</td>
                        <td>{{ $invoice->customer->full_name }}</td>
                        <td>{{ $invoice->user->full_name }}</td>
                        <td>${{ number_format($invoice->net, 2, ',', '.') }}</td>
                        <td>${{ number_format($invoice->total, 2, ',', '.') }}</td>

                        @can('read invoices')
                            <td>
                                <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-primary btn-sm float-right">
                                    {{  __('Details') }}
                                </a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $invoices->appends(request()->all())->links() }}
        </div>
    </div>
@endsection