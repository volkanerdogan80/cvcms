<?php

namespace App\Controllers\Traits;

use App\Entities\ContentEntity;
use App\Libraries\Firebase;
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

        return view(cve_module_view($this->module, 'listing'), $filter);
    }

    public function create()
    {
        if ($this->request->getMethod() == 'post'){

            $this->setEntity();
            $insertID = $this->contentModel->insert($this->contentEntity);

            if($this->contentModel->errors()){
                return redirect()->back()->with('error', $this->contentModel->errors());
            }

            $this->shareOnSocialMedia($insertID);
            $this->sendNotification($insertID);
            $this->addCategory($insertID, 'insert');

            return redirect()->route('admin_' . $this->module . '_edit', [$insertID])
                ->with('success', cve_admin_lang_path('Success', 'create_success'));

        }
        return view(cve_module_view($this->module, 'create/index'), $this->createViewData());
    }

    public function edit($id)
    {

        $content = $this->contentModel->find($id);
        if ($content->getUserId() != session('userData.id')){
            if(!cve_permit_control($this->edit_all_permit)){
                return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'blog_edit_auth_failure'));
            }
        }

        if ($this->request->getMethod() == 'post') {

            $this->setEntity($id);

            $this->contentModel->update($id, $this->contentEntity);

            if($this->contentModel->errors()){
                return redirect()->back()->with('error', $this->contentModel->errors());
            }

            $this->shareOnSocialMedia($id);
            $this->sendNotification($id);
            $this->addCategory($id, 'update');

            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'update_success'));
        }

        return view(cve_module_view($this->module, 'edit/index'), $this->editViewData($content));
    }

    public function delete()
    {
        if($this->request->isAJAX()){
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'delete_empty_fields')
                ]);
            }
            //$data = !is_array($data) ? [$data] : $data;

            $content = $this->contentModel->where('user_id !=', session('userData.id'))->find($id);
            if ($content){
                if(!cve_permit_control($this->delete_all_permit)){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'blog_delete_failure')
                    ]);
                }
            }

            $delete = $this->contentModel->delete($id);
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
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'restore_empty_fields')
                ]);
            }
            $content = $this->contentModel->where('user_id !=', session('userData.id'))->find($id);
            if ($content){
                if(!cve_permit_control($this->undo_delete_all_permit)){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'blog_undo_delete_failure')
                    ]);
                }
            }

            $update = $this->contentModel->update($id, ['deleted_at' => null]);
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
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'purge_delete_empty_fields')
                ]);
            }
            $content = $this->contentModel->where('user_id !=', session('userData.id'))->find($id);
            if ($content){
                if(!cve_permit_control($this->purge_delete_all_permit)){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'blog_purge_delete_failure')
                    ]);
                }
            }

            $purgeDelete = $this->contentModel->delete($id, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'purge_delete_failure')
                ]);
            }


            if($this->module != 'page'){
                $this->contentModel->category('delete', $id);
                $this->contentModel->share('delete', $id);
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

    public function status()
    {
        if($this->request->isAJAX()){
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'change_status_empty_fields')
                ]);
            }
            $status = $this->request->getPost('status');

            $content = $this->contentModel->where('user_id !=', session('userData.id'))->find($id);
            if ($content){
                if(!cve_permit_control($this->status_all_permit)){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'blog_edit_failure')
                    ]);
                }
            }

            $update = $this->contentModel->update($id, ['status' => $status]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'update_failure')
                ]);
            }

            if($this->share_status){
                cve_autoshare($id);
            }

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

    protected function setEntity($id = null)
    {
        $data = $this->postData();

        if(!is_null($id))
            $this->contentEntity->setId($id);

        $this->contentEntity->setModule($this->module);
        $this->contentEntity->setUserId();
        $this->contentEntity->setTitle($data['title']);
        $this->contentEntity->setSlug();
        $this->contentEntity->setDescription($data['description']);
        $this->contentEntity->setContent($data['content']);
        $this->contentEntity->setKeywords($data['keywords']);
        $this->contentEntity->setThumbnail($data['thumbnail']);
        $this->contentEntity->setGallery($data['gallery']);
        $this->contentEntity->setViews();
        $this->contentEntity->setField($this->customField());
        $this->contentEntity->setPageType($data['page_type']);
        $this->contentEntity->setPostFormat($data['post_format']);
        $this->contentEntity->setStatus($data['status']);
        $this->contentEntity->setCommentStatus($data['comment_status']);
        $this->contentEntity->setSimilar($data['similar']);
    }

    protected function postData()
    {
        $post_field = [
            'title',
            'description',
            'content',
            'keywords',
            'thumbnail',
            'gallery',
            'page_type',
            'post_format',
            'status',
            'comment_status',
            'similar'
        ];

        $post_data = $this->request->getPost();
        $data = [];

        foreach ($post_field as $item){
            if (isset($post_data[$item]) && !is_null($post_data[$item])){
                $data[$item] = $post_data[$item];
            }else{
                $data[$item] = null;
            }
        }
        return $data;
    }

    protected function customField()
    {
        $field = [];
        $getField = $this->request->getPost('field');
        if (isset($getField)){
            foreach ($this->request->getPost('field') as $key => $value){
                $field[$value['key']] = $value['value'];
            }
        }
        return  count($field) > 0 ? $field : null;
    }

    protected function dataFilter($item)
    {
        if(is_null($item) || $item == '' || $item == false)
        {
            $item = null;
        }
        return$item;
    }

    protected function shareOnSocialMedia($content_id)
    {
        $social = $this->request->getPost('social');
        $status = $this->request->getPost('status');
        if ($social == STATUS_ACTIVE && $status == STATUS_ACTIVE){
            cve_autoshare($content_id);
        }
    }

    protected function sendNotification($content_id)
    {
        $firebase = new Firebase();
        $notification = $this->request->getPost('notification');
        $status = $this->request->getPost('status');
        if ($notification == STATUS_ACTIVE && $status == STATUS_ACTIVE){
            $firebase->setContent($content_id)->setToken()->send();
        }

    }

    protected function addCategory($id, $type)
    {
        if ($this->request->getPost('categories')){
            $this->contentModel->category($type, $id, $this->request->getPost('categories'));
        }
    }

}