<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Imports\InvoicesImport;
use App\Imports\UsersImport;
use App\Models\Invoice;
use http\Client\Request;
use Maatwebsite\Excel\Facades\Excel;
use Styde\Html\Facades\Alert;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:import invoices'])->only('invoices');
        $this->middleware(['permission:import users'])->only('users');
    }

    public function invoices(ImportRequest $request)
    {
        Excel::import(new InvoicesImport, $request->file('file'));

        Alert::success(__('The invoices was successfully imported.'));

        return redirect()->route('invoices.index');
    }

    public function users(ImportRequest $request)
    {
        Excel::import(new UsersImport, $request->file('file'));

        Alert::success(__('The users was successfully imported.'));

        return redirect()->route('users.index');
    }
}
