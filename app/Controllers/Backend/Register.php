<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Libraries\EmailTo;
use App\Models\NewsletterModel;
use App\Models\UserRoleModel;
use App\Models\UserModel;

class Register extends BaseController
{
    protected $newsletterModel;
    protected $userEntity;
    protected $userModel;
    protected $groupModel;
    protected $system;
    protected $validation;
    protected $emailTo;

    public function __construct()
    {
        $this->newsletterModel = new NewsletterModel();
        $this->userEntity = new UserEntity();
        $this->userModel = new UserModel();
        $this->groupModel = new UserRoleModel();
        $this->system = config('system');
        $this->validation = \Config\Services::validation();
        $this->emailTo = new EmailTo();
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

            if($this->request->getPost('newsletter') == 'on'){
                $this->newsletterModel->insert([
                    'name' => $this->userEntity->getFullName(),
                    'email' => $this->userEntity->getEmail(),
                    'token' => random_string('alpha', 64)
                ]);
            }

            $insert = $this->userModel->insert($this->userEntity);

            if($this->userModel->errors()){
                return redirect()->back()->with('error', $this->userModel->errors());
            }

            $user = $this->userModel->find($insert);

            if ($this->system->emailVerify){
                $to = $this->emailTo->setUser($user)->accountVerify()->send();
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