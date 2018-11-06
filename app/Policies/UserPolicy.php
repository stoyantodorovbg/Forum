<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can updates the givven profile
     *
     * @param User $user
     * @param User $signedIn
     * @return bool
     */
    public function update(User $user, User $signedIn)
    {
        return $user->id === $signedIn->id;
    }
}
