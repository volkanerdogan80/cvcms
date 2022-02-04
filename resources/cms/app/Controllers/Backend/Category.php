<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\CategoryEntity;
use App\Models\CategoryModel;
use App\Models\UserModel;

class Category extends BaseController
{
    protected $categoryModel;
    protected $categoryEntity;
    protected $userModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->categoryEntity = new CategoryEntity();
        $this->userModel = new UserModel();
    }

    public function listing(string $status = null)
    {
        $getDateFilter = $this->request->getGet('dateFilter');
        $dateFilter = explode(' - ', $getDateFilter);
        $dateFilter = count($dateFilter) > 1 ? $dateFilter : null;

        $perPage = $this->request->getGet('perPage');
        $perPage = !empty($perPage) ? $perPage : 20;

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $user = $this->request->getGet('user');
        $user = !empty($user) ? $user : null;

        $module = $this->request->getGet('module');
        $module = !empty($module) ? $module : null;

        $data = [
            'perPage' => $perPage,
            'dateFilter' => $getDateFilter,
            'search' => $search,
            'user' => $user,
            'module' => $module,
            'groups' => $this->categoryModel->findAll(),
            'users' => $this->userModel->findAll()
        ];

        $getModel = $this->categoryModel->getListing($status, $user, $module, $search, $dateFilter, $perPage);

        $data = array_merge($data, $getModel);

        return view('admin/pages/category/listing', $data);
    }

    public function create()
    {
        if($this->request->getMethod() == 'post'){
            $this->categoryEntity->setModule($this->request->getPost('module'));
            $this->categoryEntity->setUserId();
            $this->categoryEntity->setParentId($this->request->getPost('parent_id'));
            $this->categoryEntity->setTitle($this->request->getPost('title'));
            $this->categoryEntity->setSlug();
            $this->categoryEntity->setDescription($this->request->getPost('description'));
            $this->categoryEntity->setKeywords($this->request->getPost('keywords'));
            $this->categoryEntity->setImage($this->request->getPost('image'));
            $this->categoryEntity->setStatus($this->request->getPost('status'));

            $this->categoryModel->insert($this->categoryEntity);

            if($this->categoryModel->errors()){
                return redirect()->back()->with('error', $this->categoryModel->errors());
            }

            return redirect()->back()->with('success', lang('Success.text.create'));

        }

        return view('admin/pages/category/create', [
            'categories' => $this->categoryModel->where('module', MODULE_BLOG)->findAll()
        ]);
    }

    public function edit(int $id)
    {
        if($this->request->getMethod() == 'post'){
            $this->categoryEntity->setId($id);
            $this->categoryEntity->setModule($this->request->getPost('module'));
            $this->categoryEntity->setParentId($this->request->getPost('parent_id'));
            $this->categoryEntity->setTitle($this->request->getPost('title'));
            $this->categoryEntity->setSlug();
            $this->categoryEntity->setDescription($this->request->getPost('description'));
            $this->categoryEntity->setKeywords($this->request->getPost('keywords'));
            $this->categoryEntity->setImage($this->request->getPost('image'));
            $this->categoryEntity->setStatus($this->request->getPost('status'));

            $this->categoryModel->update($id,$this->categoryEntity);

            if($this->categoryModel->errors()){
                return redirect()->back()->with('error', $this->categoryModel->errors());
            }

            return redirect()->back()->with('success', lang('Success.text.update'));

        }

        return view('admin/pages/category/edit', [
            'categories' => $this->categoryModel->where('module', MODULE_BLOG)->findAll(),
            'category' => $this->categoryModel->find($id)
        ]);
    }

    public function status()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            $status = $this->request->getPost('status');

            $update = $this->categoryModel->update($data, ['status' => $status]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Kategori durum değiştirme işlemi esnasında bir hata meyanda geldi.'
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Kategori durumu başarılı bir şekilde değiştirildi.'
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Kategori durum değiştirme işlemi esnasında bir hata meyanda geldi.'
        ]);
    }

    public function delete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $delete = $this->categoryModel->delete($data);
            if (!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Kategori silme işlemi esnasında bir hata meydana geldi.'
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Kategori başarılı bir şekilde silindi.'
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Kategori silme işlemi esnasında bir hata meydana geldi.'
        ]);
    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $update = $this->categoryModel->update($data, ['deleted_at' => null]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Geri alma işlemi esnasında bir hata meydana geldi.'
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Kategori başarılı bir şekilde kurtarıldı.'
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Geri alma işlemi esnasında bir hata meydana geldi.'
        ]);
    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $purgeDelete = $this->categoryModel->delete($data, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Kategori kalıcı olarak silme işlemi esnasında bir hata meydana geldi.'
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Kategori kalıcı olarak sistemden silindi.'
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Kategori kalıcı olarak silme işlemi esnasında bir hata meydana geldi.'
        ]);
    }
}