<?php

namespace App\Policies;

use App\Models\Employe;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EmployePolicy
{
    /**
     * Determine whether the user can view any models.
     * tous le monde a le droit de voir
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * Un User a le droit de voir un employe en particulier
     */
    public function view(User $user, Employe $employe): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Employe $employe): bool
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Employe $employe): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Employe $employe): bool
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Employe $employe): bool
    {
        return false;
    }
}
