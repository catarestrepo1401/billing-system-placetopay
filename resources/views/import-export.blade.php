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
                        <h1>Instructions to import:</h1>
                        <p> It is important to know that if the invoice already exists, it will not be imported again.
                            The supported formats for bulk importing invoices are as follows: xls, xlsx.
                            The imported fields are as follows: 'document_number', 'document_type', 'expired_at',
                            'delivery_at', 'subtotal', 'discount_rate', 'discount', 'net', 'tax_rate', 'tax', ' total ',
                            ' created_at ',' updated_at '. In other words, you must remove the 'id' field from the excel
                            file to later be able to import.
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
                                    {{ __('Export') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>{{ __('Users') }}</td>

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