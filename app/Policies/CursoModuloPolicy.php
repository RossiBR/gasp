<?php

namespace App\Policies;

use App\User;
use App\CursoModulo;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class CursoModuloPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the cursoModulo.
     *
     * @param  \App\User         $user
     * @param  \App\CursoModulo  $cursoModulo
     * @return mixed
     */
    public function view(User $user, CursoModulo $cursoModulo)
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
     * Determine whether the user can update the cursoModulo.
     *
     * @param  \App\User  $user
     * @param  \App\CursoModulo  $cursoModulo
     * @return mixed
     */
    public function update(User $user, CursoModulo $cursoModulo)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the cursoModulo.
     *
     * @param  \App\User  $user
     * @param  \App\CursoModulo  $cursoModulo
     * @return mixed
     */
    public function delete(User $user, CursoModulo $cursoModulo)
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