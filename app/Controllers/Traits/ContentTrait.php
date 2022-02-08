<?php

namespace App\Controllers\Traits;

use App\Entities\ContentEntity;
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

        return view(PANEL_FOLDER . '/pages/' . $this->module . '/listing', $filter);

    }

    public function create()
    {
        if ($this->request->getMethod() == 'post'){

            $data = $this->postData();

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

            $insertID = $this->contentModel->insert($this->contentEntity);

            if($this->contentModel->errors()){
                return redirect()->back()->with('error', $this->contentModel->errors());
            }

            if($this->module != 'page'){
                cve_autoshare($insertID);
                $this->contentModel->category('insert', $insertID, $this->request->getPost('categories'));
            }

            return redirect()->route('admin_' . $this->module . '_edit', [$insertID])
                ->with('success', cve_admin_lang_path('Success', 'create_success'));

        }
        return view(PANEL_FOLDER . '/pages/' . $this->module . '/create', $this->createViewData());
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

    protected function customField(){
        $field = [];
        $getField = $this->request->getPost('field');
        if (isset($getField)){
            foreach ($this->request->getPost('field') as $key => $value){
                $field[$value['key']] = $value['value'];
            }
        }
        return  count($field) > 0 ? $field : null;
    }

    protected function dataFilter($item){

        if(is_null($item) || $item == '' || $item == false)
        {
            $item = null;
        }
        return$item;
    }

}