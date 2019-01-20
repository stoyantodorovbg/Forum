<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminLanguagesController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('Language',__FUNCTION__, true);

        $name = request()->title;
        $status = isset(request()->status) ? request()->status : 1;

        $query = $this->createSearchQuery($name,  $status);

        return $query->paginate(15);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $title
     * @param $status
     * @return Language|\Illuminate\Database\Eloquent\Builder|mixed
     */
    protected function createSearchQuery($title, $status)
    {
        $query = Language::where('status', $status)
            ->where('title', 'LIKE', '%' . $title . '%');

        return $query;
    }
}
