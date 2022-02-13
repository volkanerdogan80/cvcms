<?php
namespace Modules\Blog\Controllers;

use \App\Controllers\BaseController;
use App\Controllers\Traits\ContentTrait;

class Blog extends BaseController
{
    use ContentTrait{
        ContentTrait::__construct as private __traitConstruct;
    }
    protected $module;
    protected $listing_all_permit;
    protected $edit_all_permit;
    protected $status_all_permit;
    protected $delete_all_permit;
    protected $undo_delete_all_permit;
    protected $purge_delete_all_permit;
    protected $share_status;
    protected $add_category;

    public function __construct()
    {
        $this->__traitConstruct();

        $this->module = 'blog';
        $this->listing_all_permit = 'admin_blog_listing_all';
        $this->edit_all_permit = 'admin_blog_edit_all';
        $this->status_all_permit = 'admin_blog_status_all';
        $this->delete_all_permit = 'admin_blog_delete_all';
        $this->undo_delete_all_permit = 'admin_blog_undo_delete_all';
        $this->purge_delete_all_permit = 'admin_blog_purge_delete_all';
        $this->share_status = true;
        $this->add_category = true;
    }

    protected function createViewData()
    {
        return [
            'categories' => $this->categoryModel->where('module', $this->module)->findAll(),
            'blogs' => $this->contentModel->where('module', $this->module)->findAll(),
        ];
    }

    protected function editViewData($blog)
    {
        return [
            'categories' => $this->categoryModel->where('module', $this->module)->findAll(),
            'blogs' => $this->contentModel->where([
                'module'=> $this->module,
                'id !=' => $blog->id
            ])->findAll(),
            'blog' => $blog
        ];
    }

}