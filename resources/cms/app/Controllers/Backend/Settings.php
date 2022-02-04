<?php

namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\SettingEntity;
use App\Libraries\Facebook;
use App\Libraries\LinkedIn;
use App\Models\UserRoleModel;
use App\Models\SettingModel;

class Settings extends BaseController
{
    protected $settingModel;
    protected $settingEntity;
    protected $groupModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->settingEntity = new SettingEntity();
        $this->groupModel = new UserRoleModel();
    }

    public function home()
    {
        return view('admin/pages/setting/home');
    }

    public function site()
    {
        if($this->request->getMethod() == 'post'){
            $data =  [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'keywords' => $this->request->getPost('keywords')
            ];
            $logo = $this->logoUpload();
            $settings = array_merge($data, $logo);

            $this->settingEntity->setKey('site');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'site')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde güncellendi.');

        }

        return view('admin/pages/setting/site', [
            'setting' => $this->settingModel->where('skey', 'site')->first()
        ]);
    }

    public function system()
    {
        if($this->request->getMethod() == 'post'){
            $settings = [
                'maintenance' => $this->request->getPost('maintenance'),
                'register' => $this->request->getPost('register'),
                'login' => $this->request->getPost('login'),
                'emailVerify' => $this->request->getPost('emailVerify'),
                'defaultGroup' => $this->request->getPost('defaultGroup'),
                'perPageList' => $this->request->getPost('perPageList'),
            ];

            $this->settingEntity->setKey('system');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'system')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde güncellendi.');

        }

        return view('admin/pages/setting/system', [
            'groups' => $this->groupModel->findAll(),
            'setting' => $this->settingModel->where('skey', 'system')->first()
        ]);
    }

    public function email()
    {
        if ($this->request->getMethod() == 'post'){
            $settings = [
                'protocol' => $this->request->getPost('protocol'),
                'fromEmail' => $this->request->getPost('fromEmail'),
                'fromName' => $this->request->getPost('fromName'),
                'SMTPHost' => $this->request->getPost('SMTPHost'),
                'SMTPUser' => $this->request->getPost('SMTPUser'),
                'SMTPPass' => $this->request->getPost('SMTPPass'),
                'SMTPPort' => $this->request->getPost('SMTPPort'),
                'SMTPCrypto' => $this->request->getPost('SMTPCrypto'),
                'mailType' => $this->request->getPost('mailType')
            ];

            $this->settingEntity->setKey('email');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'email')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde güncellendi.');
        }

        return view('admin/pages/setting/email', [
            'setting' => $this->settingModel->where('skey', 'email')->first()
        ]);
    }

    public function cache()
    {
        if($this->request->getMethod() == 'post'){
            $settings = [
                'html' => $this->request->getPost('html'),
                'raw' => $this->request->getPost('raw'),
                'html_time' => $this->request->getPost('html_time'),
                'raw_time' => $this->request->getPost('raw_time'),
                'handler' => $this->request->getPost('handler'),
                'prefix' => $this->request->getPost('prefix'),
                'memcached' => $this->request->getPost('memcached'),
                'redis' => $this->request->getPost('redis'),
            ];

            $this->settingEntity->setKey('cache');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'cache')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde güncellendi.');

        }

        return view('admin/pages/setting/cache', [
            'setting' => $this->settingModel->where('skey', 'cache')->first()
        ]);
    }

    public function image()
    {
        if($this->request->getMethod() == 'post'){
            $settings = [
                'defaultHandler' => $this->request->getPost('defaultHandler'),
                'thumbnail' => $this->request->getPost('thumbnail'),
                'compressor' => $this->request->getPost('compressor'),
                'delete' => $this->request->getPost('delete'),
                'watermark' => $this->request->getPost('watermark')
            ];

            $this->settingEntity->setKey('image');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'image')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde güncellendi.');

        }

        return view('admin/pages/setting/image', [
            'setting' => $this->settingModel->where('skey', 'image')->first()
        ]);
    }

    public function webmaster()
    {
        if($this->request->getMethod() == 'post'){
            $settings = [
                'googleVerify' => $this->request->getPost('googleVerify'),
                'googleAnalytics' => $this->request->getPost('googleAnalytics'),
                'yandexVerify' => $this->request->getPost('yandexVerify'),
                'yandexMetrika' => $this->request->getPost('yandexMetrika'),
            ];

            $this->settingEntity->setKey('webmaster');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'webmaster')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde güncellendi.');

        }
        return view('admin/pages/setting/webmaster', [
            'setting' => $this->settingModel->where('skey', 'webmaster')->first()
        ]);
    }

    public function firebase()
    {
        if ($this->request->getMethod() == 'post'){
            $settings = [
                'status' => $this->request->getPost('status'),
                'serverKey' => $this->request->getPost('serverKey'),
                'apiKey' => $this->request->getPost('apiKey'),
                'authDomain' => $this->request->getPost('authDomain'),
                'databaseURL' => $this->request->getPost('databaseURL'),
                'projectId' => $this->request->getPost('projectId'),
                'storageBucket' => $this->request->getPost('storageBucket'),
                'messagingSenderId' => $this->request->getPost('messagingSenderId'),
                'appId' => $this->request->getPost('appId'),
                'measurementId' => $this->request->getPost('measurementId'),
            ];

            $this->settingEntity->setKey('firebase');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'firebase')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde güncellendi.');
        }

        return view('admin/pages/setting/firebase', [
            'setting' => $this->settingModel->where('skey', 'firebase')->first()
        ]);
    }

    public function autoshare()
    {
        if ($this->request->getMethod() == 'post'){
            $settings = [
                'twitter' => $this->request->getPost('twitter'),
                'facebook' => $this->request->getPost('facebook'),
                'linkedin' => $this->request->getPost('linkedin'),
                'pinterest' => [],
                'medium' => [],
                'googleMyBusiness' => [],
            ];

            $this->settingEntity->setKey('autoshare');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'autoshare')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde güncellendi.');

        }

        //$linkedIn = new LinkedIn();
        $facebook = new Facebook();

        return view('admin/pages/setting/autoshare', [
            'setting' => $this->settingModel->where('skey', 'autoshare')->first(),
            //'linkedin_login' => $linkedIn->getLoginURL(),
            //'linkedin_profile' => $linkedIn->getUser(),
            'facebook_login' => $facebook->getLoginURL(),
            'facebook_profile' => $facebook->getPage()
        ]);
    }

    private function logoUpload()
    {
        helper(['text', 'inflector']);
        $logoList = [];

        $headerLogo = $this->request->getFile('headerLogo');
        $footerLogo = $this->request->getFile('footerLogo');
        $mobileLogo = $this->request->getFile('mobileLogo');
        $favicon = $this->request->getFile('favicon');
        $setting = $this->settingModel->where('skey', 'site')->first();

        if ($headerLogo->getName()){
            $headerLogoName = convert_accented_characters(underscore($headerLogo->getName()));
            $headerLogo->move(ROOTPATH . UPLOAD_FOLDER_PATH, $headerLogoName);
            $logoList['headerLogo'] = UPLOAD_FOLDER_PATH . $headerLogoName;
        }else{
            $logoList['headerLogo'] = $setting->getValue('headerLogo');
        }

        if ($footerLogo->getName()){
            $footerLogoName = convert_accented_characters(underscore($footerLogo->getName()));
            $footerLogo->move(ROOTPATH . UPLOAD_FOLDER_PATH, $footerLogoName);
            $logoList['footerLogo'] = UPLOAD_FOLDER_PATH . $footerLogoName;
        }else{
            $logoList['footerLogo'] = $setting->getValue('footerLogo');
        }

        if ($mobileLogo->getName()){
            $mobileLogoName = convert_accented_characters(underscore($mobileLogo->getName()));
            $mobileLogo->move(ROOTPATH . UPLOAD_FOLDER_PATH, $mobileLogoName);
            $logoList['mobileLogo'] = UPLOAD_FOLDER_PATH . $mobileLogoName;
        }else{
            $logoList['mobileLogo'] = $setting->getValue('mobileLogo');
        }

        if ($favicon->getName()){
            $faviconName = convert_accented_characters(underscore($favicon->getName()));
            $favicon->move(ROOTPATH . UPLOAD_FOLDER_PATH, $faviconName);
            $logoList['favicon'] = UPLOAD_FOLDER_PATH . $faviconName;
        }else{
            $logoList['favicon'] = $setting->getValue('favicon');
        }

        return $logoList;

    }

}