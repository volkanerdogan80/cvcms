<?php

namespace App\Controllers\Api;

use \App\Controllers\BaseController;
use App\Traits\CategoryTrait;
use App\Traits\ResponseTrait;

class Category extends BaseController
{
    use CategoryTrait;
    use ResponseTrait;

    public function listing($status = null)
    {
        return $this->response([
            'status' => true,
            'message' => '',
            'data' => $this->categoryListing($status)
        ]);
    }

    public function create()
    {
        $this->categoryCreate();
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'create_success'),
        ]);
    }

    public function edit($id)
    {
        $this->categoryEdit($id);
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'update_success'),
        ]);
    }

    public function status()
    {
        return $this->statusChange();
    }

    public function delete()
    {
        return $this->categoryDelete();
    }

    public function undoDelete()
    {
        return $this->categoryUndoDelete();
    }

    public function purgeDelete()
    {
        $this->categoryPurgeDelete();
    }
}