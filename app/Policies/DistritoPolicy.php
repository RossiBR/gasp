<?php

namespace App\Policies;

use App\User;
use App\Distrito;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class DistritoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the distrito.
     *
     * @param  \App\User  $user
     * @param  \App\Distrito  $distrito
     * @return mixed
     */
    public function view(User $user, Distrito $distrito)
    {
        return false;
    }

    /**
     * Determine whether the user can create associados.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the distrito.
     *
     * @param  \App\User  $user
     * @param  \App\Distrito  $distrito
     * @return mixed
     */
    public function update(User $user, Distrito $distrito)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the distrito.
     *
     * @param  \App\User  $user
     * @param  \App\Distrito  $distrito
     * @return mixed
     */
    public function delete(User $user, Distrito $distrito)
    {
        return false;
    }

    public function before($user, $ability)
    {
        Log::info('user: ' . $user->email . ' super_admin: ' . $user->super_admin);
        if ($user->super_admin == 1) {
            return true;
        }
        return false;
    }
}
//