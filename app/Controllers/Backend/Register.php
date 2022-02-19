<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Controllers\Traits\AuthTrait;
use App\Controllers\Traits\ResponseTrait;

class Register extends BaseController
{

    use ResponseTrait;
    use AuthTrait{
        AuthTrait::__construct as private __traitConstruct;
    }

    public function __construct()
    {
        $this->__traitConstruct();
    }

    public function index()
    {
        if($this->request->getMethod() == 'post'){
            return $this->register();
        }

        return view(PANEL_FOLDER . '/pages/auth/register');
    }
}