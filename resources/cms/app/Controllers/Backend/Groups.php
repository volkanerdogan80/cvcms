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
        return view('admin/pages/group/listing', $data);
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

            return redirect()->back()->with('success', lang('Success.text.create'));

        }
        return view('admin/pages/group/create');
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

            return redirect()->back()->with('success', lang('Success.text.update'));
        }

        $data = [
            'group' => $this->groupModel->find($id)
        ];
        return view('admin/pages/group/edit', $data);
    }

    public function delete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            $data = !is_array($data) ? [$data] : $data;

            $adminGroup = $this->groupModel->whereIn('id', $data)->where('slug', DEFAULT_ADMIN_GROUP)->first();
            if($adminGroup){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => lang('Errors.text.delete_admin_group_error')
                ]);
            }

            $userList = $this->userModel->whereIn('group_id', $data)->first();
            if($userList){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => lang('Errors.text.delete_group_with_user')
                ]);
            }

            $delete = $this->groupModel->delete($data);

            if(!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => lang('Errors.text.delete_error')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => lang('Success.text.delete')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => lang('Errors.text.delete_error')
        ]);
    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $update = $this->groupModel->update($data, ['deleted_at' => null]);

            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => lang('Erros.text.undo_delete_error')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => lang('Success.text.undo_delete')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => lang('Erros.text.undo_delete_error')
        ]);

    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $delete = $this->groupModel->delete($data, true);

            if(!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Silme işlemi esnasında bir hata meydana geldi.'
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Veriler kalıcı olarak sistemden silindi.'
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Kalıcı silme işlemi gerçekleşmedi.'
        ]);
    }

}