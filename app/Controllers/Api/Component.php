<?php


namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Traits\ComponentTrait;
use App\Traits\ResponseTrait;

class Component extends BaseController
{

    use ComponentTrait;
    use ResponseTrait;

    public function listing()
    {
        return $this->response([
            'status' => true,
            'data' => $this->componentListing()
        ]);
    }

    public function active($folder)
    {
        return $this->componentActive($folder);
    }

    public function passive($folder)
    {
        return $this->componentPassive($folder);
    }

    public function delete($folder)
    {
        return $this->componentDelete($folder);
    }
}
