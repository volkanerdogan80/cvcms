<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Traits\LoginTrait;
use App\Traits\ResponseTrait;


class Login extends BaseController
{
    use ResponseTrait;
    use LoginTrait;

    public function index()
    {
        return $this->login();
    }

    public function success($user = null)
    {
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'login_success') . ' ' . $user->full_name,
            'redirect' => route_to('homepage')
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return $this->response([
            'status' => true,
            'message' => '',
            'redirect' => route_to('homepage')
        ]);
    }
}