<?php

namespace App\Policies;

use App\Data;
use App\User;

class DataPolicy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */
     public function before($user, $ability) {
         if($user->isAdmin()) {
             return true;
         }
     }
     public function change(User $user, Data $data) {
         return $user->id === $data->user_id;
     }
}
