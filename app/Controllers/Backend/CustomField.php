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
            'message' => cve_admin_lang_path('Success', 'extra_field_added'),
            'view' => view(PANEL_FOLDER . '/pages/field/' . $type, [
                'random' => random_string('alpha',4)
            ])
        ]);
    }
}