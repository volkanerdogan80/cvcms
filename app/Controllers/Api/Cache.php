<?php

namespace App\Controllers\Api;

use \App\Controllers\BaseController;
use App\Traits\CacheTrait;
use App\Traits\ResponseTrait;

class Cache extends BaseController
{

    use CacheTrait;
    use ResponseTrait;

    public function clean()
    {
        $this->cacheClear();
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'cache_clean')
        ]);
    }
}