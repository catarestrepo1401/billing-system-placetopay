<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Styde\Html\Facades\Alert;

class ExportController extends Controller
{
    public function invoices()
    {
        Alert::success(__('The invoices was successfully exported.'));

        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function users()
    {
        Alert::success(__('The users was successfully exported.'));

        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
