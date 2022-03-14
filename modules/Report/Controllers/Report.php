<?php


namespace Modules\Report\Controllers;

use App\Controllers\BaseController;
use App\Interfaces\ContentInterface;
use App\Traits\ContentTrait;
use App\Traits\ResponseTrait;

class Report extends BaseController implements ContentInterface
{
    use ResponseTrait;
    use ContentTrait;

    private $module = 'report';
    private $listing_all_permit = 'admin_report_listing_all';

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
        $this->module = 'report';
        $this->listing_all_permit = 'admin_report_listing_all';
        $this->edit_all_permit = 'admin_report_edit_all';
        $this->status_all_permit = 'admin_report_status_all';
        $this->delete_all_permit = 'admin_report_delete_all';
        $this->undo_delete_all = 'admin_report_undo-delete_all';
        $this->purge_delete_all = 'admin_report_purge-delete_all';
        $this->add_category = false;
    }

    protected function createViewData()
    {
        return [
            'categories' => $this->categoryModel->where('module', $this->module)->findAll()
        ];
    }

    protected function editViewData($content)
    {
        return [
            'categories' => $this->categoryModel->where('module', $this->module)->findAll(),
            'content' => $content
        ];
    }

    public function detail($content){

        return view(cve_module_view($this->module, 'detail/index'), [
            'content' => $this->contentModel->where('id', $content)->find($content),
        ]);
    }*/
}