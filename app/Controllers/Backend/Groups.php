<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Models\GroupModel;
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
            'data' => $this->groupListing($status),
            'view' => PANEL_FOLDER . '/pages/group/listing'
        ]);
    }

    public function create()
    {
        if($this->request->getMethod() == 'post'){
            $this->groupCreate();
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'create_success'),
            ]);
        }

        return view(PANEL_FOLDER . '/pages/group/create');
    }

    public function edit($id)
    {
        if($this->request->getMethod() == 'post'){
            $this->groupEdit($id);
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'update_success'),
            ]);
        }

        $group_model = new GroupModel();
        return view(PANEL_FOLDER . '/pages/group/edit', [
            'group' => $group_model->find($id)
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