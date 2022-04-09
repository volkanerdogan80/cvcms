<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Models\CategoryModel;
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
            'data' => $this->categoryListing($status),
            'view' => PANEL_FOLDER . '/pages/category/listing'
        ]);
    }

    public function create()
    {
        if($this->request->getMethod() == 'post'){
            $this->categoryCreate();
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'create_success'),
            ]);
        }

        $category_model = new CategoryModel();
        return view(PANEL_FOLDER . '/pages/category/create', [
            'categories' => $category_model->findAll()
        ]);
    }

    public function edit($id)
    {
        if($this->request->getMethod() == 'post'){
            $this->categoryEdit($id);
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'update_success'),
            ]);
        }

        $category_model = new CategoryModel();
        return view(PANEL_FOLDER . '/pages/category/edit', [
            'categories' => $category_model->findAll(),
            'category' => $category_model->find($id)
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