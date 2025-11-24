<?php

namespace App\Policies;

use App\Models\ExchangeAccount;
use App\Models\User;

class ExchangeAccountPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ExchangeAccount $account): bool
    {
        return $account->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ExchangeAccount $account): bool
    {
        return $account->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ExchangeAccount $account): bool
    {
        return $account->user_id === $user->id;
    }
}
