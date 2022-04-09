<?php

namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Models\GroupModel;
use App\Models\UserModel;
use App\Traits\ResponseTrait;
use App\Traits\UserTrait;

class Users extends BaseController
{
    use UserTrait;
    use ResponseTrait;

    protected $groupModel;
    protected $userModel;
    protected $userEntity;

    public function listing($status = null)
    {
        return $this->response([
            'status' => true,
            'message' => '',
            'data' => $this->userListing($status),
            'view' => PANEL_FOLDER . '/pages/user/listing'
        ]);
    }

    public function create()
    {
        if($this->request->getMethod() == 'post'){
            $this->userCreate();
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'create_success'),
            ]);
        }

        $group_model = new GroupModel();
        return view(PANEL_FOLDER . '/pages/user/create', [
            'groups' => $group_model->findAll()
        ]);
    }

    public function edit($id)
    {
        if($this->request->getMethod() == 'post'){
            $this->userEdit($id);
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'update_success'),
            ]);
        }

        $group_model = new GroupModel();
        $user_model = new UserModel();
        return view(PANEL_FOLDER . "/pages/user/edit", [
            'groups' => $group_model->findAll(),
            'user' => $user_model->find($id)
        ]);
    }

    public function status()
    {
        return $this->statusChange();
    }

    public function delete()
    {
        return $this->userDelete();
    }

    public function undoDelete()
    {
        return $this->userUndoDelete();
    }

    public function purgeDelete()
    {
        return $this->userPurgeDelete();
    }

}