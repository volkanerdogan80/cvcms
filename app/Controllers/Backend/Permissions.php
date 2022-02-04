<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class Permissions extends BaseController
{
    public function error()
    {
        if($this->request->isAJAX()){
            return $this->response->setJSON([
                'status' => false,
                'message' => cve_admin_lang_path('Errors', 'unauthorized_request')
            ]);
        }
        return view(PANEL_FOLDER . '/pages/verify/permissions-error');
    }
}