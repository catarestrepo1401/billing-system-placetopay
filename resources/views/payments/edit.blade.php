@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Edit payment') }}</h1>
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($payment, ['route' => ['payments.update', $payment], 'method' => 'PUT']) !!}

                    @include('payments.fields')

                    <div class="btn-group float-right">
                        @can('read payments')
                        <a href="{{ route('payments.show', $payment) }}" class="btn">
                            {{ __('Return') }}
                        </a>
                        @endcan

                        @can('update payment')
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save changes') }}
                        </button>
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection