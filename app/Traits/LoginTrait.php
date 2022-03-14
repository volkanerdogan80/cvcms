<?php


namespace App\Traits;


use App\Libraries\EmailTo;
use App\Models\GroupModel;
use App\Models\UserModel;

trait LoginTrait
{
    public function login()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ];

        $validation = \Config\Services::validation();
        if(!$validation->run($data, 'login')){
            return $this->response([
                'status' => false,
                'message' => $validation->getErrors()
            ]);
        }

        $user_model = new UserModel();
        $user = $user_model->getUserByEmail($data['email'], false);
        if(!$user){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'user_not_found')
            ]);
        }

        $group_model = new GroupModel();
        $admin = $group_model->getGroup(['id' => $user->getGroupID(), 'slug' => DEFAULT_ADMIN_GROUP]);
        if (!config('system')->login && !$admin){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'login_system_inactive')
            ]);
        }

        $group = $group_model->getGroupById($user->getGroupID());
        if(!$group->haveLoginPermit()){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'no_login_permit')
            ]);
        }

        if(!$user->getPasswordVerify($data['password'])){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'user_info_failure')
            ]);
        }

        if($user->getStatus() == STATUS_PASSIVE){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'user_login_passive_failure')
            ]);
        }

        $email_to = new EmailTo();
        if($user->getStatus() == STATUS_PENDING){
            $email_to->setData(['user' => $user])
                ->setSubject('Hesap Doğrulama Maili')   // TODO: Türkçe Ingilzice çeviri yap
                ->setEmail($user->getEmail())
                ->setTemplate('accountVerify')
                ->send();

            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'user_login_pending_failure')
            ]);
        }

        session()->set([
            'isLogin' => true,
            //TODO: auth_helper => auth_user içerisine alsak daha iyi olur mu?
            'userData' => [
                'id' => $user->id,
                'email' => $user->getEmail(),
                'name'  => $user->getFullName(),
                'group'  => $group->getSlug(),
                'phone'  => $user->getPhone(),
                'identity'  => $user->getIdentity(),
            ],
            'permissions' => $group->getPermit()
        ]);

        return $this->success($user);
    }
}
