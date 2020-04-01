@extends('layouts.blank')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
            <p class="text-center">
                @if ($payment->status == 'approved')
                    {{ __('YOUR PAYMENT WAS APPROVED.') }}
                @elseif($payment->status == 'rejected')
                    {{ __('YOUR PAYMENT WAS REJECTED.') }}
                @elseif($payment->status == 'pending')
                    {{ __('YOUR PAYMENT WAS PENDING.') }}
                @else
                    {{ __('YOUR PAYMENT COULD NOT BE PROCESSED.') }}
                @endif
            </p>
            </h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body text-center">
                <h5 class="card-title mb-2">
                    {{ __('DETAILS OF PAYMENT.') }}
                </h5>
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
                    <tr>
                        <td>{{ $payment->created_at->toDateString() }}</td>
                        <td>{{ $payment->identifier }}</td>
                        <td>{{ __(ucfirst($payment->method)) }}</td>
                        <td>${{ number_format($payment->amount, 2, ',', '.') }}</td>
                        <td>{{ __(ucfirst($payment->status)) }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                @can('dashboard')
                <a href="{{ route('home') }}" class="btn btn-primary btn-block">
                    {{ __('Return to billing-system') }}
                </a>
                @endcan
            </div>
        </div>
    </div>
@endsection