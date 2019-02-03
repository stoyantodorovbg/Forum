<?php

namespace App\Policies;

use App\User;
use App\Models\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the reply.
     *
     * @param User $user
     * @param Reply $reply
     * @return bool
     */
    public function update(User $user, Reply $reply)
    {
        return $reply->user_id == $user->id;
    }

    public function create(User $user)
    {
        if(!auth()->user()) {
            return false;
        } else {
            return auth()->user()->hasRole('Banned');
        }
    }
}
