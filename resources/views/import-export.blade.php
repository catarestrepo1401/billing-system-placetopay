@extends('layouts.default')

@section('content')
    <div class="mb-3">
        <h1>Import & Export</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('Module') }}</th>
                            <th>{{ __('Import') }}</th>
                            <th>{{ __('Export') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ __('Invoices') }}</td>
                            <td>
                                {!! Form::open(['route' => 'import.invoices', 'method' => 'POST']) !!}
                                {!! Field::file('file',  ['tpl' => 'themes/bootstrap4/fields/unlabeled'])  !!}
                                {!! Form::close() !!}
                                    <a class="btn btn-primary" href="{{ route('import.invoices') }}" role="submit">
                                        {{ __('Import') }}
                                    </a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('export.invoices') }}" role="submit">
                                    {{ __('Export') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>{{ __('Users') }}</td>
                            <td>
                                {!! Form::open(['route' => 'import.users', 'method' => 'POST']) !!}
                                {!! Field::file('file',  ['tpl' => 'themes/bootstrap4/fields/unlabeled'])  !!}
                                {!! Form::close() !!}
                                <a class="btn btn-primary" href="{{ route('import.users') }}" role="submit">
                                    {{ __('Import') }}
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('export.users') }}" role="submit">
                                    {{ __('Export') }}
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection