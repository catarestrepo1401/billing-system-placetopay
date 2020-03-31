@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                       <h1>Dashboard</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <h4 class="p-3 mb-2 bg-primary text-white text-center">
                                {{ $message }}
                            </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection