<?php

namespace Modules\Services\Controllers;

use App\Controllers\BaseController;

class Service extends BaseController
{

    public function listing()
    {
        return view('Modules\Services\Views\listing');
    }

}