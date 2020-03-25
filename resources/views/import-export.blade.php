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
                            <th>{{ __('Import .xls & .xlsx') }}</th>
                            <th>{{ __('Export .xlsx') }}</th>
                            <th>{{ __('Export .csv') }}</th>
                            <th>{{ __('Export .txt') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <h1>Instructions to import:</h1>
                        <p> 1. It is important to know that if the invoice or user files already exist, they will not be imported again.
                            <br>
                            2. The supported formats for bulk import of invoices and users are as follows: xls and xlsx.
                            <br>
                            3. The 'id' field (the first column) must be removed from the excel file to be able to import later, since if it is not deleted the 'id' would be duplicated.
                        </p>
                        <tr>
                            <td>{{ __('Invoices') }}</td>
                            <td>
                                <form action="{{ route('import.invoices') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file">
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('export.invoices') }}" role="submit">
                                    {{ __('Export .xlsx') }}
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('export.invoicescsv') }}" role="submit">
                                    {{ __('Export .csv') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>{{ __('Users') }}</td>
                            <td>
                                <form action="{{ route('import.users') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file">
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('export.users') }}" role="submit">
                                    {{ __('Export .xlsx') }}
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('export.userscsv') }}" role="submit">
                                    {{ __('Export .csv') }}
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