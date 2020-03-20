@extends('layouts.app')

@section('layout')
    <div id="app">
        @include('partials.main-menu')

        <main class="py-4">
            <div class="container">
                {!! Alert::render() !!}

                @yield('content')
            </div>
        </main>
    </div>
@endsection