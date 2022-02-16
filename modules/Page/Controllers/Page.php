<?php


namespace Modules\Page\Controllers;

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
        $this->purge_delete_all = 'admin_blog_purge-delete_all';
        $this->add_category = false;
    }

    protected function createViewData()
    {
        return [
            'template_list' => page_template()
        ];
    }

    protected function editViewData($content)
    {
        return [
            'content' => $content,
            'template_list' => page_template()
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
}