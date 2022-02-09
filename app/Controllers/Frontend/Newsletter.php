<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\Traits\NewsletterTrait;

class Newsletter extends BaseController
{
    use NewsletterTrait;

    public function subscribe()
    {
        if ($this->request->getMethod() == 'post') {
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');

            $insert = $this->newsletterModel->insert([
                'name' => $name,
                'email' => $email,
                'token' => random_string('alpha', 64)
            ]);

            if ($this->newsletterModel->errors()){
                return redirect()->back()->with('error', $this->newsletterModel->errors());
            }

            $subscriber = $this->newsletterModel->find($insert);

            $this->emailTo->setUser($subscriber)->newsletterSubscribeSuccess()->send();

            return redirect()->back()->with('success', 'Başarılı bir şekilde abone oldunuz.');

        }

        return redirect()->back()->with('error', 'Geçersiz istek türü');
    }

}