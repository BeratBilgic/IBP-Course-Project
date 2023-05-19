<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\PasswordUpdateResponse;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data= User::find($id);
        $roles= Role::all();
        return  view('admin.profile.edit',[
            'data' => $data,
            'roles' => $roles
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
        $data->save();
        $roles= Role::all();
        return redirect()->route('admin.profile.edit', [
            'id'=>$id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data= User::find($id);
        $data->delete();
        return redirect(route('logoutuser'));
    }

    public function addRole(Request $request, $id)
    {
        $exists = RoleUser::where('user_id', $id)
            ->where('role_id', $request->role_id)
            ->exists();
        if (!$exists) {
            $data = new RoleUser();
            $data->user_id = $id;
            $data->role_id = $request->role_id;
            $data->save();
        }

        return redirect()->route('admin.profile.edit', [
            'id'=>$id
        ]);
    }

    public function destroyRole(User $user, $uid, $rid)
    {
        $user = User::find($uid);
        $user->roles()->detach($rid);
        return redirect()->route('admin.profile.edit', [
            'id'=>$uid,
        ]);
    }

    public function updatePassword(Request $request, UpdatesUserPasswords $updater)
    {
        $updater->update($request->user(), $request->all());

        return app(PasswordUpdateResponse::class);
    }
}
