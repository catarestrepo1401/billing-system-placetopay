@extends('layouts.default')

@section('content')
    <div class="d-flex justify-content-between align items-center mb-3">
        <div>
            <h1>{{ __('Item manager') }}</h1>
        </div>

        @can('dashboard.item.create')
            <div>
                <a href="{{ route('items.create') }}" class="btn btn-primary">
                    {{  __('Create') }}
                </a>
            </div>
        @endcan
    </div>

    <div class="card">
        <div class="card-body">
            {!! Form::model(request()->all(), ['route' => 'items.index', 'method' => 'GET', 'class' => 'mb-3']) !!}

            <div class="row">
                <div class="col-md-2">
                    {!! Field::select('type', ['product' => __('Product'), 'service' => __('Service')], null, ['tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    {!! Field::text('code', null, ['ph' => __('Code'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
                </div>
                <div class="col-md-2">
                    {!! Field::text('name', null, ['ph' => __('Name'), 'tpl' => 'themes/bootstrap4/fields/unlabeled']) !!}
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
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->created_at->toDateString() }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ __(ucfirst($item->type)) }}</td>
                        <td>{{ $item->name }}</td>
                        <td>${{ number_format($item->price, 2, ',', '.') }}</td>

                        @can('dashboard.item')
                            <td>
                                <a href="{{ route('items.show', $item) }}" class="btn btn-primary btn-sm float-right">
                                    {{  __('Details') }}
                                </a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $items->appends(request()->all())->links() }}
        </div>
    </div>
@endsection