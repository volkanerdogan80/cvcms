<?php


namespace App\Libraries;

use App\Models\ContentModel;
use App\Models\FirebaseModel;

class Firebase
{
    protected $client;
    protected $contentModel;
    protected $firebaseModel;
    protected $registration_ids;
    protected $notification;

    public function __construct()
    {
        $this->client = \Config\Services::curlrequest();
        $this->contentModel = new ContentModel();
        $this->firebaseModel = new FirebaseModel();
        $this->registration_ids = [];
        $this->notification = [];
    }

    public function setContent($content): Firebase
    {
        if(is_int($content) || is_numeric($content)){
            $content = $this->contentModel->find($content);
        }

        if (!is_array($content)){
            $image = $content->withThumbnail() ? $content->withThumbnail()->getUrl() : null;
            $title = $content->getTitle();
            $description = $content->getDescription();
            $click_action = base_url(route_to('content', $content->getSlug()));
        }else{
            $image = config('site')->headerLogo;
            $title = $content['title'];
            $description = $content['description'];
            $click_action = $content['click_action'] ?? base_url(route_to('homepage'));
        }

        $this->notification = [
            'title' => $title,
            'body' => $description,
            'icon' => config('site')->favicon,
            'image' => $image,
            'click_action' => $click_action,
        ];

        return $this;

    }

    public function setToken()
    {
        $tokens = $this->firebaseModel->getTokens();
        foreach ($tokens as $key => $value){
            $this->registration_ids[] = $value->token;
        }
        return $this;
    }

    public function send()
    {
        $this->client->setJSON([
            'registration_ids' => $this->registration_ids,
            'notification' => $this->notification
        ]);
        $this->client->setHeader('Authorization', 'key=' . config('firebase')->serverKey);

        try {
            $response = $this->client->post('https://fcm.googleapis.com/fcm/send');
            return $response->getBody();
        }catch (\Exception $exception){
            return false;
        }
    }

}
