<?php

namespace App\Policies;

use App\Models\Amil;
use Illuminate\Auth\Access\HandlesAuthorization;

class AmilPolicy
{
    use HandlesAuthorization;

    public function viewAny(Amil $authenticatedUser)
    {
        return $authenticatedUser->role == "Super Admin";
    }

    public function create(Amil $authenticatedUser)
    {
        return $authenticatedUser->role == "Super Admin";
    }

    public function update(Amil $authenticatedUser)
    {
        return $authenticatedUser->role == "Super Admin";
    }

    public function delete(Amil $authenticatedUser)
    {
        return $authenticatedUser->role == "Super Admin";
    }
}
