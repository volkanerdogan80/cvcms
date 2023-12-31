<?php


namespace Modules\Page\Controllers;

use App\Controllers\BaseController;
use App\Interfaces\ContentInterface;
use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Traits\ContentTrait;
use App\Traits\ResponseTrait;

class Page extends BaseController implements ContentInterface
{
    use ResponseTrait;
    use ContentTrait;

    private $module = 'page';
    private $listing_all_permit = 'admin_page_listing_all';
    private $edit_all_permit = 'admin_page_edit_all';
    private $status_all_permit = 'admin_page_status_all';
    private $delete_all_permit = 'admin_page_delete_all';
    private $undo_delete_all = 'admin_page_undo-delete_all';
    private $purge_delete_all = 'admin_page_purge-delete_all';

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
                'redirect' => route_to('admin_page_edit', $insert_id)
            ]);
        }
        return cve_module_view($this->module, 'create/index');
    }


    public function edit($id)
    {
        if ($this->request->getMethod() == 'post') {
            $this->contentEdit($id);
            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success', 'update_success'),
                'redirect' => route_to('admin_page_edit', $this->content_id) //Bu redirect'i vermezsek back olarak döner.
            ]);
        }
        $content_model = new ContentModel();
        return cve_module_view($this->module, 'edit/index', [
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
        $this->module = 'page';
        $this->listing_all_permit = 'admin_page_listing_all';
        $this->edit_all_permit = 'admin_page_edit_all';
        $this->status_all_permit = 'admin_page_status_all';
        $this->delete_all_permit = 'admin_page_delete_all';
        $this->undo_delete_all = 'admin_page_undo-delete_all';
        $this->purge_delete_all = 'admin_page_purge-delete_all';
        $this->add_category = false;
    }

    protected function createViewData()
    {
        return [];
    }

    protected function editViewData($content)
    {
        return [
            'content' => $content
        ];
    }

    protected function getPageTemplate()
    {
        $themeModel = new ThemeModel();
        $active_theme = $themeModel->where('status', STATUS_ACTIVE)->first();

        $find_folder = directory_map(APPPATH . 'Views/themes/'.$active_theme->getFolder().'/page');
        $template_list = [];
        foreach ($find_folder as $key => $value){
            $get_file = file_get_contents(APPPATH. 'Views/themes/'.$active_theme->getFolder().'/page/' . $value);
            preg_match_all('#<!-- (.*?) -->#', $get_file, $find);
            $file_name = str_replace('.php', '', $value);
            $template_name = $find[1][0];
            $template_list[$file_name] = $template_name;
        }

        return $template_list;
    }*/
}