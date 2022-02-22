<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\GroupEntity;
use App\Models\UserRoleModel;
use App\Models\UserModel;

class Groups extends BaseController
{
    protected $groupModel;
    protected $userModel;
    protected $groupEntity;

    public function __construct()
    {
        $this->groupModel = new UserRoleModel();
        $this->userModel = new UserModel();
        $this->groupEntity = new GroupEntity();
    }

    public function listing(string $type = null)
    {
        $search = $this->request->getGet('search');
        $data = $this->groupModel->getListing($type, $search, 20);
        return view(PANEL_FOLDER . '/pages/group/listing', $data);
    }

    public function create()
    {
        if($this->request->getMethod() == 'post'){
            $title = $this->request->getPost('title');
            $permissions = $this->request->getPost('permission');

            $this->groupEntity->setSlug($title);
            $this->groupEntity->setTitle($title);
            $this->groupEntity->setPermit($permissions);

            $this->groupModel->insert($this->groupEntity);

            if($this->groupModel->errors()){
                return redirect()->back()->with('error', $this->groupModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang('Success', 'create_success'));

        }
        return view(PANEL_FOLDER . '/pages/group/create');
    }

    public function edit(int $id)
    {
        if($this->request->getMethod() == 'post'){
            $title = $this->request->getPost('title');
            $permissions = $this->request->getPost('permission');

            $this->groupEntity->setId($id);
            $this->groupEntity->setSlug($title);
            $this->groupEntity->setTitle($title);
            $this->groupEntity->setPermit($permissions);

            $this->groupModel->update($id, $this->groupEntity);

            if($this->groupModel->errors()){
                return redirect()->back()->with('error', $this->groupModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang('Success', 'update_success'));
        }

        $data = [
            'group' => $this->groupModel->find($id)
        ];
        return view(PANEL_FOLDER . '/pages/group/edit', $data);
    }

    public function delete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'delete_empty_fields')
                ]);
            }

            $data = !is_array($data) ? [$data] : $data;

            $adminGroup = $this->groupModel->whereIn('id', $data)->where('slug', DEFAULT_ADMIN_GROUP)->first();
            if($adminGroup){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'delete_admin_group_failure')
                ]);
            }

            $userList = $this->userModel->whereIn('group_id', $data)->first();
            if($userList){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'delete_group_with_user')
                ]);
            }

            $delete = $this->groupModel->delete($data);

            if(!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'delete_failure')
        ]);
    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'restore_empty_fields')
                ]);
            }

            $update = $this->groupModel->update($data, ['deleted_at' => null]);

            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'undo_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'undo_delete_success')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'undo_delete_failure')
        ]);

    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'purge_delete_empty_fields')
                ]);
            }
            $delete = $this->groupModel->delete($data, true);

            if(!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'purge_delete_success')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'purge_delete_failure')
        ]);
    }

}