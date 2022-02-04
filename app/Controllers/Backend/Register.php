<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Libraries\EmailTo;
use App\Models\UserRoleModel;
use App\Models\UserModel;

class Register extends BaseController
{
    protected $userEntity;
    protected $userModel;
    protected $groupModel;
    protected $system;
    protected $validation;

    public function __construct()
    {
        $this->userEntity = new UserEntity();
        $this->userModel = new UserModel();
        $this->groupModel = new UserRoleModel();
        $this->system = config('system');
        $this->validation = \Config\Services::validation();
    }
        //TODO: Register olurken şifre en az 8 karakter olmalıdır, ve strong pass alert özellikleri.
    public function index()
    {
        if($this->request->getMethod() == 'post'){
            if(!$this->system->register){
                return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'registry_system_inactive'));
            }

            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'sur_name' => $this->request->getPost('sur_name'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'password2' => $this->request->getPost('password2'),
            ];

            if(!$this->validation->run($data, 'register')){
                return redirect()->back()->with('error', $this->validation->getErrors());
            }

            $status = $this->system->emailVerify ? STATUS_PENDING : STATUS_ACTIVE;

            $this->userEntity->setGroupID($this->system->defaultGroup);
            $this->userEntity->setFirstName($data['first_name']);
            $this->userEntity->setSurName($data['sur_name']);
            $this->userEntity->setEmail($data['email']);
            $this->userEntity->setVerifyKey();
            $this->userEntity->setVerifyCode();
            $this->userEntity->setStatus($status);
            $this->userEntity->setPassword($data['password']);

            $insert = $this->userModel->insert($this->userEntity);

            if($this->userModel->errors()){
                return redirect()->back()->with('error', $this->userModel->errors());
            }

            $email = new EmailTo();
            $user = $this->userModel->find($insert);

            if ($this->system->emailVerify){
                $to = $email->setUser($user)->accountVerify()->send();
                if($to){
                    return redirect()->back()->with('success', cve_admin_lang_path('Success', 'register_success'));
                }

                return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'email_send_failure'));
            }

            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'register_success'));
        }

        return view(PANEL_FOLDER . '/pages/auth/register');
    }
}