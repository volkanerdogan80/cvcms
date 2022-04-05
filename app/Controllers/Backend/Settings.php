<?php

namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Entities\SettingEntity;
use App\Libraries\Facebook;
use App\Libraries\LinkedIn;
use App\Models\ContentModel;
use App\Models\GroupModel;
use App\Models\SettingModel;

class Settings extends BaseController
{
    protected $settingModel;
    protected $settingEntity;
    protected $groupModel;
    protected $contentModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->settingEntity = new SettingEntity();
        $this->groupModel = new GroupModel();
        $this->contentModel = new ContentModel();
    }

    public function home()
    {
        return view(PANEL_FOLDER . '/pages/setting/home');
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

            return redirect()->back()->with('success', cve_admin_lang('Success', 'settings_updated'));

        }

        return view(PANEL_FOLDER . '/pages/setting/site', [
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
                'registerPage' => $this->request->getPost('registerPage'),
                'loginPage' => $this->request->getPost('loginPage'),
                'forgotPage' => $this->request->getPost('forgotPage'),
                'perPageList' => $this->request->getPost('perPageList'),
                'autoPublic' => $this->request->getPost('autoPublic'),
                'install' => true,
            ];

            $this->settingEntity->setKey('system');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'system')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success',  cve_admin_lang('Success', 'settings_updated'));

        }

        return view(PANEL_FOLDER . '/pages/setting/system', [
            'groups' => $this->groupModel->findAll(),
            'setting' => $this->settingModel->where('skey', 'system')->first(),
            'pages' => $this->contentModel->getContentsByModule('page')
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
                'mailType' => $this->request->getPost('mailType'),
                'template' => json_encode($this->request->getPost('template'), JSON_UNESCAPED_UNICODE),
            ];

            $this->settingEntity->setKey('email');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'email')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success',  cve_admin_lang('Success', 'settings_updated'));
        }

        return view(PANEL_FOLDER . '/pages/setting/email', [
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

            return redirect()->back()->with('success',  cve_admin_lang('Success', 'settings_updated'));

        }

        return view(PANEL_FOLDER . '/pages/setting/cache', [
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

            return redirect()->back()->with('success',  cve_admin_lang('Success', 'settings_updated'));

        }

        return view(PANEL_FOLDER . '/pages/setting/image', [
            'setting' => $this->settingModel->where('skey', 'image')->first()
        ]);
    }

    public function sitemap()
    {
        if ($this->request->getMethod() == 'post'){

            $settings = [];

            foreach (cve_module_list() as $module){
                $settings = array_merge($settings, [
                    $module => $this->request->getPost($module)
                ]);
            }

            $this->settingEntity->setKey('sitemap');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'sitemap')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang('Success', 'settings_updated'));

        }

        return view('admin/pages/setting/sitemap', [
            'setting' => $this->settingModel->where('skey', 'sitemap')->first()
        ]);
    }

    public function webmaster()
    {
        if($this->request->getMethod() == 'post'){
            $settings = [
                'reCaptchaKey' => $this->request->getPost('reCaptchaKey'),
                'accountId' => $this->request->getPost('accountId'),
                'code' => $this->request->getPost('code')
            ];

            $this->settingEntity->setKey('webmaster');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'webmaster')->update(null, $this->settingEntity);

            $analyticsFile = $this->request->getFile('analytics-json');
            if($analyticsFile->getName()){
                $analyticsFile->move(WRITEPATH . 'uploads', 'google-analytics-account.json', true);
            }

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success',  cve_admin_lang('Success', 'settings_updated'));

        }
        return view(PANEL_FOLDER . '/pages/setting/webmaster', [
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

            return redirect()->back()->with('success',  cve_admin_lang('Success', 'settings_updated'));
        }

        return view(PANEL_FOLDER . '/pages/setting/firebase', [
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

            return redirect()->back()->with('success',  cve_admin_lang('Success', 'settings_updated'));

        }

        $linkedIn = new LinkedIn();
        $facebook = new Facebook();

        return view(PANEL_FOLDER . '/pages/setting/autoshare', [
            'setting' => $this->settingModel->where('skey', 'autoshare')->first(),
            'linkedin_login' => $linkedIn->getLoginURL(),
            'linkedin_profile' => $linkedIn->getUser(),
            'facebook_login' => $facebook->getLoginURL(),
            'facebook_profile' => $facebook->getPage()
        ]);
    }

    public function social()
    {
        if ($this->request->getMethod() == 'post'){
            $settings = $this->request->getPost('social');

            $this->settingEntity->setKey('social');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'social')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang('Success', 'settings_updated'));
        }

        return view(PANEL_FOLDER. '/pages/setting/social', [
            'setting' => $this->settingModel->where('skey', 'social')->first()
        ]);
    }

    public function contact()
    {
        if ($this->request->getMethod() == 'post'){
            $settings = [];
            $data = $this->request->getPost('contact');

            $i = 0;
            foreach ($data as $key => $value){
                if ($i==0){
                    $settings['office'] = $value;
                }else{
                    $settings['office'.$i] = $value;
                }
                $i++;
            }

            $this->settingEntity->setKey('contact');
            $this->settingEntity->setValue($settings);

            $this->settingModel->where('skey', 'contact')->update(null, $this->settingEntity);

            if($this->settingModel->errors()){
                return redirect()->back()->with('error', $this->settingModel->errors());
            }

            return redirect()->back()->with('success', cve_admin_lang('Success', 'settings_updated'));
        }

        return view(PANEL_FOLDER .'/pages/setting/contact', [
            'setting' => $this->settingModel->where('skey', 'contact')->first()
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