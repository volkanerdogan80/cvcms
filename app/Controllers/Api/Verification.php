<?php


namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Libraries\EmailTo;
use App\Models\UserModel;
use App\Traits\ResponseTrait;

class Verification extends BaseController
{
    use ResponseTrait;

    public function account()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'code' => $this->request->getPost('code')
        ];

        $validation = \Config\Services::validation();
        if (!$validation->run($data, 'api_account_verify')){
            return $this->response([
                'status' => false,
                'message' => $validation->getErrors()
            ]);
        }

        $user_model = new UserModel();
        $user = $user_model->getUser([
            'verify_code' => $data['code'],
            'email' => $data['email'],
            'status' => STATUS_PENDING
        ]);

        if (!$user){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'verification_code_failure')
            ]);
        }

        $user_entity = new UserEntity();
        $user_entity->setVerifyCode();
        $user_entity->setStatus(STATUS_ACTIVE);

        $update = $user_model->update($user->id, $user_entity);
        if (!$update){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'verification_failure_msg')
            ]);
        }

        $email_to = new EmailTo();
        $email_to->setData(['user' => $user])
            ->setEmail($user->getEmail())
            ->setSubject('Hesabınız Başarılı Şekilde Doğrulandı')
            ->setTemplate('accountVerifySuccess')
            ->send();

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'verification_success')
        ]);
    }
}
