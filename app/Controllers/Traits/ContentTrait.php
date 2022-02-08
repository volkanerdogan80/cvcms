<?php

namespace App\Controllers\Traits;

use App\Entities\ContentEntity;
use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Models\UserModel;

trait ContentTrait
{
    protected $userModel;
    protected $contentModel;
    protected $contentEntity;
    protected $categoryModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->contentModel = new ContentModel();
        $this->contentEntity = new ContentEntity();
        $this->categoryModel = new CategoryModel();
    }

    public function listing(string $status = null)
    {
        $filter = array_map(array($this, 'dataFilter'), $this->request->getGet());

        if(isset($filter['user']) && !is_null($filter['user']) && !cve_permit_control($this->listing_all_permit)){
            $filter['user'] = session('userData.id');
        }

        $filter['module'] = $this->module;
        $filter['status'] = $status;

        $contents = $this->contentModel->getListing($filter);

        $filter['categories'] = $this->categoryModel->findAll();
        $filter['users'] = $this->userModel->findAll();
        $filter = array_merge($filter, $contents);

        return view(PANEL_FOLDER . '/pages/'. $this->module .'/listing', $filter);

    }

    protected function dataFilter($item){

        if(is_null($item) || $item == '' || $item == false)
        {
            $item = null;
        }
        return$item;
    }

}