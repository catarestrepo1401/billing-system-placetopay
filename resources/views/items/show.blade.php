@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Item details') }}</h1>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <td colspan="3">{{ $item->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Type') }}</th>
                            <td>{{ __(ucfirst($item->type)) }}</td>
                            <th>{{ __('Price') }}</th>
                            <td>${{ number_format($item->price, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Registration date') }}</th>
                            <td>{{ $item->created_at->toDateString() }}</td>
                            <th>{{ __('Last update') }}</th>
                            <td>{{ $item->updated_at->toDateString() }}</td>
                        </tr>
                    </table>

                    {!! Form::open(['route' => ['items.destroy', $item], 'method' => 'DELETE']) !!}
                    <div class="btn-group float-right">
                        <a href="{{ route('items.edit', $item) }}" class="btn">
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