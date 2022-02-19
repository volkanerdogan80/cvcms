<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\Traits\AuthTrait;
use App\Controllers\Traits\ResponseTrait;

class Login extends BaseController
{
    use ResponseTrait;
    use AuthTrait{
        AuthTrait::__construct as private __traitConstruct;
    }

    public function __construct()
    {
        $this->__traitConstruct();
    }

    public function loginSuccess()
    {
        $response = [
            'status' => true,
            'message' => 'Giriş işlemi başarılı'
        ];

        $isModal = $this->request->getPost('is_modal');

        if (empty($isModal)){
            $response['route'] = 'homepage';
        }

        return $this->response($response);
    }

    public function logoutSuccess()
    {
        $response = [
            'status' => true,
            'message' => 'Çıkış işlemi başarılı',
            'route' => 'homepage'
        ];

        return $this->response($response);
    }
}
