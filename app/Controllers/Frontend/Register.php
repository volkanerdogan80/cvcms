<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Traits\RegisterTrait;
use App\Traits\ResponseTrait;

class Register extends BaseController
{
    use ResponseTrait;
    use RegisterTrait;

    public function index()
    {
        $this->register();
    }

    public function success()
    {
        return $this->response(true);
    }

}
