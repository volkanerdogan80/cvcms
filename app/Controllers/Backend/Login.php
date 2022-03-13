<?php

namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Traits\LoginTrait;
use App\Traits\ResponseTrait;
use CodeIgniter\I18n\Time;

class Login extends BaseController
{
    use ResponseTrait;
    use LoginTrait;

    public function index()
    {
        if($this->request->getMethod() == 'post'){
            return $this->login();
        }

        return view('admin/pages/auth/login', [
            'time' => new Time('now')
        ]);
    }

    public function success($user = null)
    {
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Auth', 'welcome') . ' ' . $user->full_name,
            'redirect' => route_to('admin_dashboard')
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return $this->response([
            'status' => true,
            'message' => '',
            'redirect' => route_to('admin_login')
        ]);
    }
}