<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\ContentModel;

class Home extends BaseController
{

    public function index()
    {
        return view('themes/' . cve_theme_folder() . '/index');
    }


}