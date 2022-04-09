<?php


namespace App\Traits;


use App\Entities\GroupEntity;
use App\Models\GroupModel;
use App\Models\UserModel;

trait GroupTrait
{
    public $view_data = [];
    public $group_id = null;
    public $group = null;

    public function groupListing($status)
    {
        $group_model = new GroupModel();
        $search = $this->request->getGet('search');

        $per_page = $this->request->getGet('perPage');
        if (isset($per_page) && $per_page == 0){
            $per_page = null;
        }else{
            $per_page = !empty($per_page) ? $per_page : 20;
        }

        $this->view_data = $group_model->getListing($status, $search, $per_page);
        return $this->view_data;
    }

    public function groupCreate()
    {
        $group_model = new GroupModel();
        $group_entity = new GroupEntity();
        $title = $this->request->getPost('title');
        $permissions = $this->request->getPost('permission');

        $group_entity->setSlug($title);
        $group_entity->setTitle($title);
        $group_entity->setPermit($permissions);

        $this->group_id = $group_model->insert($group_entity);

        if($group_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $group_model->errors()
            ]);
        }

        return $this->group_id;
    }

    public function groupEdit($id)
    {
        $this->group_id = $id;
        $group_model = new GroupModel();
        $group_entity = new GroupEntity();
        $title = $this->request->getPost('title');
        $permissions = $this->request->getPost('permission');

        $group_entity->setId($id);
        $group_entity->setSlug($title);
        $group_entity->setTitle($title);
        $group_entity->setPermit($permissions);

        $group_model->update($this->group_id, $group_entity);

        if($group_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $group_model->errors()
            ]);
        }

        return $this->group_id;
    }

    public function groupDelete()
    {
        $this->group_id = $this->request->getPost('id');
        if(!is_array($this->group_id)){
            $this->group_id = [$this->group_id];
        }

        $group_model = new GroupModel();
        $user_model = new UserModel();
        $adminGroup = $group_model->whereIn('id', $this->group_id)->where('slug', DEFAULT_ADMIN_GROUP)->first();
        if($adminGroup){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'delete_admin_group_failure')
            ]);
        }

        $userList = $user_model->whereIn('group_id', $this->group_id)->first();
        if($userList){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'delete_group_with_user')
            ]);
        }

        $delete = $group_model->delete($this->group_id);
        if(!$delete){
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

    public function groupUndoDelete()
    {
        $group_model = new GroupModel();
        $this->group_id = $this->request->getPost('id');
        $update = $group_model->update($this->group_id, ['deleted_at' => null]);
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

    public function groupPurgeDelete()
    {
        $group_model = new GroupModel();
        $data = $this->request->getPost('id');
        $delete = $group_model->delete($data, true);

        if(!$delete){
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