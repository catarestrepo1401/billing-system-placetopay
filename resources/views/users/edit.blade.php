@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>{{ __('Edit user') }}</h1>
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'PUT']) !!}

                    @include('users.fields')

                    <div class="btn-group float-right">
                        <a href="{{ route('users.show', $user) }}" class="btn">
                            {{ __('Return') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save changes') }}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection