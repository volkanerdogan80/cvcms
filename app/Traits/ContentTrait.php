<?php


namespace App\Traits;


use App\Entities\ContentEntity;
use App\Libraries\Firebase;
use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Models\UserModel;

trait ContentTrait
{
    public $view_data = [];
    public $content_id = null;
    public $content = null;

    public function contentListing($status = null)
    {
        $filter = array_map(array($this, 'dataFilter'), $this->request->getGet());

        if (property_exists($this, 'listing_all_permit')){
            if (isset($filter['user']) && !cve_permit_control($this->listing_all_permit)){
                $filter['user'] = auth_user_id();
            }
        }

        $filter['module'] = $this->module;
        $filter['status'] = $status;

        $content_model = new ContentModel();
        $category_model = new CategoryModel();
        $user_model = new UserModel();

        $contents = $content_model->getListing($filter);
        $filter['categories'] = $category_model->findAll();
        $filter['users'] = $user_model->findAll();
        $this->view_data = array_merge($filter, $contents);
        return $this->view_data;
    }

    public function contentCreate()
    {
        $content_entity = new ContentEntity();
        $content_entity->setModule($this->module);
        $content_entity->setUserId();
        $content_entity->setTitle($this->request->getPost('title'));
        $content_entity->setSlug();
        $content_entity->setDescription($this->request->getPost('description'));
        $content_entity->setContent($this->request->getPost('content'));
        $content_entity->setKeywords($this->request->getPost('keywords'));
        $content_entity->setThumbnail($this->request->getPost('thumbnail'));
        $content_entity->setGallery($this->request->getPost('gallery'));
        $content_entity->setViews();
        $content_entity->setField($this->request->getPost('field'));
        $content_entity->setPageType($this->request->getPost('page_type'));
        $content_entity->setPostFormat($this->request->getPost('post_format'));
        $content_entity->setSimilar($this->request->getPost('similar'));
        $content_entity->setCommentStatus($this->request->getPost('comment_status'));
        $content_entity->setStatus($this->request->getPost('status'));

        $content_model = new ContentModel();
        $this->content_id = $content_model->insert($content_entity);
        if($content_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $content_model->errors()
            ]);
        }

        $this->shareOnSocialMedia();
        $this->sendNotification();
        $content_model->insertContentCategories($this->content_id, $this->request->getPost('categories'));
        return $this->content_id;
    }

    public function contentEdit($id = null)
    {
        if (!is_null($id)){
            $this->content_id = $id;
        }

        $content_model = new ContentModel();
        $this->content = $content_model->getContentById($this->content_id, false);

        if (!$this->controlPermit($this->edit_all_permit)) {
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang($this->module, 'edit_auth_failure')
            ]);
        }

        $content_entity = new ContentEntity();
        $content_entity->setModule($this->module);
        $content_entity->setUserId();
        $content_entity->setTitle($this->request->getPost('title'));
        $content_entity->setSlug();
        $content_entity->setDescription($this->request->getPost('description'));
        $content_entity->setContent($this->request->getPost('content'));
        $content_entity->setKeywords($this->request->getPost('keywords'));
        $content_entity->setThumbnail($this->request->getPost('thumbnail'));
        $content_entity->setGallery($this->request->getPost('gallery'));
        $content_entity->setViews();
        $content_entity->setField($this->request->getPost('field'));
        $content_entity->setPageType($this->request->getPost('page_type'));
        $content_entity->setPostFormat($this->request->getPost('post_format'));
        $content_entity->setSimilar($this->request->getPost('similar'));
        $content_entity->setCommentStatus($this->request->getPost('comment_status'));
        $content_entity->setStatus($this->request->getPost('status'));

        $content_model->update($id, $content_entity);

        if($content_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $content_model->errors()
            ]);
        }

        //TODO: Social ve Notification active durumları kaydedilmediği için aktif yapsak dahi butonlarda aktif-pasif durumu değişmiyor.
        $this->shareOnSocialMedia();
        $this->sendNotification();
        $content_model->updateContentCategories($this->content_id, $this->request->getPost('categories'));
        return $this->content_id;
    }

    public function contentStatus()
    {
        $this->content_id = $this->request->getPost('id');
        if (!$this->content_id){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'change_status_empty_fields')
            ]);
        }
        $status = $this->request->getPost('status');

        $content_model = new ContentModel();
        $this->content = $content_model->getContentById($this->content_id, false);
        if (!$this->controlPermit($this->status_all_permit)) {
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang($this->module, 'status_change_failure')
            ]);
        }

        $update = $content_model->update($this->content_id, ['status' => $status]);
        if(!$update){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'update_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'status_change_success')
        ]);
    }

    public function contentDelete()
    {
        $this->content_id = $this->request->getPost('id');
        if (!$this->content_id){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'delete_empty_fields')
            ]);
        }
        $content_model = new ContentModel();
        $this->content = $content_model->getContentById($this->content_id, false);
        if (!$this->controlPermit($this->delete_all_permit)) {
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang($this->module, 'delete_failure')
            ]);
        }

        $delete = $content_model->delete($this->content_id);
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

    public function contentUndoDelete()
    {
        $this->content_id = $this->request->getPost('id');
        if (!$this->content_id){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'restore_empty_fields')
            ]);
        }
        $content_model = new ContentModel();
        $this->content = $content_model->getContentById($this->content_id, false);
        if (!$this->controlPermit($this->undo_delete_all)) {
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang($this->module, 'undo_delete_failure')
            ]);
        }

        $update = $content_model->update($this->content_id, ['deleted_at' => null]);
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

    public function contentPurgeDelete()
    {
        $this->content_id = $this->request->getPost('id');
        if (!$this->content_id){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'purge_delete_empty_fields')
            ]);
        }
        $content_model = new ContentModel();
        $this->content = $content_model->getContentById($this->content_id, false);
        if (!$this->controlPermit($this->purge_delete_all)) {
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang($this->module, 'purge_delete_failure')
            ]);
        }

        $purgeDelete = $content_model->delete($this->content_id, true);
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

    public function dataFilter($item)
    {
        if (is_null($item) || $item == '' || $item == false){
            $item = null;
        }
        return $item;
    }

    public function shareOnSocialMedia()
    {
        $social = $this->request->getPost('social');
        $status = $this->request->getPost('status');
        if ($social == STATUS_ACTIVE && $status == STATUS_ACTIVE){
            cve_autoshare($this->content_id);
        }
    }

    public function sendNotification()
    {
        $firebase = new Firebase();
        $notification = $this->request->getPost('notification');
        $status = $this->request->getPost('status');
        if (cve_firebase_setting('status') && $notification == STATUS_ACTIVE && $status == STATUS_ACTIVE){
            $firebase->setContent($this->content_id)->setToken()->send();
        }
    }

    public function controlPermit($permit)
    {
        if ($this->content && $this->content->getUserId() != auth_user_id() && !cve_permit_control($permit)) {
            return false;
        }
        return true;
    }

}
