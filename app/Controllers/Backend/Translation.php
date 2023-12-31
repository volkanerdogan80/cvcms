<?php


namespace App\Controllers\Backend;


use App\Controllers\BaseController;

class Translation extends BaseController
{

    public function listing()
    {
        return view(PANEL_FOLDER . '/pages/translation/listing');
    }

    public function folderList()
    {
        if ($this->request->isAJAX()){
            if (!cve_permit_control('translation_listing')){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Translation', 'no_permit')
                ]);
            }

            $lang = $this->request->getPost('lang');

            $folder = directory_map(APPPATH . 'Language/' . $lang);

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success','create_success'),
                'view' => view(PANEL_FOLDER . '/pages/translation/partials/folder-list', [
                    'folder_list' => $folder,
                    'lang' => $lang
                ])
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'invalid_request_type')
        ]);

    }

    public function files($lang, $folder)
    {
        $files = directory_map(APPPATH . 'Language/' . $lang . '/' .$folder);

        return view(PANEL_FOLDER . "/pages/translation/files", [
            'files' => $files,
            'path' => APPPATH . 'Language/'.$lang.'/'.$folder.'/',
            'lang' => $lang,
            'folder' => $folder
        ]);
    }

    public function translate($lang, $folder, $file)
    {
        $path = APPPATH . 'Language/' . $lang . '/' . $folder . '/' . $file . '.php';

        if ($this->request->getMethod() == 'post'){

            $translate = $this->request->getPost('translate');

            $str = "";
            foreach ($translate['text'] as $key => $value){
                $str .= "'".$key."' => '".addslashes($value)."', \n";
            }

            $text = "<?php 
            return [
                'title' => '".$translate["title"]."',
                'description' => '".$translate["description"]."',
                    'text' => [
                        ".$str."
                    ]
                ];";

            $t_file = fopen($path, 'w');
            fwrite($t_file, $text);
            fclose($t_file);

            return redirect()->back()->with('success', cve_admin_lang('Success', 'update_success'));
        }

        $strings = include $path;

        return view(PANEL_FOLDER . '/pages/translation/translate', [
            'strings' => $strings
        ]);
    }

}