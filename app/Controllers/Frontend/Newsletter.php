<?php


namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Libraries\EmailTo;
use App\Models\NewsletterModel;
use App\Traits\NewsletterTrait;
use App\Traits\ResponseTrait;


class Newsletter extends BaseController
{
    use ResponseTrait;
    use NewsletterTrait;

    public function subscribe()
    {
        if ($this->request->getMethod() == 'post') {
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');

            $newsletter_model = new NewsletterModel();
            $insert = $newsletter_model->insert([
                'name' => $name ? $name : null,
                'email' => $email,
                'token' => random_string('alpha', 64)
            ]);

            if ($newsletter_model->errors()){
                return $this->response([
                    'status' => false,
                    'message' => $newsletter_model->errors()
                ]);
            }

            $email_to = new EmailTo();
            $subscriber = $newsletter_model->find($insert);
            $email_to->setData(['user' => $subscriber])
                ->setEmail($subscriber->email)
                ->setTemplate('newsletterSubscribeSuccess')
                ->send();

            return $this->response([
                'status' => true,
                'message' => cve_admin_lang('Success','subscribe_success')
            ]);
        }

        return $this->response([
            'status' => false,
            'message' => cve_admin_lang('Errors','invalid_request_type')
        ]);
    }

}