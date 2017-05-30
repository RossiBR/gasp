<?php

namespace App\Policies;

use App\User;
use App\Grade;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class GradePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the grade.
     *
     * @param  \App\User  $user
     * @param  \App\Grade  $grade
     * @return mixed
     */
    public function view(User $user, Grade $grade)
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
     * Determine whether the user can update the grade.
     *
     * @param  \App\User  $user
     * @param  \App\Grade  $grade
     * @return mixed
     */
    public function update(User $user, Grade $grade)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the grade.
     *
     * @param  \App\User  $user
     * @param  \App\Grade  $grade
     * @return mixed
     */
    public function delete(User $user, Grade $grade)
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