<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ComponentModel;
use App\Models\SettingModel;
use App\Models\ThemeModel;
use CodeIgniter\Cache\Handlers\FileHandler;
use Config\Services;

class Config extends BaseController
{
    public static function Site()
    {
        try {
            $model = new SettingModel();

            helper('cve');
            $setting = cve_cache('site_setting', function () use($model){
                return $model->where('skey', 'site')->first();
            });

            if($setting){
                return [
                    'title'         => $setting->getValue('title', true),
                    'description'   => $setting->getValue('description', true),
                    'keywords'      => $setting->getValue('keywords', true),
                    'headerLogo'    => $setting->getValue('headerLogo'),
                    'footerLogo'    => $setting->getValue('footerLogo'),
                    'mobileLogo'    => $setting->getValue('mobileLogo'),
                    'favicon'       => $setting->getValue('favicon'),
                ];
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }
    }

    public static function System()
    {
        try {
            $model = new SettingModel();

            helper('cve');
            $setting = cve_cache('system_setting', function () use($model){
                return $model->where('skey', 'system')->first();
            });

            if($setting){
                return [
                    'maintenance'   => $setting->getValue('maintenance'),
                    'register'      => $setting->getValue('register'),
                    'login'         => $setting->getValue('login'),
                    'emailVerify'   => $setting->getValue('emailVerify'),
                    'defaultGroup'  => $setting->getValue('defaultGroup'),
                    'registerPage'  => $setting->getValue('registerPage'),
                    'loginPage'     => $setting->getValue('loginPage'),
                    'forgotPage'    => $setting->getValue('forgotPage'),
                    'perPageList'   => explode(',', $setting->getValue('perPageList')),
                    'autoPublic'    => $setting->getValue('autoPublic'),
                    'install'       => $setting->getValue('install'),
                ];
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }

    }

    public static function Contact()
    {
        try {
            $model = new SettingModel();

            helper('cve');
            $setting = cve_cache('contact_setting', function () use($model){
                return $model->where('skey', 'contact')->first();
            });

            if($setting){
                return $setting->getValue(null,true);
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }
    }

    public static function Social()
    {
        try {
            $model = new SettingModel();

            helper('cve');
            $setting = cve_cache('social_setting', function () use($model){
                return $model->where('skey', 'social')->first();
            });

            if($setting){
                return $setting->getValue(null,true);
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }
    }

    public static function Email()
    {
        try {
            $model = new SettingModel();

            helper('cve');
            $setting = cve_cache('email_setting', function () use($model){
                return $model->where('skey', 'email')->first();
            });

            if($setting){
                return [
                    'protocol'   => $setting->getValue('protocol'),
                    'fromEmail'  => $setting->getValue('fromEmail'),
                    'fromName'   => $setting->getValue('fromName'),
                    'SMTPHost'   => $setting->getValue('SMTPHost'),
                    'SMTPUser'   => $setting->getValue('SMTPUser'),
                    'SMTPPass'   => $setting->getValue('SMTPPass'),
                    'SMTPPort'   => $setting->getValue('SMTPPort'),
                    'SMTPCrypto' => $setting->getValue('SMTPCrypto'),
                    'mailType'   => $setting->getValue('mailType'),
                    'template'   => json_decode($setting->getValue('template'), true)
                ];
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }

    }

    public static function Cache()
    {
        try {
            $model = new SettingModel();
            helper('cve');

            if(session()->has('cache_conf')){
                $config = session()->getTempdata('cache_conf');
                $cache = Services::cache($config);
                if (!$setting = $cache->get(cve_slug_creator('cache_setting'))){
                    $setting = $model->where('skey', 'cache')->first();
                    $cache->save(cve_slug_creator('cache_setting'), $setting, $config->raw_time);
                }
            }else{
                $setting = $model->where('skey', 'cache')->first();
            }

            if ($setting){
                return [
                    'html'      => $setting->getValue('html'),
                    'raw'       => $setting->getValue('raw'),
                    'html_time' => $setting->getValue('html_time'),
                    'raw_time'  => $setting->getValue('raw_time'),
                    'handler'   => $setting->getValue('handler'),
                    'prefix'    => $setting->getValue('prefix'),
                    'memcached' => $setting->getValue('memcached', true),
                    'redis'     => $setting->getValue('redis', true),
                ];
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }

    }

    public static function Images()
    {
        try {
            $model = new SettingModel();

            helper('cve');
            $setting = cve_cache('image_setting', function () use($model){
                return $model->where('skey', 'image')->first();
            });

            if($setting){
                return [
                    'defaultHandler' => $setting->getValue('defaultHandler'),
                    'thumbnail'      => explode(',', $setting->getValue('thumbnail')),
                    'compressor'     => $setting->getValue('compressor'),
                    'delete'         => $setting->getValue('delete'),
                    'watermark'      => $setting->getValue('watermark', true),
                ];
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }

    }

    public static function Sitemap()
    {
        try {
            $model = new SettingModel();

            helper('cve');
            $setting = cve_cache('sitemap_setting', function () use($model){
                return $model->where('skey', 'sitemap')->first();
            });

            $settings = [];

            foreach (cve_module_list() as $module){
                $settings = array_merge($settings, [
                    $module => !is_null($setting) ? $setting->getValue($module, true) : [],
                ]);
            }

            if($setting){
                return [
                    'modules' => $settings,
                ];
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }
    }

    public static function Webmaster()
    {
        try {
            $model = new SettingModel();

            helper('cve');
            $setting = cve_cache('webmaster_setting', function () use($model){
                return $model->where('skey', 'webmaster')->first();
            });

            if($setting){
                return [
                    'reCaptchaKey'      => $setting->getValue('reCaptchaKey'),
                    'accountId'         => $setting->getValue('accountId'),
                    'code'              => $setting->getValue('code'),
                ];
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }

    }

    public static function Firebase()
    {
        try {
            $model = new SettingModel();

            helper('cve');
            $setting = cve_cache('firebase_setting', function () use($model){
                return $model->where('skey', 'firebase')->first();
            });

            if($setting){
                return [
                    'status'        => $setting->getValue('status'),
                    'serverKey'     => $setting->getValue('serverKey'),
                    'apiKey'        => $setting->getValue('apiKey'),
                    'authDomain'    => $setting->getValue('authDomain'),
                    'databaseURL'   => $setting->getValue('databaseURL'),
                    'projectId'     => $setting->getValue('projectId'),
                    'storageBucket' => $setting->getValue('storageBucket'),
                    'messagingSenderId' => $setting->getValue('messagingSenderId'),
                    'appId'         => $setting->getValue('appId'),
                    'measurementId' => $setting->getValue('measurementId'),
                ];
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }

    }

    public static function AutoShare()
    {
        try {
            $model = new SettingModel();

            helper('cve');
            $setting = cve_cache('autoshare_setting', function () use($model){
                return $model->where('skey', 'autoshare')->first();
            });

            if($setting){
                return [
                    'twitter'       => $setting->getValue('twitter',true),
                    'facebook'      => $setting->getValue('facebook',true),
                    'linkedin'      => $setting->getValue('linkedin',true),
                    'pinterest'     => $setting->getValue('pinterest',true),
                    'medium'        => $setting->getValue('medium',true),
                    'googleMyBusiness' => $setting->getValue('googleMyBusiness',true),
                ];
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }

    }

    public static function Theme()
    {
        try {
            $model = new ThemeModel();

            helper('cve');
            $theme = cve_cache('theme_setting', function () use($model){
                return $model->where('status', STATUS_ACTIVE)->first();
            });

            if($theme){
                return $theme->getSetting(null, true);
            }
            return [];
        }catch (\Exception $exception){
            return [];
        }
    }

    public static function Component()
    {
        try {
            $model = new ComponentModel();

            helper('cve');
            $components = cve_cache('component_setting', function () use($model){
                return $model->where('status', STATUS_ACTIVE)->findAll();
            });

            $settings = [];
            foreach ($components as $key => $value){
                $settings = array_merge($settings, $value->getSetting(null, true));
            }
            return $settings;
        }catch (\Exception $exception){
            return [];
        }
    }
}