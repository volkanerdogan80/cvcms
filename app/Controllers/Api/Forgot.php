<?php


namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Traits\ForgotTrait;
use App\Traits\ResponseTrait;

class Forgot extends BaseController
{
    use ResponseTrait;
    use ForgotTrait;

    public function index()
    {
        return $this->forgotPassword();
    }

    public function success()
    {
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'reset_email_success')
        ]);
    }
}
