<?php

namespace App\Http\Controllers\Admin\Api;

use App\User;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('User',__FUNCTION__, true);

        $name = request()->name;
        $status = isset(request()->status) ? request()->status : 1;
        $email = request()->email;

        $query = $this->createSearchQuery($name, $status, $email);

        return $query->paginate(15);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $name
     * @param $status
     * @param $email
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($name, $status, $email)
    {
        $query = User::where('name', 'LIKE', '%' . $name . '%')
            ->where('email', 'LIKE', '%' . $email . '%')
            ->where('status', $status);

        return $query;
    }
}
