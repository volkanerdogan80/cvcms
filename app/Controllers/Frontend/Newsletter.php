<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\Traits\NewsletterTrait;
use App\Controllers\Traits\ResponseTrait;

class Newsletter extends BaseController
{
    use ResponseTrait;
    use NewsletterTrait;

    public function subscribe()
    {
        if ($this->request->getMethod() == 'post') {
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');

            $insert = $this->newsletterModel->insert([
                'name' => $name ? $name : null,
                'email' => $email,
                'token' => random_string('alpha', 64)
            ]);

            if ($this->newsletterModel->errors()){
                return $this->response([
                    'status' => false,
                    'message' => $this->newsletterModel->errors()
                ]);
            }

            $subscriber = $this->newsletterModel->find($insert);
            $this->emailTo->setUser($subscriber)->newsletterSubscribeSuccess()->send();

            return $this->response(['status' => true, 'message' => 'Başarılı bir şekilde abone oldunuz.']);
        }

        return $this->response(['status' => false, 'message' => 'Geçersiz istek türü']);
    }

}