<?php

namespace App\Filament\Resources\Concerns;

use Illuminate\Contracts\Auth\Access\Authorizable;

trait HasAuthorization
{
    protected static function checkPermission(string $permission): bool
    {
        $user = auth()->user();
        
        if (!$user instanceof Authorizable) {
            return false;
        }

        if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
            return true;
        }

        return $user->can($permission);
    }
}
