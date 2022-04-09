<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Traits\MessageTrait;
use App\Traits\ResponseTrait;

class Message extends BaseController
{
    use ResponseTrait;
    use MessageTrait;

    public function send()
    {
        return $this->messageSend();
    }
}