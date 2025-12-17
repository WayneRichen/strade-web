<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ExchangeAccount;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExchangeAccountPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ExchangeAccount');
    }

    public function view(AuthUser $authUser, ExchangeAccount $exchangeAccount): bool
    {
        return $authUser->can('View:ExchangeAccount');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ExchangeAccount');
    }

    public function update(AuthUser $authUser, ExchangeAccount $exchangeAccount): bool
    {
        return $authUser->can('Update:ExchangeAccount');
    }

    public function delete(AuthUser $authUser, ExchangeAccount $exchangeAccount): bool
    {
        return $authUser->can('Delete:ExchangeAccount');
    }

    public function restore(AuthUser $authUser, ExchangeAccount $exchangeAccount): bool
    {
        return $authUser->can('Restore:ExchangeAccount');
    }

    public function forceDelete(AuthUser $authUser, ExchangeAccount $exchangeAccount): bool
    {
        return $authUser->can('ForceDelete:ExchangeAccount');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ExchangeAccount');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ExchangeAccount');
    }

    public function replicate(AuthUser $authUser, ExchangeAccount $exchangeAccount): bool
    {
        return $authUser->can('Replicate:ExchangeAccount');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ExchangeAccount');
    }

}