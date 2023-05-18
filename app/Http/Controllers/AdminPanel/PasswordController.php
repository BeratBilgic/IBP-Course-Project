<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class PasswordController extends Controller
{
    public function update(Request $request, UpdatesUserPasswords $updater, $id)
    {
        $User= User::find($id);
        $updater->update($User, $request->all());

        return redirect()->route('admin.user.edit', [
            'id'=>$id
        ]);
    }
}
