@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        {!! Form::model($role, ['route' => ['roles.update', $role->id],
                        'method' => 'PUT']) !!}

                        @include('roles.fields')

                        <div class="btn-group float-right">
                            @can('dashboard.role')
                                <a href="{{ route('roles.index') }}" class="btn btn-info">
                                    {{ __('Return') }}
                                </a>
                            @endcan
                            @can('dashboard.role.edit')
                                <button type="submit" class="btn btn-success">
                                    {{ __('Edit') }}
                                </button>
                            @endcan
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection