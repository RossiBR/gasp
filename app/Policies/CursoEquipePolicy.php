<?php

namespace App\Policies;

use App\User;
use App\CursoEquipe;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class CursoEquipePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the cursoEquipe.
     *
     * @param  \App\User  $user
     * @param  \App\CursoEquipe  $cursoEquipe
     * @return mixed
     */
    public function view(User $user, CursoEquipe $cursoEquipe)
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
     * Determine whether the user can update the cursoEquipe.
     *
     * @param  \App\User  $user
     * @param  \App\CursoEquipe  $cursoEquipe
     * @return mixed
     */
    public function update(User $user, CursoEquipe $cursoEquipe)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the cursoEquipe.
     *
     * @param  \App\User  $user
     * @param  \App\CursoEquipe  $cursoEquipe
     * @return mixed
     */
    public function delete(User $user, CursoEquipe $cursoEquipe)
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