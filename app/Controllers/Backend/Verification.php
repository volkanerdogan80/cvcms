<?php

namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Libraries\EmailTo;
use App\Models\UserModel;

class Verification extends BaseController
{
    protected $userModel;
    protected $userEntity;
    protected $emailTo;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userEntity = new UserEntity();
        $this->emailTo = new EmailTo();
    }

    public function account($token)
    {
        $decode = base64_decode($token);
        $explode = explode('.',$decode);

        if(!isset($explode[1]) || !isset($explode[0])){
            return view(PANEL_FOLDER . '/pages/verify/account-error');
        }

        $userID = $explode[0];
        $verifyKey = $explode[1];

        $user_model = new UserModel();
        $user = $user_model->getUser([
            'id' => $userID,
            'verify_key' => $verifyKey,
            'status' => STATUS_PENDING
        ]);

        if(!$user){
            return view(PANEL_FOLDER . '/pages/verify/account-error');
        }
        $user_entity = new UserEntity();
        $user_entity->setStatus(STATUS_ACTIVE);
        $user_entity->setVerifyKey();

        $update = $user_model->update($user->id, $user_entity);
        if (!$update){
            return view(PANEL_FOLDER . '/pages/verify/account-error');
        }

        $this->emailTo->setData(['user' => $user])
            ->setEmail($user->getEmail())
            ->setSubject('Hesabınız Başarılı Şekilde Doğrulandı')
            ->setTemplate('accountVerifySuccess')
            ->send();

        return view(PANEL_FOLDER . '/pages/verify/account-success');

    }

    public function forgot($token)
    {
        $decode = base64_decode($token);
        $explode = explode('.',$decode);

        if(!isset($explode[1]) || !isset($explode[0])){
            return view(PANEL_FOLDER . '/pages/verify/forgot-error');
        }

        $userID = $explode[0];
        $verifyKey = $explode[1];

        $user = $this->userModel->where([
            'id' => $userID,
            'verify_key' => $verifyKey
        ])->first();

        if(!$user){
            return view(PANEL_FOLDER . '/pages/verify/forgot-error');
        }

        $this->userEntity->setVerifyKey();
        $update = $this->userModel->update($userID, $this->userEntity);
        if (!$update){
            return view(PANEL_FOLDER . '/pages/verify/forgot-error');
        }

        session()->setTempdata('userID', $userID, 300);
        return redirect()->to(route_to('admin_reset_password'));
    }

}