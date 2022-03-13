<?php


namespace App\Traits;


use App\Entities\UserEntity;
use App\Libraries\EmailTo;
use App\Models\NewsletterModel;
use App\Models\UserModel;

trait RegisterTrait
{

    public function register()
    {
        if(!config('system')->register){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'registry_system_inactive')
            ]);
        }

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'sur_name' => $this->request->getPost('sur_name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'password2' => $this->request->getPost('password2'),
            'phone' => $this->request->getPost('phone'),
            'identity' => $this->request->getPost('identity'),
        ];

        $validation = \Config\Services::validation();
        if(!$validation->run($data, 'register')){
            return $this->response([
                'status' => false,
                'message' => $validation->getErrors()
            ]);
        }

        $status = config('system')->emailVerify ? STATUS_PENDING : STATUS_ACTIVE;

        $user_model = new UserModel();
        $user_entity = new UserEntity();

        $user_entity->setGroupID(config('system')->defaultGroup);
        $user_entity->setFirstName($data['first_name']);
        $user_entity->setSurName($data['sur_name']);
        $user_entity->setEmail($data['email']);
        $user_entity->setVerifyKey();
        $user_entity->setVerifyCode();
        $user_entity->setApiKey();
        $user_entity->setPhone($data['phone']);
        $user_entity->setIdentity($data['identity']);
        $user_entity->setStatus($status);
        $user_entity->setPassword($data['password']);

        $newsletter_model = new NewsletterModel();
        if ($this->request->getPost('newsletter') == 'on'){
            $newsletter_model->insert([
                'name' => $user_entity->getFullName(),
                'email' => $user_entity->getEmail(),
                'token' => random_string('alpha', 64)
            ]);
        }

        $insert = $user_model->insert($user_entity);
        if($user_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $user_model->errors()
            ]);
        }

        $user = $user_model->getUserById($insert, false);
        if ($user->getStatus() == STATUS_PENDING){
            $email_to = new EmailTo();
            $to = $email_to->setData(['user' => $user])
                ->setEmail($user->getEmail())
                ->setSubject('Hesap Doğrulama Maili') // TODO: Çeviri sistemine dahil et
                ->setTemplate('accountVerify')
                ->send();

            if($to){
                $this->response_message = cve_admin_lang('Success', 'register_email_success');
                return $this->success();
            }
            $this->response_message = cve_admin_lang('Register', 'register_success_email_failure');
            return $this->success();
        }
        $this->response_message = cve_admin_lang('Success', 'register_success');
        return $this->success();
    }
}
