<?php


namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Traits\RegisterTrait;
use App\Traits\ResponseTrait;

class Register extends BaseController
{
    use ResponseTrait;
    use RegisterTrait;

    public function index()
    {
        return $this->register();
    }

    public function success()
    {
        return $this->response(true);
    }
}
