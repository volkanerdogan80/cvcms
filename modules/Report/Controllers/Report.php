<?php


namespace Modules\Report\Controllers;

use App\Controllers\BaseController;
use App\Interfaces\ContentInterface;
use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Traits\ContentTrait;
use App\Traits\ResponseTrait;

class Report extends BaseController implements ContentInterface
{
    use ResponseTrait;
    use ContentTrait;

    private $module = 'report';
    private $listing_all_permit = 'admin_report_listing_all';
    private $edit_all_permit = 'admin_report_edit_all';
    private $status_all_permit = 'admin_report_status_all';
    private $delete_all_permit = 'admin_report_delete_all';
    private $undo_delete_all = 'admin_report_undo-delete_all';
    private $purge_delete_all = 'admin_report_purge-delete_all';

    public function listing($status = null)
    {
        $data = $this->contentListing($status);
        return cve_module_view($this->module, 'listing', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() == 'post') {
            $insert_id = $this->contentCreate();
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'create_success'),
                'redirect' => route_to('admin_report_edit', $insert_id)
            ]);
        }
        $category_model = new CategoryModel();
        return cve_module_view($this->module, 'create/index', [
            'categories' => $category_model->getCategoriesByModule($this->module),
        ]);
    }

    public function edit($id)
    {
        if ($this->request->getMethod() == 'post') {
            $this->contentEdit($id);
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'update_success'),
                'redirect' => route_to('admin_report_edit', $this->content_id) //Bu redirect'i vermezsek back olarak döner.
            ]);
        }
        $category_model = new CategoryModel();
        $content_model = new ContentModel();

        return cve_module_view($this->module, 'edit/index', [
            'categories' => $category_model->getCategoriesByModule($this->module,false, false),
            'content' => $content_model->getContentById($id,false)
        ]);
    }

    public function status()
    {
        return $this->contentStatus();
    }

    public function delete()
    {
        return $this->contentDelete();
    }

    public function undoDelete()
    {
        return $this->contentUndoDelete();
    }

    public function purgeDelete()
    {
        return $this->contentPurgeDelete();
    }
    public function detail($content){

        $content_model = new ContentModel();
        return view(cve_module_view($this->module, 'detail/index'), [
            //TODO: Burayı değiştircez.
            'content' => $content_model->where('id', $content)->find($content),
        ]);
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