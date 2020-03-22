@extends('layouts.app')

@section('layout')
    <div id="app">

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection