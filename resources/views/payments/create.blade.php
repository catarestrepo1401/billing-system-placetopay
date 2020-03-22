@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Create payment') }}</h1>
    </div>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($payment, ['route' => 'payments.store', 'method' => 'POST']) !!}

                    @include('payments.fields')

                    <div class="btn-group float-right">
                        <a href="{{ route('payments.index') }}" class="btn">
                            {{ __('Return') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection