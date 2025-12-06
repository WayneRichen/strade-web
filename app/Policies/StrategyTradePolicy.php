<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\StrategyTrade;
use Illuminate\Auth\Access\HandlesAuthorization;

class StrategyTradePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:StrategyTrade');
    }

    public function view(AuthUser $authUser, StrategyTrade $strategyTrade): bool
    {
        return $authUser->can('View:StrategyTrade');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:StrategyTrade');
    }

    public function update(AuthUser $authUser, StrategyTrade $strategyTrade): bool
    {
        return $authUser->can('Update:StrategyTrade');
    }

    public function delete(AuthUser $authUser, StrategyTrade $strategyTrade): bool
    {
        return $authUser->can('Delete:StrategyTrade');
    }

    public function restore(AuthUser $authUser, StrategyTrade $strategyTrade): bool
    {
        return $authUser->can('Restore:StrategyTrade');
    }

    public function forceDelete(AuthUser $authUser, StrategyTrade $strategyTrade): bool
    {
        return $authUser->can('ForceDelete:StrategyTrade');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:StrategyTrade');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:StrategyTrade');
    }

    public function replicate(AuthUser $authUser, StrategyTrade $strategyTrade): bool
    {
        return $authUser->can('Replicate:StrategyTrade');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:StrategyTrade');
    }

}