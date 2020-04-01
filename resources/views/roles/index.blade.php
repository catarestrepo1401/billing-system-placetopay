@extends('layouts.default')

@section('content')
    <div class="d-flex justify-content-between align items-center mb-3">
        <div>
            <h1>{{ __('Roles manager') }}</h1>
        </div>

        @can('dashboard.role.create')
            <div>
                <a href="{{ route('roles.create') }}" class="btn btn-primary">
                    {{  __('Create') }}
                </a>
            </div>
        @endcan
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('Created date') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Guard name') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->created_at->toDateString() }}</td>
                        <td>{{ __(ucfirst($role->name)) }}</td>
                        <td>{{ __(ucfirst($role->guard_name)) }}</td>

                        @can('dashboard.role')
                            <td>
                                <a href="{{ route('roles.show', $role) }}" class="btn btn-primary btn-sm float-right">
                                    {{  __('Details') }}
                                </a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $roles->appends(request()->all())->links() }}
        </div>
    </div>
@endsection