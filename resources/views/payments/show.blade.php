@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Payment details') }}</h1>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th>{{ __('Status') }}</th>
                            <td colspan="3">{{ $payment->status }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Identifier') }}</th>
                            <td colspan="3">{{ $payment->identifier }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Method') }}</th>
                            <td colspan="3">{{ $payment->method }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Amount') }}</th>
                            <td colspan="3">{{ $payment->amount }}</td>
                        </tr>
                    </table>

                    {!! Form::open(['route' => ['payments.destroy', $payment], 'method' => 'DELETE']) !!}
                    <div class="btn-group float-right">
                        <a href="{{ route('payments.edit', $payment) }}" class="btn">
                            {{ __('Edit') }}
                        </a>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete') }}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection