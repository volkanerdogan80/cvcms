<?php

namespace App\Traits;

use App\Entities\CategoryEntity;
use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Models\UserModel;

trait CategoryTrait
{
    public $view_data = [];
    public $category_id = null;
    public $category = null;

    public function categoryListing($status)
    {
        $category_model = new CategoryModel();
        $user_model = new UserModel();

        $get_date_filter = $this->request->getGet('dateFilter');
        $date_filter = explode(' - ', $get_date_filter);
        $date_filter = count($date_filter) > 1 ? $date_filter : null;

        $per_page = $this->request->getGet('perPage');
        if (isset($per_page) && $per_page == 0){
            $per_page = null;
        }else{
            $per_page = !empty($per_page) ? $per_page : 20;
        }

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $user = $this->request->getGet('user');
        $user = !empty($user) ? $user : null;

        $module = $this->request->getGet('module');
        $module = !empty($module) ? $module : null;

        $data = [
            'perPage' => $per_page,
            'dateFilter' => $get_date_filter,
            'search' => $search,
            'user' => $user,
            'module' => $module,
            'groups' => $category_model->findAll(),
            'users' => $user_model->findAll()
        ];

        $getModel = $category_model->getListing($status, $user, $module, $search, $date_filter, $per_page);

        $this->view_data = array_merge($data, $getModel);
        return $this->view_data;
    }

    public function categoryCreate()
    {
        $category_entity = new CategoryEntity();
        $category_model = new CategoryModel();
        $category_entity->setModule($this->request->getPost('module'));
        $category_entity->setUserId();
        $category_entity->setParentId($this->request->getPost('parent_id'));
        $category_entity->setTitle($this->request->getPost('title'));
        $category_entity->setSlug();
        $category_entity->setDescription($this->request->getPost('description'));
        $category_entity->setKeywords($this->request->getPost('keywords'));
        $category_entity->setImage($this->request->getPost('image'));
        $category_entity->setStatus($this->request->getPost('status'));

        $this->category_id = $category_model->insert($category_entity);
        if($category_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $category_model->errors()
            ]);
        }
        return $this->category_id;
    }

    public function categoryEdit($id){

        $this->category_id = $id;
        $category_entity = new CategoryEntity();
        $category_model = new CategoryModel();
        $category_entity->setId($id);
        $category_entity->setModule($this->request->getPost('module'));
        $category_entity->setUserId();
        $category_entity->setParentId($this->request->getPost('parent_id'));
        $category_entity->setTitle($this->request->getPost('title'));
        $category_entity->setSlug();
        $category_entity->setDescription($this->request->getPost('description'));
        $category_entity->setKeywords($this->request->getPost('keywords'));
        $category_entity->setImage($this->request->getPost('image'));
        $category_entity->setStatus($this->request->getPost('status'));

        $category_model->update($this->category_id,$category_entity);

        if($category_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $category_model->errors()
            ]);
        }
        return $this->category_id;
    }

    public function statusChange()
    {
        $data = $this->request->getPost('id');
        if (!$data){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'change_status_empty_fields')
            ]);
        }
        $status = $this->request->getPost('status');

        $category_model = new CategoryModel();
        $update = $category_model->update($data, ['status' => $status]);
        if(!$update){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'status_change_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'status_change_success')
        ]);
    }

    public function categoryDelete()
    {
        $category_model = new CategoryModel();
        $this->category_id = $this->request->getPost('id');
        if (!$this->category_id){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'delete_empty_fields')
            ]);
        }
        if (!is_array($this->category_id)){
            $this->category_id = [$this->category_id];
        }

        $parent_control = $category_model->whereIn('parent_id', $this->category_id)->first();
        if ($parent_control){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'delete_category_with_subs')
            ]);
        }

        $content_model = new ContentModel();
        $content_control = $content_model->getContentsByCategoryIds($this->category_id, false, false, true);
        if ($content_control){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'delete_category_with_content')
            ]);
        }

        $delete = $category_model->delete($this->category_id);
        if (!$delete){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'delete_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'delete_success')
        ]);
    }

    public function categoryUndoDelete()
    {
        $category_model = new CategoryModel();
        $this->category_id = $this->request->getPost('id');
        if (!$this->category_id){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'restore_empty_fields')
            ]);
        }
        $update = $category_model->update($this->category_id, ['deleted_at' => null]);
        if(!$update){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'undo_delete_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'undo_delete_success')
        ]);
    }

    public function categoryPurgeDelete()
    {
        $category_model = new CategoryModel();
        $this->category_id = $this->request->getPost('id');
        if (!$this->category_id){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'purge_delete_empty_fields')
            ]);
        }
        $purge_delete = $category_model->delete($this->category_id, true);
        if(!$purge_delete){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'purge_delete_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'purge_delete_success')
        ]);
    }
}