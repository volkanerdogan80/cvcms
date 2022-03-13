<?php


namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Libraries\EmailTo;
use App\Models\UserModel;
use App\Traits\ResponseTrait;

class Reset extends BaseController
{
    use ResponseTrait;

    public function index($token)
    {
        $decode = base64_decode($token);
        $explode = explode('.',$decode);

        if(!isset($explode[1]) || !isset($explode[0])){
            return view('admin/pages/verify/forgot-error');
        }

        $user_id = $explode[0];
        $verifyKey = $explode[1];

        $user_model = new UserModel();
        $user = $user_model->getUser([
            'id' => $user_id,
            'verify_key' => $verifyKey
        ]);

        if(!$user){
            return view(PANEL_FOLDER . '/pages/verify/forgot-error');
        }

        if ($this->request->getMethod() == 'post') {
            return $this->reset($user);
        }

        return view(PANEL_FOLDER . '/pages/auth/reset-password');
    }

    public function reset($user)
    {
        $data = [
            'password' => $this->request->getPost('password'),
            'password2' => $this->request->getPost('password2')
        ];

        $validation = \Config\Services::validation();
        if(!$validation->run($data, 'resetPassword')){
            return $this->response([
                'status' => false,
                'message' => $validation->getErrors()
            ]);
        }

        $user_entity = new UserEntity();
        $user_entity->setVerifyKey();
        $user_entity->setPassword($data['password']);

        $user_model = new UserModel();
        $update = $user_model->update($user->id, $user_entity);
        if(!$update){
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

        session()->destroy();
        return view('admin/pages/verify/reset-password-success');
    }
}
