<?php

namespace App\Policies;

use App\User;
use App\Associado;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class AssociadoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the associado.
     *
     * @param  \App\User  $user
     * @param  \App\Associado  $associado
     * @return mixed
     */
    public function view(User $user, Associado $associado)
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
     * Determine whether the user can update the associado.
     *
     * @param  \App\User  $user
     * @param  \App\Associado  $associado
     * @return mixed
     */
    public function update(User $user, Associado $associado)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the associado.
     *
     * @param  \App\User  $user
     * @param  \App\Associado  $associado
     * @return mixed
     */
    public function delete(User $user, Associado $associado)
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