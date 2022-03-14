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
    public $insert_id = null;

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
        $this->insert_id = $content_model->insert($content_entity);
        if($content_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $content_model->errors()
            ]);
        }

        $this->shareOnSocialMedia();
        $this->sendNotification();
        $content_model->insertContentCategories($this->insert_id, $this->request->getPost('categories'));
        return $this->insert_id;
    }

    public function dataFilter($item)
    {
        if (is_null($item) || $item == '' || $item == false){
            $item = null;
        }
        return $item;
    }

    protected function shareOnSocialMedia()
    {
        $social = $this->request->getPost('social');
        $status = $this->request->getPost('status');
        if ($social == STATUS_ACTIVE && $status == STATUS_ACTIVE){
            cve_autoshare($this->insert_id);
        }
    }

    protected function sendNotification()
    {
        $firebase = new Firebase();
        $notification = $this->request->getPost('notification');
        $status = $this->request->getPost('status');
        if (cve_firebase_setting('status') && $notification == STATUS_ACTIVE && $status == STATUS_ACTIVE){
            $firebase->setContent($this->insert_id)->setToken()->send();
        }
    }
}
