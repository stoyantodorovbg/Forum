<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Channel;
use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Http\Controllers\Controller;

class AdminChannelsController extends Controller
{
    use CheckUserRights;

    /**
     * Display a listing of filtered resources.
     *
     * @return mixed
     */
    public function index()
    {
        $this->authenticate('Channel',__FUNCTION__, true);

        $name = request()->name;
        $status = isset(request()->status) ? request()->status : 1;

        $query = $this->createSearchQuery($name,  $status);

        return $query->paginate(15);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Channel $channel
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Channel $channel)
    {
        $this->authenticate('Channel',__FUNCTION__, true);

        $channel->delete();

        return response([], 204);
    }

    /**
     * Create a query according to search inputs
     *
     * @param $name
     * @param $status
     * @return Channel|\Illuminate\Database\Eloquent\Builder|mixed
     */
    protected function createSearchQuery($name, $status)
    {
        $query = Channel::where('status', $status)
            ->where('name', 'LIKE', '%' . $name . '%');

        return $query;
    }
}
