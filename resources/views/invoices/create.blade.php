@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Create invoice') }}</h1>
    </div>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($invoice, ['route' => 'invoices.store', 'method' => 'POST']) !!}

                    {!! Field::select('customer') !!}

                    <div class="btn-group float-right">
                        @can('read invoices')
                        <a href="{{ route('invoices.index') }}" class="btn">
                            {{ __('Return') }}
                        </a>
                        @endcan
                        @can('create invoice')
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
                        </button>
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection