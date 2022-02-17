<?php

namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Libraries\EmailTo;
use App\Models\UserRoleModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Login extends BaseController
{
    protected $userModel;
    protected $userEntity;
    protected $groupModel;
    protected $emailTo;
    protected $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userEntity = new UserEntity();
        $this->groupModel = new UserRoleModel();
        $this->emailTo = new EmailTo();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if($this->request->getMethod() == 'post'){
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

                return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'user_login_passive_failure'));
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

            return redirect()->to(route_to('admin_dashboard'));

        }

        return view(PANEL_FOLDER . '/pages/auth/login', [
            'time' => new Time('now')
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(route_to('admin_login'));
    }

}