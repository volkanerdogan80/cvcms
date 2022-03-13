<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Traits\RegisterTrait;
use App\Traits\ResponseTrait;

class Register extends BaseController
{
    use ResponseTrait;
    use RegisterTrait;

    public function index()
    {
        if($this->request->getMethod() == 'post'){
            return $this->register();
        }

        return view(PANEL_FOLDER . '/pages/auth/register');
    }

    public function success()
    {
        return $this->response(true);
    }
}