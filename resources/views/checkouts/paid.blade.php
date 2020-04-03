@extends('layouts.blank')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="alert alert-primary" role="alert">
                <h1 class="alert-heading text-success text-center">Well done!</h1>
                <h5 class="text-success text-center">The amount on this invoice has already been paid.</h5>
                <hr>
                <h4 class="text-center text-secondary mb-0"> Thank you for being up to date on your payments.</h4>
            </div>
        </div>
    </div>
@endsection