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

    public function __construct()
    {
        $this->twitter = new Twitter();
        $this->linkedIn = new LinkedIn();
        $this->facebook = new Facebook();
        $this->contentModel = new ContentModel();
    }

    public function twitter()
    {
        $id = $this->request->getPost('id');
        if (!$id){
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Lütfen geçerli bir içerik ID değeri gönderin.'
            ]);
        }

        $content = $this->contentModel->find($id);
        if (!$content){
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Böyle bir içerik bulunamadı.'
            ]);
        }

        if ($content->getStatus() != STATUS_ACTIVE){
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Twitter yayınlabilmek için içerik durumu aktif olmalıdır.'
            ]);
        }

        $this->twitter->config($id)->publish(true);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'İçerik Twitter\'da başarılı bir şekilde yayınaldı.'
        ]);
    }

    public function linkedIn()
    {
        $id = $this->request->getPost('id');
        if (!$id){
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Lütfen geçerli bir içerik ID değeri gönderin.'
            ]);
        }

        $content = $this->contentModel->find($id);
        if (!$content){
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Böyle bir içerik bulunamadı.'
            ]);
        }

        if ($content->getStatus() != STATUS_ACTIVE){
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Twitter yayınlabilmek için içerik durumu aktif olmalıdır.'
            ]);
        }

        if ($this->linkedIn->config($id)->publish(true)){
            return $this->response->setJSON([
                'status' => true,
                'message' => 'İçerik LinkedIn\'da başarılı bir şekilde yayınaldı.'
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'İçerik LinkedIn\'de paylaşılırken bir hata meydana geldi.'
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
            return redirect()->back()->with('success', 'LinkedIn profilinizde test içerik paylaşıldı.');
        }

        return redirect()->back()->with('error', 'LinkedIn profilinizde test içerik paylaşılamadı.');
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

}