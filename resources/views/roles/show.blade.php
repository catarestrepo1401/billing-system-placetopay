@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Role details') }}</h1>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <td colspan="3">{{ __(ucfirst($role->name)) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Guard name') }}</th>
                            <td>{{ __(ucfirst($role->guard_name)) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Registration date') }}</th>
                            <td>{{ $role->created_at->toDateString() }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Last update') }}</th>
                            <td>{{ $role->updated_at->toDateString() }}</td>
                        </tr>
                            <div>
                                <th>{{ __('Permissions') }}</th>
                                <td>@foreach($role->permissions as $permission)
                                        <li class="list-group-item list-group-item-secondary">
                                            {{ $permission->name }}
                                        </li>
                                    @endforeach
                                </td>
                            </div>
                    </table>
                    {!! Form::open(['route' => ['roles.destroy', $role], 'method' => 'DELETE']) !!}
                    <div class="btn-group float-right">
                        @can('dashboard.role')
                            <a href="{{ route('roles.index', $role) }}" class="btn btn-info">
                                {{ __('Return') }}
                            </a>
                        @endcan
                        @can('dashboard.role.edit')
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-success">
                                {{ __('Edit') }}
                            </a>
                        @endcan
                        @can('dashboard.role.delete')
                            <button type="submit" class="btn btn-danger">
                                {{ __('Delete') }}
                            </button>
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection