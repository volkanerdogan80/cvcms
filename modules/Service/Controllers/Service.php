<?php


namespace Modules\Service\Controllers;

use App\Controllers\BaseController;
use App\Interfaces\ContentInterface;
use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Traits\ContentTrait;
use App\Traits\ResponseTrait;

class Service extends BaseController implements ContentInterface
{
    use ResponseTrait;
    use ContentTrait;

    private $module = 'service';
    private $listing_all_permit = 'admin_service_listing_all';

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
                'redirect' => route_to('admin_service_edit', $insert_id)
            ]);
        }
        $category_model = new CategoryModel();
        $content_model = new ContentModel();

        return cve_module_view($this->module, 'create/index', [
            'categories' => $category_model->getCategoriesByModule($this->module),
            'similar' => $content_model->getContentsByModule($this->module),
        ]);
    }

    public function edit($id)
    {
        if ($this->request->getMethod() == 'post') {
            $content_id = $this->contentEdit($id);
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'update_success'),
                'redirect' => route_to('admin_service_edit', $content_id) //Bu redirect'i vermezsek back olarak döner.
            ]);
        }
        $category_model = new CategoryModel();
        $content_model = new ContentModel();
        return cve_module_view($this->module, 'edit/index', [
            'categories' => $category_model->getCategoriesByModule($this->module,false, false),
            'similar' => $content_model->getContentsByModule($this->module, false, false),
            'content' => $content_model->getContentById($id,false)
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
        $this->module = 'service';
        $this->listing_all_permit = 'admin_blog_listing_all';
        $this->edit_all_permit = 'blog_edit_all';
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