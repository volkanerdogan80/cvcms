<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;

class Content extends BaseController
{

    public function index($slug)
    {
        print_r($slug);
    }

}