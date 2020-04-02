@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Create role') }}</h1>
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                    {!! Field::text('name', null, ['ph' => __('Name')]) !!}
                    <h4>{{ __('Permissions') }}</h4>
                    {!! Form::checkboxes('permissions', $permissions) !!}
                    <div class="btn-group float-right">
                        @can('dashboard.role')
                            <a href="{{ route('roles.index') }}" class="btn btn-info">
                                {{ __('Return') }}
                            </a>
                        @endcan
                        @can('dashboard.role.create')
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