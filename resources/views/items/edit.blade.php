@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Edit item') }}</h1>
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($item, ['route' => ['items.update', $item], 'method' => 'PUT']) !!}

                    @include('items.fields')

                    <div class="btn-group float-right">
                        @can('dashboard.item')
                            <a href="{{ route('items.show', $item) }}" class="btn btn-info">
                                {{ __('Return') }}
                            </a>
                        @endcan

                        @can('dashboard.item.edit')
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