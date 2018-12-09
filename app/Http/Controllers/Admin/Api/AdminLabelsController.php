<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Label;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLabelsController extends Controller
{
    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $system_name = request()->system_name;
        $default_content = request()->default_content;

        $query = $this->createSearchQuery($system_name, $default_content);

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
        $label->delete();

        return response([], 204);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $system_name
     * @param $default_content
     * @return Label|\Illuminate\Database\Eloquent\Builder
     */
    protected function createSearchQuery($system_name, $default_content)
    {
        $query = Label::where('system_name', 'LIKE', '%' . $system_name . '%')
            ->where('default_content', 'LIKE', '%' . $default_content . '%');

        return $query;
    }
}
