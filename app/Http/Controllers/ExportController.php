<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Styde\Html\Facades\Alert;

class ExportController extends Controller
{
    //invoices export
    public function invoices()
    {
        Alert::success(__('The invoices.xlsx was successfully exported.'));

        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function invoicescsv()
    {
        Alert::success(__('The invoices.csv was successfully exported.'));

        return Excel::download(new InvoicesExport, 'invoices.csv');
    }

    //users export
    public function users()
    {
        Alert::success(__('The users.xlsx was successfully exported.'));

        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function userscsv()
    {
        Alert::success(__('The users.csv was successfully exported.'));

        return Excel::download(new UsersExport, 'users.csv');
    }

}
