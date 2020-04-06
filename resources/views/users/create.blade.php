@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Create user') }}</h1>
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}

                    {!! Field::number('identification', null, ['ph' => __('Identification')]) !!}
                    {!! Field::text('first_name', null, ['ph' => __('First name')]) !!}
                    {!! Field::text('last_name', null, ['ph' => __('Last name')]) !!}
                    {!! Field::email('email', null, ['ph' => __('Email')]) !!}
                    {!! Field::password('password', ['ph' => __('Password')]) !!}

                    <div class="btn-group float-right">
                        @can('dashboard.user')
                        <a href="{{ route('users.index') }}" class="btn">
                            {{ __('Return') }}
                        </a>
                        @endcan

                        @can('dashboard.user.create')
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