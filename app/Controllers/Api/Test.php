<?php


namespace App\Controllers\Api;

use App\Controllers\BaseController;

class Test extends BaseController
{
    public function index()
    {
        print_r($this->request->user->group);
    }
}