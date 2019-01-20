<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Label;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminLabelsController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('Label',__FUNCTION__, true);

        $systemName = request()->system_name;
        $defaultContent = request()->default_content;
        $status = isset(request()->status) ? request()->status : 1;

        $query = $this->createSearchQuery($systemName, $defaultContent, $status);

        return $query->paginate(15);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Label $label
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Label $label)
    {
        $this->authenticate('Label',__FUNCTION__, true);

        $label->delete();

        return response([], 204);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $systemName
     * @param $defaultContent
     * @param $status
     * @return Label|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($systemName, $defaultContent, $status)
    {
        $query = Label::where('system_name', 'LIKE', '%' . $systemName . '%')
            ->where('default_content', 'LIKE', '%' . $defaultContent . '%')
            ->where('status', $status);

        return $query;
    }
}
