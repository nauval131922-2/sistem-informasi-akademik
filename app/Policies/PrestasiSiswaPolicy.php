<?php

namespace App\Policies;

use App\Models\PrestasiSiswa;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrestasiSiswaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PrestasiSiswa $prestasiSiswa): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PrestasiSiswa $prestasiSiswa): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrestasiSiswa $prestasiSiswa): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PrestasiSiswa $prestasiSiswa): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PrestasiSiswa $prestasiSiswa): bool
    {
        //
    }
}
