<?php

namespace App\Traits;

use App\User;

trait CheckUserRights
{
    public function authenticate(string $model, string $method, bool $backOffice)
    {
        if($user = auth()->user()) {
            $permissions = $user->getUserRolePermissions();

            if ($backOffice) {
                return $this->processBackOfficeData($permissions, $model, $method);
            } else {
                return $this->processFrontViewsData($permissions, $model, $method);
            }
        }

        return abort(403, 'You do not have permission to perform this action');
    }

    protected function processFrontViewsData(array $permissions, string $model, string $method) {
        return false;
    }

    protected function processBackOfficeData(array $permissions, string $model, string $method)
    {
        foreach ($permissions as $permission) {
            if (in_array('BackOffice', $permission) && in_array('Full', $permission)) {
                return true;
            } elseif (in_array('BackOffice', $permission) &&
                in_array($model, $permission) &&
                in_array($method, $permission)) {
                return true;
            }
        }

        return abort(403, 'You do not have permission to perform this action');
    }
}