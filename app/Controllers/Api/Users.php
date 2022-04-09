<?php


namespace App\Controllers\Api;

use \App\Controllers\BaseController;
use App\Traits\ResponseTrait;
use App\Traits\UserTrait;

class Users extends BaseController
{
    use UserTrait;
    use ResponseTrait;

    public function listing($status = null)
    {
        return $this->response([
            'status' => true,
            'message' => '',
            'data' => $this->userListing($status)
        ]);
    }

    public function create()
    {
        $this->userCreate();
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'create_success'),
        ]);
    }

    public function edit($id)
    {
        $this->userEdit($id);
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'update_success')
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