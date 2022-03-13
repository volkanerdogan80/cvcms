<?php


namespace App\Traits;


use App\Libraries\EmailTo;
use App\Models\UserModel;

trait ForgotTrait
{
    public function forgotPassword()
    {
        $data = [
            'email' => $this->request->getPost('email')
        ];

        $validation = \Config\Services::validation();

        if(!$validation->run($data, 'forgot')){
            return $this->response([
                'status' => false,
                'message' => $validation->getErrors()
            ]);
        }

        $user_model = new UserModel();
        $user = $user_model->getUserByEmail($data['email'], false);

        if (!$user){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'user_not_found')
            ]);
        }

        $email_to = new EmailTo();
        $send = $email_to->setData(['user' => $user])
            ->setEmail($user->getEmail())
            ->setSubject('Şifre Sıfırlama Maili') // TODO: Çeviri sistemine al
            ->setTemplate('forgotPassword')
            ->send();

        if(!$send){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'reset_email_failure')
            ]);
        }

        return $this->success();
    }
}
