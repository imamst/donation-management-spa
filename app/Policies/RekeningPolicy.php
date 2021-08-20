<?php

namespace App\Policies;

use App\Models\Amil;
use Illuminate\Auth\Access\HandlesAuthorization;

class RekeningPolicy
{
    use HandlesAuthorization;

    public function update(Amil $authenticatedUser)
    {
        return $authenticatedUser->role != "Amil Junior";
    }

    public function delete(Amil $authenticatedUser)
    {
        return ($authenticatedUser->role == "Admin") || ($authenticatedUser->role == "Super Admin");
    }
}
