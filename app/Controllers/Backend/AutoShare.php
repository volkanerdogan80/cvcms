<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;
use App\Libraries\Facebook;
use App\Libraries\LinkedIn;
use App\Libraries\Twitter;
use App\Models\ContentModel;

class AutoShare extends BaseController
{
    protected $twitter;
    protected $linkedIn;
    protected $facebook;
    protected $contentModel;
    protected $settings;

    public function __construct()
    {
        $this->twitter = new Twitter();
        $this->linkedIn = new LinkedIn();
        $this->facebook = new Facebook();
        $this->contentModel = new ContentModel();
        $this->settings = config('autoshare');
    }

    public function twitter()
    {
        if ($this->settings->twitter['status']){
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'content_id_valid_failure')
                ]);
            }

            $content = $this->contentModel->find($id);
            if (!$content){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'content_absent_failure')
                ]);
            }

            $this->twitter->config($id)->publish(true);

            if ($content->getStatus() != STATUS_ACTIVE){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'content_status_inactive')
                ]);
            }
            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang_path('Success', 'twitter_published')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'twitter_status_inactive')
        ]);
    }

    public function linkedIn()
    {
        if ($this->settings->linkedin['status'])
        {
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'content_id_valid_failure')
                ]);
            }

            $content = $this->contentModel->find($id);
            if (!$content){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'content_absent_failure')
                ]);
            }

            if ($content->getStatus() != STATUS_ACTIVE){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'content_status_inactive')
                ]);
            }

            if ($this->linkedIn->config($id)->publish(true)){
                return $this->response->setJSON([
                    'status' => true,
                    'message' => cve_admin_lang_path('Success', 'linkedin_published')
                ]);
            }

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'linkedin_status_inactive')
        ]);
    }

    public function facebook()
    {
        /*
         * TODO: Access Tokenlar için bitiş süreleri yazılacak
         * Bağlantıyı kes metodu eklenecek
         * Page ID vs alırken 2 kere kaydetmek gerek ona bir çözüm bulmak gerek
        */
        if ($this->settings->facebook['status']){
            $id = $this->request->getPost('id');
            if (!$id){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'content_id_valid_failure')
                ]);
            }

            $content = $this->contentModel->find($id);
            if (!$content){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'content_absent_failure')
                ]);
            }

            if ($content->getStatus() != STATUS_ACTIVE){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang_path('Errors', 'content_status_inactive')
                ]);
            }

            if ($this->facebook->config($id)->publish(true)){
                return $this->response->setJSON([
                    'status' => true,
                    'message' => cve_admin_lang_path('Success', 'facebook_published')
                ]);
            }
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang_path('Errors', 'facebook_status_inactive')
        ]);
    }

    public function linkedInCallback()
    {
        if ($this->request->getGet('code')){
            $access_token = $this->linkedIn->getAccessToken($this->request->getGet('code'));
            if ($access_token){
                return redirect()->to(route_to('admin_setting_autoshare'))->with('linkedinAccessToken', $access_token);
            }
        }
    }

    public function linkedInTest()
    {
        if ($this->linkedIn->config()->publish()){
            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'linkedin_test_published'));
        }

        return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'linkedin_test_publish_failure'));
    }

    public function facebookCallback()
    {
        if ($this->request->getGet('code')){
            $access_token = $this->facebook->getAccessToken($this->request->getGet('code'));
            if ($access_token){
                return redirect()->to(route_to('admin_setting_autoshare'))->with('facebookAccessToken', $access_token);
            }
        }
        return null;
    }

    public function facebookTest()
    {
        if ($this->facebook->config()->publish()){
            return redirect()->back()->with('success', cve_admin_lang_path('Success', 'facebook_test_published'));
        }
        return redirect()->back()->with('error', cve_admin_lang_path('Errors', 'facebook_test_publish_failure'));
    }

}