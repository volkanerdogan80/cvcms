<?php


namespace Modules\Service\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Traits\ContentTrait;

class Service extends BaseController
{
    use ContentTrait{
        ContentTrait::__construct as private __traitConstruct;
    }

    protected $module;
    protected $listing_all_permit;
    protected $edit_all_permit;
    protected $status_all_permit;
    protected $delete_all_permit;
    protected $undo_delete_all;
    protected $purge_delete_all;
    protected $share_status;
    protected $add_category;

    public function __construct()
    {
        $this->__traitConstruct();
        $this->module = 'service';
        $this->listing_all_permit = 'admin_blog_listing_all';
        $this->edit_all_permit = 'blog_edit_all';
        $this->status_all_permit = 'admin_blog_status_all';
        $this->delete_all_permit = 'admin_blog_delete_all';
        $this->undo_delete_all = 'admin_blog_undo-delete_all';
        $this->purge_delete_all = 'admin_blog_purge-delete_all';
        $this->share_status = false;
        $this->add_category = true;
    }

    protected function createViewData()
    {
        return [
            'categories' => $this->categoryModel->where('module', $this->module)->findAll(),
            'blogs' => $this->contentModel->where('module', $this->module)->findAll(),
        ];
    }

    protected function editViewData($content)
    {
        return [
            'categories' => $this->categoryModel->where('module', $this->module)->findAll(),
            'blogs' => $this->contentModel->where([
                'module'=> $this->module,
                'id !=' => $content->id
            ])->findAll(),            'content' => $content
        ];
    }

}