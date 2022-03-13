<?php


namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Libraries\EmailTo;
use App\Models\UserModel;
use App\Traits\ResponseTrait;

class Reset extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'code' => $this->request->getPost('code'),
            'password' => $this->request->getPost('password')
        ];

        $validation = \Config\Services::validation();
        if (!$validation->run($data, 'api_reset_password')){
            return $this->response([
                'status' => false,
                'message' => $validation->getErrors()
            ]);
        }

        $user_model = new UserModel();
        $user = $user_model->getUser([
            'email' => $data['email'],
            'verify_code' => $data['code']
        ]);

        if (!$user){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'user_not_found')
            ]);
        }

        $user_entity = new UserEntity();
        $user_entity->setVerifyCode();
        $user_entity->setPassword($data['password']);
        $update = $user_model->update($user->id, $user_entity);
        if (!$update){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'password_update_failure')
            ]);
        }

        $email_to = new EmailTo();
        $email_to->setData(['user' => $user])
            ->setEmail($user->getEmail())
            ->setSubject('Şifreniz Başarıyla Değiştirildi')           // TODO: Çeviri yap
            ->setTemplate('passwordChangeSuccess')
            ->send();

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'reset_password_success_message')
        ]);
    }
}
