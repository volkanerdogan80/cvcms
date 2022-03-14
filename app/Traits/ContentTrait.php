<?php


namespace App\Traits;


use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Models\UserModel;

trait ContentTrait
{
    public $view_data = [];

    public function contentListing($status = null)
    {
        $filter = array_map(array($this, 'dataFilter'), $this->request->getGet());

        if (property_exists($this, 'listing_all_permit')){
            if (isset($filter['user']) && !cve_permit_control($this->listing_all_permit)){
                $filter['user'] = auth_user_id();
            }
        }

        $filter['module'] = $this->module;
        $filter['status'] = $status;

        $content_model = new ContentModel();
        $category_model = new CategoryModel();
        $user_model = new UserModel();

        $contents = $content_model->getListing($filter);
        $filter['categories'] = $category_model->findAll();
        $filter['users'] = $user_model->findAll();
        $this->view_data = array_merge($filter, $contents);
        return $this->view_data;
    }

    public function dataFilter($item)
    {
        if (is_null($item) || $item == '' || $item == false){
            $item = null;
        }
        return $item;
    }
}
