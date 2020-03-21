<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show import and export page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function importExport()
    {
        return view('import-export');
    }
}
