<?php

namespace App\Controllers\Traits;

use App\Entities\ContentEntity;
use App\Libraries\Firebase;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\ContentModel;
use App\Models\FavoriteModel;
use App\Models\LikeModel;
use App\Models\RatingModel;
use App\Models\UserModel;

trait ContentTrait
{
    protected $userModel;
    protected $contentModel;
    protected $contentEntity;
    protected $categoryModel;
    protected $commentModel;
    protected $ratingModel;
    protected $likeModel;
    protected $favoriteModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->contentModel = new ContentModel();
        $this->contentEntity = new ContentEntity();
        $this->categoryModel = new CategoryModel();
        $this->commentModel = new CommentModel();
        $this->ratingModel = new RatingModel();
        $this->likeModel = new LikeModel();
        $this->favoriteModel = new FavoriteModel();
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
                ->with('success', cve_admin_lang('Success', 'create_success'));

        }
        return view(cve_module_view($this->module, 'create/index'), $this->createViewData());
    }

    public function edit($id)
    {

        $content = $this->contentModel->find($id);
        if ($content->getUserId() != session('userData.id')){
            if(!cve_permit_control($this->edit_all_permit)){
                return redirect()->back()->with('error', cve_admin_lang('Errors', 'blog_edit_auth_failure'));
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

            return redirect()->back()->with('success', cve_admin_lang('Success', 'update_success'));
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
                    'message' => cve_admin_lang('Errors', 'delete_empty_fields')
                ]);
            }
            //$data = !is_array($data) ? [$data] : $data;

            $content = $this->contentModel->where('user_id !=', session('userData.id'))->find($id);
            if ($content){
                if(!cve_permit_control($this->delete_all_permit)){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'blog_delete_failure')
                    ]);
                }
            }

            $delete = $this->contentModel->delete($id);
            if (!$delete){
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
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'restore_empty_fields')
                ]);
            }
            $content = $this->contentModel->where('user_id !=', session('userData.id'))->find($id);
            if ($content){
                if(!cve_permit_control($this->undo_delete_all)){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'blog_undo_delete_failure')
                    ]);
                }
            }

            $update = $this->contentModel->update($id, ['deleted_at' => null]);
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
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'purge_delete_empty_fields')
                ]);
            }
            $content = $this->contentModel->where('user_id !=', session('userData.id'))->find($id);
            if ($content){
                if(!cve_permit_control($this->purge_delete_all)){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'blog_purge_delete_failure')
                    ]);
                }
            }

            $purgeDelete = $this->contentModel->delete($id, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'purge_delete_failure')
                ]);
            }

            if($this->module != 'page'){
                $this->contentModel->category('delete', $id);
                $this->contentModel->share('delete', $id);
                $this->commentModel->where('content_id', $id)->delete(null,true);
                $this->ratingModel->where('content_id', $id)->delete(null,true);
                $this->likeModel->where('content_id', $id)->delete(null,true);
                $this->favoriteModel->where('content_id', $id)->delete(null,true);
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

    public function status()
    {
        if($this->request->isAJAX()){
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'change_status_empty_fields')
                ]);
            }
            $status = $this->request->getPost('status');

            $content = $this->contentModel->where('user_id !=', session('userData.id'))->find($id);
            if ($content){
                if(!cve_permit_control($this->status_all_permit)){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'blog_edit_failure')
                    ]);
                }
            }

            $update = $this->contentModel->update($id, ['status' => $status]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'update_failure')
                ]);
            }

            //TODO: Muhtemelen status active yapınca sosyal medya paylaşımı yapılsın diye düşünüldü. Ama şu an buraya share_status diye bir şey gelmiyor.
            // Böyle olunca da status değiştirirken ajax request hatası dönüyor. Sonra ilgilen.
            //if($this->share_status){
            //    cve_autoshare($id);
            //}

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'update_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'update_failure')
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
        return $item;
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
        if (config('firebase')->status && $notification == STATUS_ACTIVE && $status == STATUS_ACTIVE){
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