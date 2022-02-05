<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\ContentEntity;
use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Models\UserModel;

class Blog extends BaseController
{
    protected $userModel;
    protected $categoryModel;
    protected $contentModel;
    protected $contentEntity;
    protected $module;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->categoryModel = new CategoryModel();
        $this->contentModel = new ContentModel();
        $this->contentEntity = new ContentEntity();
        $this->module = config('system');
    }

    public function listing(string $status = null)
    {
        $getDateFilter = $this->request->getGet('dateFilter');
        $dateFilter = explode(' - ', $getDateFilter);
        $dateFilter = count($dateFilter) > 1 ? $dateFilter : null;

        $perPage = $this->request->getGet('perpage');
        $perPage = !empty($perPage) ? $perPage : 20;

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $user = $this->request->getGet('user');
        $user = !empty($user) ? $user : null;
        if (!cve_permit_control('admin_blog_listing_all')){
            $user = session('userData.id');
        }

        $category = $this->request->getGet('category');
        $category = !empty($category) ? $category : null;

        $data = [
            'categories' => $this->categoryModel->findAll(),
            'category' => $category,
            'users' => $this->userModel->findAll(),
            'user' => $user,
            'perPage' => $perPage,
            'dateFilter' => $getDateFilter,
            'search' => $search,
        ];

        $getModel = $this->contentModel->getListing($this->module->blog, $status, $user, $category, $search, $dateFilter, $perPage);

        $data = array_merge($data, $getModel);

        return view(PANEL_FOLDER . '/pages/blog/listing', $data);

    }

    public function create()
    {
        if ($this->request->getMethod() == 'post'){
            $field = [];
            $getField = $this->request->getPost('field');
            if (isset($getField)){
                foreach ($this->request->getPost('field') as $key => $value){
                    $field[$value['key']] = $value['value'];
                }
            }
            $field = count($field) > 0 ? $field : null;

            $this->contentEntity->setModule($this->module->blog);
            $this->contentEntity->setUserId();
            $this->contentEntity->setTitle($this->request->getPost('title'));
            $this->contentEntity->setSlug();
            $this->contentEntity->setDescription($this->request->getPost('description'));
            $this->contentEntity->setContent($this->request->getPost('content'));
            $this->contentEntity->setKeywords($this->request->getPost('keywords'));
            $this->contentEntity->setThumbnail($this->request->getPost('thumbnail'));
            $this->contentEntity->setGallery($this->request->getPost('gallery'));
            $this->contentEntity->setViews();
            $this->contentEntity->setField($field);
            $this->contentEntity->setStatus($this->request->getPost('status'));
            $this->contentEntity->setCommentStatus($this->request->getPost('comment_status'));
            $this->contentEntity->setSimilar($this->request->getPost('similar'));

            $insertID = $this->contentModel->insert($this->contentEntity);

            if($this->contentModel->errors()){
                return redirect()->back()->with('error', $this->contentModel->errors());
            }
            cve_autoshare($insertID);

            $this->contentModel->category('insert', $insertID, $this->request->getPost('categories'));

            return redirect()->route('admin_blog_edit', [$insertID])->with('success', cve_admin_lang_path('Success', 'create_success'));

        }
        return view(PANEL_FOLDER . '/pages/blog/create', [
            'categories' => $this->categoryModel->where('module', $this->module->blog)->findAll(),
            'blogs' => $this->contentModel->where('module', $this->module->blog)->findAll()
        ]);
    }

    public function edit($id)
    {

        $blog = $this->contentModel->find($id);
        if ($blog->getUserId() != session('userData.id')){
            if(!cve_permit_control('admin_blog_edit_all')){
                return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'blog_edit_auth_failure'));
            }
        }

        if ($this->request->getMethod() == 'post') {
            $field = [];
            $getField = $this->request->getPost('field');
            if (isset($getField)){
                foreach ($this->request->getPost('field') as $key => $value){
                    $field[$value['key']] = $value['value'];
                }
            }
            $field = count($field) > 0 ? $field : null;

            $this->contentEntity->setId($id);
            $this->contentEntity->setModule($this->module->blog);
            $this->contentEntity->setUserId();
            $this->contentEntity->setTitle($this->request->getPost('title'));
            $this->contentEntity->setSlug();
            $this->contentEntity->setDescription($this->request->getPost('description'));
            $this->contentEntity->setContent($this->request->getPost('content'));
            $this->contentEntity->setKeywords($this->request->getPost('keywords'));
            $this->contentEntity->setThumbnail($this->request->getPost('thumbnail'));
            $this->contentEntity->setGallery($this->request->getPost('gallery'));
            $this->contentEntity->setViews();
            $this->contentEntity->setField($field);
            $this->contentEntity->setStatus($this->request->getPost('status'));
            $this->contentEntity->setCommentStatus($this->request->getPost('comment_status'));
            $this->contentEntity->setSimilar($this->request->getPost('similar'));

            $this->contentModel->update($id, $this->contentEntity);

            if($this->contentModel->errors()){
                return redirect()->back()->with('error', $this->contentModel->errors());
            }

            $this->contentModel->category('update', $id, $this->request->getPost('categories'));

            cve_autoshare($id);


            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'update_success'));
        }


        return view(PANEL_FOLDER . '/pages/blog/edit', [
            'categories' => $this->categoryModel->where('module', $this->module->blog)->findAll(),
            'blogs' => $this->contentModel->where([
                'module'=> $this->module->blog,
                'id !=' => $blog->id
            ])->findAll(),
            'blog' => $blog
        ]);
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

            $blog = $this->contentModel->where('user_id !=', session('userData.id'))->find($data);
            if ($blog){
                if(!cve_permit_control('admin_blog_status_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'blog_edit_failure')
                    ]);
                }
            }

            $update = $this->contentModel->update($data, ['status' => $status]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'update_failure')
                ]);
            }

            cve_autoshare($data);

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'update_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'update_failure')
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

            $blog = $this->contentModel->where('user_id !=', session('userData.id'))->find($data);
            if ($blog){
                if(!cve_permit_control('admin_blog_delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'blog_delete_failure')
                    ]);
                }
            }

            $delete = $this->contentModel->delete($data);
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
            $blog = $this->contentModel->where('user_id !=', session('userData.id'))->find($data);
            if ($blog){
                if(!cve_permit_control('admin_blog_undo-delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'blog_undo_delete_failure')
                    ]);
                }
            }

            $update = $this->contentModel->update($data, ['deleted_at' => null]);
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
            $blog = $this->contentModel->where('user_id !=', session('userData.id'))->find($data);
            if ($blog){
                if(!cve_permit_control('admin_blog_purge-delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'blog_purge_delete_failure')
                    ]);
                }
            }

            $purgeDelete = $this->contentModel->delete($data, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'purge_delete_failure')
                ]);
            }

            $this->contentModel->category('delete', $data);
            $this->contentModel->share('delete', $data);

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