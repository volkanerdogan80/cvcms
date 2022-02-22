<?php

namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Controllers\Traits\AuthTrait;

class Forgot extends BaseController
{
    use AuthTrait{
        AuthTrait::__construct as private __traitConstruct;
    }

    public function __construct()
    {
        $this->__traitConstruct();
    }

    public function index()
    {
        if($this->request->getMethod() == 'post'){
            return $this->forgot();
        }
        return view(PANEL_FOLDER . '/pages/auth/forgot-password');
    }

    public function resetPassword()
    {
        $userID = session()->getTempdata('userID');
        if($userID){
            if($this->request->getMethod() == 'post'){
                $data = [
                    'password' => $this->request->getPost('password'),
                    'password2' => $this->request->getPost('password2')
                ];

                if(!$this->validation->run($data, 'resetPassword')){
                    return redirect()->back()->with('error', $this->validation->getErrors());
                }

                $this->userEntity->setVerifyKey();
                $this->userEntity->setPassword($data['password']);

                $update = $this->userModel->update($userID, $this->userEntity);
                if(!$update){
                    return redirect()->back()->with('error', cve_admin_lang('Errors', 'password_update_failure'));
                }

                session()->destroy();

                $user = $this->userModel->find($userID);
                $this->emailTo->setData(['user' => $user])
                    ->setEmail($user->getEmail())
                    ->setSubject('Hesap Doğrulama Maili')
                    ->setTemplate('passwordChangeSuccess')
                    ->send();

                return view(PANEL_FOLDER . '/pages/verify/reset-password-success');
            }

            return view(PANEL_FOLDER . '/pages/auth/reset-password');
        }

        return view(PANEL_FOLDER . '/pages/verify/reset-password-error');
    }


}