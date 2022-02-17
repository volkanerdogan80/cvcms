<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Entities\ThemeEntity;
use App\Models\ThemeModel;

class Themes extends BaseController
{
    protected $themeModel;
    protected $themeEntity;

    public function __construct()
    {
        $this->themeModel = new ThemeModel();
        $this->themeEntity = new ThemeEntity();
    }

    public function listing()
    {
        helper('filesystem');

        return view(PANEL_FOLDER . "/pages/theme/listing", [
            'themes' => directory_map(ROOTPATH . 'themes'),
            'active' => $this->themeModel->where('status', STATUS_ACTIVE)->first()
        ]);
    }

    public function delete(string $folder)
    {
        $theme = $this->themeModel->where('folder', $folder)->where('status', STATUS_ACTIVE)->first();
        if ($theme){
            return redirect()->back()->with('error', cve_admin_lang_path('Errors','theme_active_deletion_error'));
        }

        $view_path = THEMES_PATH . $folder;
        delete_directory($view_path);

        foreach (cve_language(false, null) as $key => $value){
            $lang_path = APPPATH . 'Language/' . $value->getCode() . '/' . $folder;
            delete_directory($lang_path);
        }

        return redirect()->back()->with('success', cve_admin_lang_path('Success','delete_success'));

    }

    public function setting()
    {
        $theme = $this->themeModel->where('status', STATUS_ACTIVE)->first();

        if($this->request->getMethod() == 'post'){
            if (!cve_permit_control('admin_theme_setting_update')){
                return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'unauthorized_request'));
            }

            $setting = $this->request->getPost('setting');

            $this->themeEntity->setId($theme->id);
            $this->themeEntity->setSetting($setting);

            $this->themeModel->where('status', STATUS_ACTIVE)
                ->where('folder', $theme->getFolder())->update(null, $this->themeEntity);

            if ($this->themeModel->errors()){
                return redirect()->back()->with('error', $this->themeModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'theme_setting_updated'));

        }

        return view(PANEL_FOLDER . "/pages/theme/setting", [
            'theme' => $theme
        ]);
    }

    public function active(string $folder)
    {
        $theme = $this->themeModel->where('folder', $folder)->first();
        $this->themeModel->where('status', STATUS_ACTIVE)
            ->update(null, ['status' => STATUS_PASSIVE]);

        if ($theme){
            $this->themeModel->update($theme->id, ['status' => STATUS_ACTIVE]);
        }else{
            $file = include ROOTPATH . "themes/" . $folder . '/info.php';
            $this->themeEntity->setFolder($folder);
            $this->themeEntity->setName($file['name']);
            $this->themeEntity->setAuthor($file['author']);
            $this->themeEntity->setWeb($file['web']);
            $this->themeEntity->setEmail($file['email']);
            $this->themeEntity->setStatus(STATUS_ACTIVE);
            $this->themeEntity->setSetting();

            $this->themeModel->insert($this->themeEntity);
        }

        if ($this->themeModel->errors()){
            return redirect()->back()->with('error', $this->themeModel->errors());
        }

        return redirect()->back()->with('success', cve_admin_lang_path('Success', 'theme_activated_success'));
    }

}