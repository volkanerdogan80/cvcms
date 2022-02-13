<?php

namespace Modules\Sample\Controllers;

use App\Controllers\BaseController;

class Sample extends BaseController
{

    public function listing()
    {
        return view('Modules\Sample\Views\listing');
    }

}