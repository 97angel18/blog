<?php

namespace App\Policies;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View roles');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Create roles');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Update roles');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role):bool
    {
        if($role->id === 1)
        {
            $this->deny('No se puede eliminar este role');
        }
        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete roles');
    }
}
