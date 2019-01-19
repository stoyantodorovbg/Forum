<?php

namespace App\Http\Controllers\Admin\Api;

use App\User;
use App\Models\Reply;
use App\Models\Label;
use App\Models\Thread;
use App\Models\Channel;
use App\Models\Language;
use App\Models\Auth\Role;
use App\Models\Auth\Right;
use Illuminate\Http\Request;
use App\Models\Auth\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class AdminBaseController extends Controller
{
    /**
     * AdminHomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('user-roles:SuperAdmin,Admin,Moderator');
    }

    /**
     * Change model status
     *
     * @return int
     */
    public function toggleStatus()
    {
        $modelType = request()->model_type;
        $modelId = request()->model_id;

        if ($class = $this->getClass($modelType)) {
            $model = $class::find($modelId);
            if($model->status) {
                $model->status = 0;
            } else {
                $model->status = 1;
            }

            $model->save();

            return $model->status;
        }
    }

    /**
     * Get a class by string
     *
     * @param string $modelType
     * @return bool|string
     */
    protected function getClass(string $modelType)
    {
        switch ($modelType) {
            case 'users': return User::class;
            case 'replies': return Reply::class;
            case 'labels': return Label::class;
            case 'threads': return Thread::class;
            case 'channels': return Channel::class;
            case 'languages': return Language::class;
            case 'roles': return Role::class;
            case 'rights': return Right::class;
            case 'permissions': return Permission::class;
        }

        return false;
    }
}
