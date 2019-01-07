<?php

namespace App\Traits;

use App\User;

trait CheckUserRights
{
    /**
     * @param string $model
     * @param string $method
     * @param bool $backOffice
     * @return mixed
     */
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

    /**
     * @param array $permissions
     * @param string $model
     * @param string $method
     * @return mixed
     */
    protected function processFrontViewsData(array $permissions, string $model, string $method) {
        foreach ($permissions as $permission) {
            if (in_array('Admin', $permission) || $this->checkPermission($permission, $model, $method)) {
                return true;
            }
        }

        return abort(403, 'You do not have permission to perform this action');
    }

    /**
     * @param array $permissions
     * @param string $model
     * @param string $method
     * @return mixed
     */
    protected function processBackOfficeData(array $permissions, string $model, string $method)
    {
        foreach ($permissions as $permission) {
            if ($this->checkAdminBackoffice($permission) || $this->checkBackofficePermission($permission, $model, $method)) {
                return true;
            }
        }

        return abort(403, 'You do not have permission to perform this action');
    }

    /**
     * @param $permission
     * @return bool
     */
    protected function checkAdminBackoffice($permission)
    {
        return in_array('Admin', $permission) && in_array('BackOffice', $permission);
    }

    /**
     * @param $permission
     * @param $model
     * @param $method
     * @return bool
     */
    protected function checkBackofficePermission($permission, $model, $method)
    {
        return in_array('BackOffice', $permission) && in_array($model, $permission) && in_array($method, $permission);
    }

    /**
     * @param $permission
     * @param $model
     * @param $method
     * @return bool
     */
    protected function checkPermission($permission, $model, $method)
    {
        return in_array($model, $permission) && in_array($method, $permission);
    }
}