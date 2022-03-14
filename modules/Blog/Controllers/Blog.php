<?php


namespace Modules\Blog\Controllers;

use App\Controllers\BaseController;
use App\Interfaces\ContentInterface;
use App\Traits\ContentTrait;
use App\Traits\ResponseTrait;

class Blog extends BaseController implements ContentInterface
{
    use ResponseTrait;
    use ContentTrait;

    private $module = 'blog';
    private $listing_all_permit = 'admin_blog_listing_all';

    public function listing($status = null)
    {
        $data = $this->contentListing($status);
        return cve_module_view($this->module, 'listing', $data);
    }
    /*protected $module;
    protected $listing_all_permit;
    protected $edit_all_permit;
    protected $status_all_permit;
    protected $delete_all_permit;
    protected $undo_delete_all;
    protected $purge_delete_all;
    protected $add_category;

    public function __construct()
    {
        $this->__traitConstruct();
        $this->module = 'blog';
        $this->listing_all_permit = 'admin_blog_listing_all';
        $this->edit_all_permit = 'admin_blog_edit_all';
        $this->status_all_permit = 'admin_blog_status_all';
        $this->delete_all_permit = 'admin_blog_delete_all';
        $this->undo_delete_all = 'admin_blog_undo-delete_all';
        $this->purge_delete_all = 'admin_blog_purge-delete_all';
        $this->add_category = true;
    }

    protected function createViewData()
    {
        return [
            'categories' => $this->categoryModel->where('module', $this->module)->findAll(),
            'similar' => $this->contentModel->where('module', $this->module)->findAll(),
        ];
    }

    protected function editViewData($content)
    {
        return [
            'categories' => $this->categoryModel->where('module', $this->module)->findAll(),
            'similar' => $this->contentModel->where([
                'module'=> $this->module,
                'id !=' => $content->id
            ])->findAll(),
            'content' => $content
        ];
    }*/
}