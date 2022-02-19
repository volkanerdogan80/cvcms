<?php


namespace App\Controllers\Traits;

use App\Entities\UserEntity;
use App\Libraries\EmailTo;
use App\Models\GroupModel;
use App\Models\NewsletterModel;
use App\Models\UserModel;

trait AuthTrait
{
    protected $newsletterModel;
    protected $userModel;
    protected $userEntity;
    protected $groupModel;
    protected $emailTo;
    protected $system;
    protected $validation;

    public function __construct()
    {
        $this->newsletterModel = new NewsletterModel();
        $this->userModel = new UserModel();
        $this->userEntity = new UserEntity();
        $this->groupModel = new GroupModel();
        $this->emailTo = new EmailTo();
        $this->system = config('system');
        $this->validation = \Config\Services::validation();
    }

    //TODO: Register olurken şifre en az 8 karakter olmalıdır, ve strong pass alert özellikleri.
    public function register()
    {
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
            $to = $this->emailTo->setData(['user' => $user])
                ->setEmail($user->getEmail())
                ->setSubject('Hesap Doğrulama Maili') // TODO: Çeviri sistemine al
                ->setTemplate('accountVerify')
                ->send();

            if($to){
                return redirect()->back()->with('success', cve_admin_lang_path('Success', 'register_success'));
            }

            return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'email_send_failure'));
        }

        return redirect()->back()->with('success', cve_admin_lang_path('Success', 'register_success'));
    }

    public function login()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ];

        if(!$this->validation->run($data, 'login')){
            return redirect()->back()->with('error', $this->validation->getErrors());
        }

        $user = $this->userModel->where('email', $data['email'])->first();
        if(!$user){
            return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'user_not_found'));
        }

        if (!config('system')->login){
            $adminControl = $this->groupModel->where(['id' => $user->getGroupID(), 'slug' => DEFAULT_ADMIN_GROUP])->first();
            if (!$adminControl){
                return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'login_system_inactive'));
            }
        }

        $group = $this->groupModel->find($user->getGroupID());
        if(!$group->haveLoginPermit()){
            return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'no_login_permit'));
        }

        if(!$user->getPasswordVerify($data['password'])){
            return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'user_info_failure'));
        }

        if($user->getStatus() == STATUS_PENDING){

            $this->emailTo->setData(['user' => $user])
                ->setSubject('Hesap Doğrulama Maili')
                ->setEmail($user->getEmail())
                ->setTemplate('accountVerify')
                ->send();

            return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'user_login_pending_failure'));
        }

        if($user->getStatus() == STATUS_PASSIVE){
            return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'user_login_passive_failure'));
        }

        session()->set([
            'isLogin' => true,
            'userData' => [
                'id' => $user->id,
                'email' => $user->getEmail(),
                'name'  => $user->getFullName(),
                'group'  => $group->getSlug()
            ],
            'permissions' => $group->getPermit()
        ]);

        return $this->loginSuccess();
    }

    public function forgot(){

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
            ->setSubject('Şifre Sıfırlama Maili') // TODO: Çeviri sistemine al
            ->setTemplate('forgotPassword')->send();

        if(!$send){
            return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'password_update_failure'));
        }
        return redirect()->back()->with('success', cve_admin_lang_path('Success', 'reset_email_success'));
    }

    public function logout()
    {
        session()->destroy();
        return $this->logoutSuccess();
    }

}
