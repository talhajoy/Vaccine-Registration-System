<?php

namespace App\Policies;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistrationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Registration $registration)
    {
        return $user->id === $registration->user_id || $user->isAdmin();
    }

    public function update(User $user, Registration $registration)
    {
        return $user->id === $registration->user_id || $user->isAdmin();
    }

    public function delete(User $user, Registration $registration)
    {
        return $user->isAdmin();
    }
}
