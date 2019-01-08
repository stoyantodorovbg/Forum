<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminRolesController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('Role',__FUNCTION__, true);

        $system_name = request()->system_name;
        $default_content = request()->default_content;

        $query = $this->createSearchQuery($system_name, $default_content);

        return $query->paginate(15);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $this->authenticate('Role',__FUNCTION__, true);

        $role->delete();

        return response([], 204);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $title
     * @return Role|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($title)
    {
        $query = Role::where('title', 'LIKE', '%' . $title . '%');

        return $query;
    }
}
