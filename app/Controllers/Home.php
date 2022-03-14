<?php namespace App\Controllers;

use App\Entities\SliderEntity;
use App\Models\SliderModel;

class Home extends BaseController
{

    public function index()
    {

        print_r(auth_user_permissions());
    }

}
