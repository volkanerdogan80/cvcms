<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Traits\ForgotTrait;
use App\Traits\ResponseTrait;

class Forgot extends BaseController
{
    use ResponseTrait;
    use ForgotTrait;


    public function index()
    {
        if($this->request->getMethod() == 'post'){
            return $this->forgotPassword();
        }
        return view(PANEL_FOLDER . '/pages/auth/forgot-password');
    }

    public function success()
    {
        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'reset_email_success'),
        ]);
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