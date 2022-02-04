<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\LanguageEntity;
use App\Models\LanguageModel;

class Language extends BaseController
{
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

        $perPage = $this->request->getGet('perPage');
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

        return view('admin/pages/language/listing', $data);
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

            return redirect()->route('admin_language_edit', [$insertID])->with('success', 'Yeni dil sisteme eklendi.');

        }

        return view('admin/pages/language/create');
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
            return redirect()->back()->with('success', 'Dil bilgileri başarılı bir şekilde değiştirildi.');

        }

        return view('admin/pages/language/edit',[
            'language' => $language
        ]);
    }

    public function delete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            $data = !is_array($data) ? [$data] : $data;
            $default = config('app')->defaultLocale;

            $control = $this->languageModel
                ->where('code', $default)
                ->find($data);

            if($control){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Varsayılan dili silemezsiniz.'
                ]);
            }

            $delete = $this->languageModel->delete($data);
            if (!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Dil silme işlemi esnasında bir hata meydana geldi.'
                ]);
            }

            $this->supportedLocalesChange();

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Dil başarılı bir şekilde silindi.'
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Dil silme işlemi esnasında bir hata meydana geldi.'
        ]);
    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $update = $this->languageModel->update($data, ['deleted_at' => null]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => lang('Errors.text.undo_delete_error')
                ]);
            }

            $this->supportedLocalesChange();

            return $this->response->setJSON([
                'status' => true,
                'message' => lang('Success.text.undo_delete')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => lang('Errors.text.undo_delete_error')
        ]);

    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            $language = $this->languageModel->onlyDeleted()->find($data);

            $purgeDelete = $this->languageModel->delete($data, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => lang('Errors.text.purge_delete_error')
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
                'message' => lang('Success.text.purge_delete')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => lang('Errors.text.purge_delete_error')
        ]);
    }

    public function changeLanguage($lang){
        $uri = new \CodeIgniter\HTTP\URI(previous_url());
        $segments = $uri->getSegments();
        $segments[0] = $lang; // kök dizin değişince segment[0] olmalı yoksa çalışmaz!!
        $query = $uri->getQuery();
        $newUri = implode('/', $segments);
        $newUri = $query ? $newUri . '?' . $query : $newUri;
        return redirect()->to(base_url($newUri));
    }

    public function status()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            $status = $this->request->getPost('status');
            $default = config('app')->defaultLocale;

            if ($status == STATUS_PASSIVE){
                $control = $this->languageModel
                    ->where('code', $default)
                    ->find($data);

                if ($control){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => 'Varsayılan dilin durumunu değiştiremezsiniz.'
                    ]);
                }
            }

            $update = $this->languageModel->update($data, ['status' => $status]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Dilin durumu değiştirilirken bir hata meydana geldi.'
                ]);
            }

            $this->supportedLocalesChange();

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Dilin durumu başarılı bir şekilde değiştirildi.'
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Dilin durumu değiştirilirken bir hata meydana geldi.'
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
                    'message' => 'Varsayılan dil durumu aktif olmak zorunda.'
                ]);
            }

            $this->defaultLocaleChange($control->getCode());

            return $this->response->setJSON([
                'status' => true,
                'default' => $control->getCode(),
                'message' => 'Varsayılan dil ' . $control->getTitle() . ' olarak değiştirildi.'
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Varsayılan dil değiştirilirken bir hata meydana geldi.'
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