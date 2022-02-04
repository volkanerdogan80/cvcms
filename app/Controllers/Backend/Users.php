<?php

namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Models\UserRoleModel;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $groupModel;
    protected $userModel;
    protected $userEntity;

    public function __construct()
    {
        $this->groupModel = new UserRoleModel();
        $this->userModel = new UserModel();
        $this->userEntity = new UserEntity();
    }

    public function listing(string $status = null)
    {
        //TODO id ASC yapılacak
        $getDateFilter = $this->request->getGet('dateFilter');
        $dateFilter = explode(' - ', $getDateFilter);
        $dateFilter = count($dateFilter) > 1 ? $dateFilter : null;

        $perPage = $this->request->getGet('per_page');
        $perPage = !empty($perPage) ? $perPage : 20;

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $group = $this->request->getGet('group');
        $group = !empty($group) ? $group : null;

        $data = [
            'perPage' => $perPage,
            'dateFilter' => $getDateFilter,
            'search' => $search,
            'groups' => $this->groupModel->findAll()
        ];

        $getModel = $this->userModel->getListing($status, $search, $group, $dateFilter, $perPage);

        $data = array_merge($data, $getModel);

        return view(PANEL_FOLDER . '/pages/user/listing', $data);
    }

    public function create()
    {
        if($this->request->getMethod() == 'post'){
            $this->userEntity->setFirstName($this->request->getPost('first_name'));
            $this->userEntity->setSurName($this->request->getPost('sur_name'));
            $this->userEntity->setEmail($this->request->getPost('email'));
            $this->userEntity->setPassword($this->request->getPost('password'));
            $this->userEntity->setGroupID($this->request->getPost('group_id'));
            $this->userEntity->setBio($this->request->getPost('bio'));
            $this->userEntity->setStatus($this->request->getPost('status'));
            $this->userEntity->setVerifyKey();
            $this->userEntity->setVerifyCode();

            $this->userModel->save($this->userEntity);

            if($this->userModel->errors()){
                return redirect()->back()->with('error', $this->userModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'create_success'));

        }

        $data = ['groups' => $this->groupModel->findAll()];
        return view(PANEL_FOLDER . '/pages/user/create', $data);
    }

    public function edit(int $id)
    {
        if($this->request->getMethod() == 'post'){
            $this->userEntity->setId($id);
            $this->userEntity->setFirstName($this->request->getPost('first_name'));
            $this->userEntity->setSurName($this->request->getPost('sur_name'));
            $this->userEntity->setEmail($this->request->getPost('email'));

            if (!empty($this->request->getPost('password'))){
                $this->userEntity->setPassword($this->request->getPost('password'));
            }

            $this->userEntity->setGroupID($this->request->getPost('group_id'));
            $this->userEntity->setBio($this->request->getPost('bio'));
            $this->userEntity->setStatus($this->request->getPost('status'));

            $this->userModel->update($id, $this->userEntity);

            if ($this->userModel->errors()){
                return redirect()->back()->with('error', $this->userModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'update_success'));

        }

        $data = [
            'groups' => $this->groupModel->findAll(),
            'user' => $this->userModel->find($id)
        ];
        return view(PANEL_FOLDER . "/pages/user/edit", $data);
    }

    public function status()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'change_status_empty_fields')
                ]);
            }
            $status = $this->request->getPost('status');

            $update = $this->userModel->update($data, ['status' => $status]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'status_change_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'status_change_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'status_change_failure')
        ]);
    }

    public function delete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'delete_empty_fields')
                ]);
            }
            $data = !is_array($data) ? [$data] : $data;

            $adminGroup = $this->groupModel->where('slug', DEFAULT_ADMIN_GROUP)->first();
            $user = $this->userModel->whereIn('id', $data)->where('group_id', $adminGroup->id)->first();

            if($user){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'delete_admin_user_failure')
                ]);
            }

            $delete = $this->userModel->delete($data);
            if (!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'delete_failure')
        ]);
    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'restore_empty_fields')
                ]);
            }

            $update = $this->userModel->update($data, ['deleted_at' => null]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'undo_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'undo_delete_success')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'undo_delete_failure')
        ]);

    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'purge_delete_empty_fields')
                ]);
            }
            $purgeDelete = $this->userModel->delete($data, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'purge_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'purge_delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'purge_delete_failure')
        ]);
    }

}