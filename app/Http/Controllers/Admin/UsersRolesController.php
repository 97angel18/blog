<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersRolesController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->detach();
        if($request->filled('roles'))
        {
            $user->assignRole($request->roles);
        }
        return back()->withFlash('Los roles han sido actualizados');
    }
}
