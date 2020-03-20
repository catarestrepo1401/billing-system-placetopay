@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('User details') }}</h1>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th>{{ __('Identification') }}</th>
                            <td colspan="3">{{ $user->identification }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('First name') }}</th>
                            <td colspan="3">{{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Last name') }}</th>
                            <td colspan="3">{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Email') }}</th>
                            <td colspan="3">{{ $user->email }}</td>
                        </tr>
                    </table>

                    {!! Form::open(['route' => ['users.destroy', $user], 'method' => 'DELETE']) !!}
                    <div class="btn-group float-right">
                        <a href="{{ route('users.edit', $user) }}" class="btn">
                            {{ __('Edit') }}
                        </a>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete') }}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection