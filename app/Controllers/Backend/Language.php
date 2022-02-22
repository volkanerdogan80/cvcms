<?php

namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Controllers\Traits\LanguageTrait;
use App\Entities\LanguageEntity;
use App\Models\LanguageModel;

class Language extends BaseController
{
    use LanguageTrait;

    protected $languageModel;
    protected $languageEntity;

    public function __construct()
    {
        $this->languageModel = new LanguageModel();
        $this->languageEntity = new LanguageEntity();
    }

    public function listing(string $status = null)
    {
        $getDateFilter = $this->request->getGet('dateFilter');
        $dateFilter = explode(' - ', $getDateFilter);
        $dateFilter = count($dateFilter) > 1 ? $dateFilter : null;

        $perPage = $this->request->getGet('per_page');
        $perPage = !empty($perPage) ? $perPage : 20;

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $data = [
            'perPage'     => $perPage,
            'dateFilter'  => $getDateFilter,
            'search'      => $search,
            'default'     => config('app')->defaultLocale
        ];

        $getModel = $this->languageModel->getListing($status, $search, $dateFilter, $perPage);

        $data = array_merge($data, $getModel);

        return view(PANEL_FOLDER . '/pages/language/listing', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() == 'post'){
            $code = $this->request->getPost('code');
            $title = $this->request->getPost('title');

            $this->languageEntity->setCode($code);
            $this->languageEntity->setTitle($title);
            $this->languageEntity->setFlag();

            $insertID = $this->languageModel->insert($this->languageEntity);

            if($this->languageModel->errors()){
                return redirect()->back()->with('error', $this->languageModel->errors());
            }

            recurse_copy(LANGUAGE_PATH.'en', LANGUAGE_PATH.$code);

            return redirect()->route('admin_language_edit', [$insertID])->with('success', cve_admin_lang('Success', 'create_success'));

        }

        return view(PANEL_FOLDER . '/pages/language/create');
    }

    public function edit($id)
    {
        $language = $this->languageModel->find($id);

        if ($this->request->getMethod() == 'post'){
            $code = $this->request->getPost('code');
            $title = $this->request->getPost('title');

            $this->languageEntity->setId($id);
            $this->languageEntity->setCode($code);
            $this->languageEntity->setTitle($title);
            $this->languageEntity->setFlag();

            $this->languageModel->update($id, $this->languageEntity);

            if($this->languageModel->errors()){
                return redirect()->back()->with('error', $this->languageModel->errors());
            }

            if ($language->getCode() != $code){
                recurse_copy(LANGUAGE_PATH.'en', LANGUAGE_PATH.$code);
                if (is_dir(LANGUAGE_PATH . $language->getCode())) {
                    delete_directory(LANGUAGE_PATH . $language->getCode());
                }
            }
            return redirect()->back()->with('success', cve_admin_lang('Success', 'update_success'));

        }

        return view(PANEL_FOLDER . '/pages/language/edit',[
            'language' => $language
        ]);
    }

    public function delete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'delete_empty_fields')
                ]);
            }
            $data = !is_array($data) ? [$data] : $data;
            $default = config('app')->defaultLocale;

            $control = $this->languageModel
                ->where('code', $default)
                ->find($data);

            if($control){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'default_language_delete_failure')
                ]);
            }

            $delete = $this->languageModel->delete($data);
            if (!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'delete_failure')
                ]);
            }

            $this->supportedLocalesChange();

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'delete_failure')
        ]);
    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'restore_empty_fields')
                ]);
            }
            $update = $this->languageModel->update($data, ['deleted_at' => null]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'undo_delete_failure')
                ]);
            }

            $this->supportedLocalesChange();

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'undo_delete_success')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'undo_delete_failure')
        ]);

    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'purge_delete_empty_fields')
                ]);
            }
            $language = $this->languageModel->onlyDeleted()->find($data);

            $purgeDelete = $this->languageModel->delete($data, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'purge_delete_failure')
                ]);
            }
            if(is_array($language)){
                foreach ($language as $item){
                    if (is_dir(LANGUAGE_PATH . $item->getCode())) {
                        delete_directory(LANGUAGE_PATH . $item->getCode());
                    }
                }
            }else{
                if (is_dir(LANGUAGE_PATH . $language->getCode())) {
                    delete_directory(LANGUAGE_PATH . $language->getCode());
                }

            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'purge_delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'purge_delete_failure')
        ]);
    }

    public function status()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            if (!$data){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'change_status_empty_fields')
                ]);
            }
            $status = $this->request->getPost('status');
            $default = config('app')->defaultLocale;

            if ($status == STATUS_PASSIVE){
                $control = $this->languageModel
                    ->where('code', $default)
                    ->find($data);

                if ($control){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'default_language_status_failure')
                    ]);
                }
            }

            $update = $this->languageModel->update($data, ['status' => $status]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'status_change_failure')
                ]);
            }

            $this->supportedLocalesChange();

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'status_change_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'status_change_failure')
        ]);
    }

    public function default()
    {
        if($this->request->isAJAX()){
            $id = $this->request->getPost('id');
            $control = $this->languageModel
                ->where('status', STATUS_ACTIVE)
                ->where('id', $id)
                ->first();

            if (!$control){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'default_language_inactive')
                ]);
            }

            $this->defaultLocaleChange($control->getCode());

            return $this->response->setJSON([
                'status' => true,
                'default' => $control->getCode(),
                'message' => cve_admin_lang('Success', 'new_default_language') . $control->getTitle()
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'default_language_change_failure')
        ]);
    }

    private function supportedLocalesChange()
    {
        $languages = cve_language();
        $langList = "";
        foreach ($languages as $item) {
            $langList .= "'".$item->getCode()."',";
        }
        $langList = rtrim($langList, ',');

        if (count($languages) == 1){
            $this->defaultLocaleChange($languages[0]->getCode());
        }

        $file = APPPATH.'Config/App.php';
        $content = file_get_contents($file);
        $content = preg_replace('/\$supportedLocales = \[(.*?)\];/', '$supportedLocales = ['.$langList.'];', $content);
        file_put_contents($file, $content);
    }

    private function defaultLocaleChange($lang = null)
    {
        if (!is_null($lang)){
            $file = APPPATH.'Config/App.php';
            $content = file_get_contents($file);
            $content = preg_replace('/\$defaultLocale = \'(.*?)\';/', '$defaultLocale = \''.$lang.'\';', $content);
            file_put_contents($file, $content);
        }
    }
}