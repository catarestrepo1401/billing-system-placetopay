<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:dashboard'])->only('index');
        $this->middleware(['permission:dashboard.importExport'])->only('importExport');
    }

    /**
     * Show home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $role = $user->roles->implode('name', ', ');

        //dd($role);

        switch ($role) {
            case 'super-admin':
                $message = 'Welcome Super admin';

                return view('index', compact('message'));
                break;

            case 'moderator':
                $message = 'Welcome Moderator';

                return view('index', compact('message'));
                break;

            case 'guess':
                $message = 'Welcome Guess';

                return view('index', compact('message'));
                break;
        }
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
