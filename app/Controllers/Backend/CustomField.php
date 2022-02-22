<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;

class CustomField extends BaseController
{
    public function add()
    {
        $type = $this->request->getGet('type');
        return $this->response->setJSON([
            'status' => true,
            'message' => cve_admin_lang('Success', 'extra_field_added'),
            'view' => view(PANEL_FOLDER . '/pages/field/' . $type, [
                'random' => random_string('alpha',4)
            ])
        ]);
    }

    public function postFormat()
    {
        $view = "";
        $get_format = $this->request->getGet('format');
        $format = post_format()[$get_format];

        if (isset($format['custom_field'])){
            foreach ($format['custom_field'] as $item) {
                if ($item['lang']){
                    $view = $view . view('admin/pages/field/translation', [
                            'random' => $item['key'], 'value' => $item['value'], 'key' => $item['key']
                        ]);
                }else{
                    $view = $view . view('admin/pages/field/standard', [
                            'random' => $item['key'], 'value' => $item['value'], 'key' => $item['key']
                        ]);
                }
            }
        }

        return $this->response->setJSON([
            'status' => true,
            'message' => cve_admin_lang('Success','create'),
            'view' => $view
        ]);
    }
}