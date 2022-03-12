<?php


namespace App\Controllers\Api;

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
            'message' => cve_admin_lang('Success', 'login_success'),
            'data' => $user
        ]);
    }
}
