<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Travel;
use Illuminate\Auth\Access\HandlesAuthorization;

class TravelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can update the travel.
     */
    public function update(User $user, Travel $travel)
    {
        return $user->id === $travel->user_id;
    }

    /**
     * Determine if the user can delete the travel.
     */
    public function delete(User $user, Travel $travel)
    {
        return $user->id === $travel->user_id;
    }
}
