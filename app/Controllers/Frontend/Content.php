<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\ContentModel;

class Content extends BaseController
{

    public function index($slug)
    {
        print_r($slug);
        echo 'Content';
    }

}