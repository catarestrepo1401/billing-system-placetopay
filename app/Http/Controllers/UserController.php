<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:dashboard.user'])->only(['index', 'show']);
        $this->middleware(['permission:dashboard.user.create'])->only(['create', 'store']);
        $this->middleware(['permission:dashboard.user.edit'])->only(['edit', 'update']);
        $this->middleware(['permission:dashboard.user.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::ofIdentification($request->get('identification'))
            ->ofFistName($request->get('first_name'))
            ->ofLastName($request->get('last_name'))
            ->ofEmail($request->get('email'))
            ->latest()
            ->paginate();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //dd($request->all());
        $user = new User();
        $user->fill($request->all());
        $user->save();

        Alert::success(__('The record was successfully stored.'));

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->identification = $request->get('identification');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->update();

        $user->syncRoles($request->get('roles'));

        return redirect()->route('users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        Alert::success(__('The record was successfully destroyed.'));

        return redirect()->route('users.index');
    }
}
