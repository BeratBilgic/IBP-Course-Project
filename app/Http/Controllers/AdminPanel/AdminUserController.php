<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('admin.user.index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data= User::find($id);
        $roles= Role::all();
        return  view('admin.user.show',[
            'data' => $data,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view('admin.user.edit',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->role = $request->role;
        $data->save();
        return redirect(route('admin.user.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data= User::find($id);
        $data->delete();
        return redirect(route('admin.user.index'));
    }

    public function addRole(Request $request, $id)
    {
        $data = new RoleUser();
        $data->user_id = $id;
        $data->role_id = $request->role_id;
        $data->save();

        return redirect()->route('admin.user.show', [
            'id'=>$id
        ]);
    }

    public function destroyRole(User $user, $uid, $rid)
    {
        $user = User::find($uid);
        $user->roles()->detach($rid);
        return redirect()->route('admin.user.show', [
            'id'=>$uid,
        ]);
    }
}
