<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Exports\UsersExport;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Styde\Html\Facades\Alert;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:dashboard.invoices.exportExcel'])->only('invoices');
        $this->middleware(['permission:dashboard.invoices.exportCsv'])->only('invoices');
        $this->middleware(['permission:dashboard.invoices.exportTxt'])->only('invoices');
        $this->middleware(['permission:dashboard.users.exportExcel'])->only('users');
        $this->middleware(['permission:dashboard.users.exportCsv'])->only('users');
        $this->middleware(['permission:dashboard.users.exportTxt'])->only('users');
    }

    //invoices export
    public function invoices(Request $request)
    {
        $format = $request->get('format');
        // La función dd() o var_dump() muestra en pantalla el valor de su argumento
        // Te entrega todos los parámetros enviados mediante el request $request->all()
        //dd($request->all());
        // Te entrega solo el parámetro especifico enviados mediante el request $request->get('NOMBRE_DEL_PARAMETRO')
        //dd($request->get('format'));

        $date = now()->toDateTimeString();
        $name = "invoices";
        $fileName = str_replace('-', '_', Str::slug("$name $date"));

        if ($format == 'xlsx' || $format == 'csv') {
            Alert::success(__('The invoices was successfully exported.'));

            return Excel::download(new InvoicesExport, "$fileName.$format");
        } elseif ($format == 'txt') {
            $invoices = Invoice::all()->toJson();

            Storage::put("invoices/$fileName.$format", $invoices);

            Alert::success(__('The invoices was successfully exported.'));

            return Storage::download("invoices/$fileName.$format");
        } else {
            return 'Format not supported';
        }
    }

    //users export
    public function users(Request $request)
    {
        $format = $request->get('format');

        $date = now()->toDateTimeString();
        $name = "users";
        $fileName = str_replace('-', '_', Str::slug("$name $date"));

        if ($format == 'xlsx' || $format == 'csv') {
            Alert::success(__('The users was successfully exported.'));

            return Excel::download(new UsersExport, "$fileName.$format");
        } elseif ($format == 'txt') {
            $users = User::all()->toJson();

            Storage::put("users/$fileName.$format", $users);

            Alert::success(__('The users.txt was successfully exported.'));

            return Storage::download("users/$fileName.$format");
        } else {
            return 'Format not supported';
        }
    }
}
