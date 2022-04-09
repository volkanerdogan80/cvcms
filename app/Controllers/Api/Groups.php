<?php


namespace App\Controllers\Api;

use \App\Controllers\BaseController;
use App\Traits\GroupTrait;
use App\Traits\ResponseTrait;

class Groups extends BaseController
{
    use GroupTrait;
    use ResponseTrait;

    public function listing($status = null)
    {
        return $this->response([
            'status' => true,
            'message' => '',
            'data' => $this->groupListing($status)
        ]);
    }

    public function create()
    {
        $this->groupCreate();
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'create_success'),
        ]);
    }

    public function edit($id)
    {
        $this->groupEdit($id);
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'update_success'),
        ]);
    }

    public function delete()
    {
        return $this->groupDelete();
    }

    public function undoDelete()
    {
        return $this->groupUndoDelete();
    }

    public function purgeDelete()
    {
        return $this->groupPurgeDelete();
    }
}