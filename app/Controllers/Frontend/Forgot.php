<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\Traits\AuthTrait;

class Forgot extends BaseController
{
    use AuthTrait{
        AuthTrait::__construct as private __traitConstruct;
    }

    public function __construct()
    {
        $this->__traitConstruct();
    }
}