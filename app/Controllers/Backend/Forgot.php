<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Libraries\EmailTo;
use App\Models\UserModel;

class Forgot extends BaseController
{
    protected $userModel;
    protected $userEntity;
    protected $emailTo;
    protected $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userEntity = new UserEntity();
        $this->emailTo = new EmailTo();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if($this->request->getMethod() == 'post'){

            $data = [
              'email' => $this->request->getPost('email')
            ];

            if(!$this->validation->run($data, 'forgot')){
                return redirect()->back()->with('error', $this->validation->getErrors());
            }

            $user = $this->userModel->where('email',$data['email'])->first();
            if (!$user){
                return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'user_not_found'));
            }

            $send = $this->emailTo
                ->setData(['user' => $user])
                ->setEmail($user->getEmail())
                ->setSubject('Hesap Doğrulama Maili')
                ->setTemplate('forgotPassword')->send();

            if(!$send){
                return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'password_update_failure'));
            }

            return view(PANEL_FOLDER . '/pages/verify/forgot-success');

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
                    return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'password_update_failure'));
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