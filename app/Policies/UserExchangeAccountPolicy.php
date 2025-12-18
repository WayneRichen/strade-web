<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\UserExchangeAccount;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserExchangeAccountPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:UserExchangeAccount');
    }

    public function view(AuthUser $authUser, UserExchangeAccount $userExchangeAccount): bool
    {
        return $authUser->can('View:UserExchangeAccount');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:UserExchangeAccount');
    }

    public function update(AuthUser $authUser, UserExchangeAccount $userExchangeAccount): bool
    {
        return $authUser->can('Update:UserExchangeAccount');
    }

    public function delete(AuthUser $authUser, UserExchangeAccount $userExchangeAccount): bool
    {
        return $authUser->can('Delete:UserExchangeAccount');
    }

    public function restore(AuthUser $authUser, UserExchangeAccount $userExchangeAccount): bool
    {
        return $authUser->can('Restore:UserExchangeAccount');
    }

    public function forceDelete(AuthUser $authUser, UserExchangeAccount $userExchangeAccount): bool
    {
        return $authUser->can('ForceDelete:UserExchangeAccount');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:UserExchangeAccount');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:UserExchangeAccount');
    }

    public function replicate(AuthUser $authUser, UserExchangeAccount $userExchangeAccount): bool
    {
        return $authUser->can('Replicate:UserExchangeAccount');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:UserExchangeAccount');
    }

}