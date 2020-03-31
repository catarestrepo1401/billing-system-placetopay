@extends('layouts.default')

@section('content')
    <div class="d-flex justify-content-between align items-center mb-3">
        <div>
            <h1>{{ __('User manager') }}</h1>
        </div>

        @can('create user')
        <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                {{  __('Create') }}
            </a>
        </div>
        @endcan
    </div>

    <div class="card">
        <div class="card-body">
            {!! Form::model(request()->all(), ['route' => 'users.index', 'method' => 'GET', 'class' => 'mb-3']) !!}

            <div class="row">
                <div class="col-md-2">
                    {!! Field::text('identification', null, ['ph' => __('Identification'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    {!! Field::text('first_name', null, ['ph' => __('First name'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    {!! Field::text('last_name', null, ['ph' => __('Last name'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    {!! Field::text('email', null, ['ph' => __('Email'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Filter') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('Identification') }}</th>
                    <th>{{ __('First name') }}</th>
                    <th>{{ __('Last name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Rol') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->identification }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->rol }}</td>

                        @can('read users')
                        <td>
                            <a href="{{ route('users.show', $user) }}" class="btn btn-primary btn-sm float-right">
                                {{  __('Details') }}
                            </a>
                        </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $users->appends(request()->all())->links() }}
        </div>
    </div>
@endsection