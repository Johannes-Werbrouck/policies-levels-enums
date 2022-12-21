<?php

namespace App\Policies;

use App\Enums\UserLevel;
use App\Models\User;
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
     * @param User $loggedInUser the user that's trying to update the level of $model
     * @param User $model the user whose level is being updated by the $loggedInUser
     * @return bool
     */
    public function updateLevel(User $loggedInUser, User $model)
    {
        // don't forget to import the UserLevel enum!
        if (UserLevel::Administrator == $loggedInUser->level)
        {
            // when deleting an Admin, check if there will be admins left
            if (UserLevel::Administrator == $model->level) return User::getNumberOfAdmins() > 1;
            else return true;
        }
        else return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $loggedInUser the user that's trying to delete $model
     * @param  \App\Models\User  $model the user that's being deleted by $loggedInUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $loggedInUser, User $model)
    {
        if (UserLevel::Administrator == $loggedInUser->level)
        {
            // when deleting an Admin, check if there will be admins left
            if ($loggedInUser->is($model)) return User::getNumberOfAdmins() > 1;
            else return true;
        }
        else return $loggedInUser->is($model);
    }
}
