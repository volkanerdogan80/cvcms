<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Controllers\Traits\ContentTrait;
use App\Models\ThemeModel;

class Page extends BaseController
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

    public function __construct()
    {
        $this->__traitConstruct();

        $this->module = config('system')->page;
        $this->listing_all_permit = 'admin_page_listing_all';
        $this->edit_all_permit = 'admin_page_edit_all';
        $this->status_all_permit = 'admin_page_status_all';
        $this->delete_all_permit = 'admin_page_delete_all';
        $this->undo_delete_all_permit = 'admin_page_undo_delete_all';
    }

    protected function createViewData()
    {
        return [
            'template_list' => $this->getPageTemplate()
        ];
    }

    protected function editViewData($page)
    {
        return[
            'page' => $page,
            'template_list' => $this->getPageTemplate()
        ];
    }

    protected function getPageTemplate()
    {
        helper('filesystem');
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
    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'purge_delete_empty_fields')
                ]);
            }
            $page = $this->contentModel->where('user_id !=', session('userData.id'))->find($data);
            if ($page){
                if(!cve_permit_control('admin_page_purge-delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang_path('Errors', 'page_purge_delete_failure')
                    ]);
                }
            }

            $purgeDelete = $this->contentModel->delete($data, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'purge_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'purge_delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors','invalid_request_type')
        ]);
    }
}