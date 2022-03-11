<?php


namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\GroupModel;
use App\Models\UserModel;
use App\Traits\ResponseTrait;

class Test extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new UserModel();
        $gmodel = new GroupModel();

        return $this->response([
            'status' => true, 'data' => [
                'user' => $model->getUserById($this->request->user->id),
                'group' => $gmodel->getGroupBySlug($this->request->user->group)
            ]
        ]);
    }
}