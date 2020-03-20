@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Create item') }}</h1>
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'items.store', 'method' => 'POST']) !!}

                    @include('items.fields')

                    <div class="btn-group float-right">
                        <a href="{{ route('items.index') }}" class="btn">
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