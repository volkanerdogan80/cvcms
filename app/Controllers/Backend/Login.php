<?php

namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Controllers\Traits\AuthTrait;
use CodeIgniter\I18n\Time;

class Login extends BaseController
{

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
            return $this->login();
        }

        return view(PANEL_FOLDER . '/pages/auth/login', [
            'time' => new Time('now')
        ]);
    }

    public function loginSuccess()
    {
        return redirect()->to(route_to('admin_dashboard'));
    }

    public function logoutSuccess()
    {
        return redirect()->to(route_to('admin_login'));
    }
}