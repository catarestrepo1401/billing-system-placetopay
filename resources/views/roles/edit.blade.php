@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Edit role') }}</h1>
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($role, ['route' => ['roles.update', $role], 'method' => 'PUT']) !!}

                    {!! Field::text('name', null, ['ph' => __('Name')]) !!}

                    <div class="btn-group float-right">
                        @can('read roles')
                            <a href="{{ route('roles.show', $role) }}" class="btn btn-info">
                                {{ __('Return') }}
                            </a>
                        @endcan

                        @can('update role')
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