<?php


namespace App\Traits;


use App\Entities\UserEntity;
use App\Models\GroupModel;
use App\Models\UserModel;

trait UserTrait
{
    public $view_data = [];
    public $user_id = null;
    public $user = null;

    public function userListing($status = null)
    {
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

        $group = $this->request->getGet('group');
        $group = !empty($group) ? $group : null;

        $user_model = new UserModel();
        $group_model = new GroupModel();
        $data = [
            'perPage' => $per_page,
            'dateFilter' => $get_date_filter,
            'search' => $search,
            'groups' => $group_model->findAll()
        ];

        $getModel = $user_model->getListing($status, $search, $group, $date_filter, $per_page);
        $this->view_data = array_merge($data, $getModel);
        return $this->view_data;
    }

    public function userCreate()
    {
        $user_model = new UserModel();
        $user_entity = new UserEntity();
        $user_entity->setFirstName($this->request->getPost('first_name'));
        $user_entity->setSurName($this->request->getPost('sur_name'));
        $user_entity->setEmail($this->request->getPost('email'));
        $user_entity->setPassword($this->request->getPost('password'));
        $user_entity->setGroupID($this->request->getPost('group_id'));
        $user_entity->setBio($this->request->getPost('bio'));
        $user_entity->setStatus($this->request->getPost('status'));
        $user_entity->setVerifyKey();
        $user_entity->setVerifyCode();

        $this->user_id = $user_model->save($user_entity);
        if ($user_model->errors()) {
            return $this->response([
                'status' => false,
                'message' => $user_model->errors()
            ]);
        }
        return $this->user_id;
    }

    public function userEdit($id)
    {
        $user_model = new UserModel();
        $user_entity = new UserEntity();
        $user_entity->setId($id);
        $user_entity->setFirstName($this->request->getPost('first_name'));
        $user_entity->setSurName($this->request->getPost('sur_name'));
        $user_entity->setEmail($this->request->getPost('email'));
        $user_entity->setPassword($this->request->getPost('password'));
        $user_entity->setGroupID($this->request->getPost('group_id'));
        $user_entity->setBio($this->request->getPost('bio'));
        $user_entity->setStatus($this->request->getPost('status'));

        $user_model->update($id, $user_entity);

        if ($user_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $user_model->errors()
            ]);
        }
        return $this->user_id;
    }

    public function statusChange()
    {
        $user_model = new UserModel();
        $this->user_id = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $update = $user_model->update($this->user_id, ['status' => $status]);
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

    public function userDelete()
    {
        $this->user_id = $this->request->getPost('id');
        if (!is_array($this->user_id)){
            $this->user_id = [$this->user_id];
        }

        $user_model = new UserModel();
        $group_model = new GroupModel();
        $adminGroup = $group_model->where('slug', DEFAULT_ADMIN_GROUP)->first();
        $user = $user_model->whereIn('id', $this->user_id)->where('group_id', $adminGroup->id)->first();

        if($user){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'delete_admin_user_failure')
            ]);
        }

        $delete = $user_model->delete($this->user_id);
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

    public function userUndoDelete(){
        $this->user_id = $this->request->getPost('id');

        $user_model = new UserModel();
        $update = $user_model->update($this->user_id, ['deleted_at' => null]);
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

    public function userPurgeDelete(){
        $this->user_id = $this->request->getPost('id');

        $user_model = new UserModel();
        $purgeDelete = $user_model->delete($this->user_id, true);
        if(!$purgeDelete){
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