<?php


namespace App\Libraries;

use App\Models\ContentModel;
use \Facebook\Facebook as FacebookGrap;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookResponseException;

class Facebook
{
    protected $setting;
    protected $facebook;
    protected $content;
    protected $contentModel;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
        $this->setting = config('autoshare')->facebook;
        $this->facebook = new FacebookGrap([
            'app_id' => $this->setting['appId'] ?: "undefined",
            'app_secret' => $this->setting['appSecret'] ?: "undefined",
            'default_graph_version' => 'v2.5'
        ]);
    }

    public function config($content_id = null)
    {
        if (!is_array($content_id)){
            if (!is_null($content_id)){
                $content = $this->contentModel->find($content_id);
                $this->content = (object) [
                    'id' => $content->id,
                    'content' => $content->getContent(),
                    'slug' => $content->getSlug(),
                    'title' => $content->getTitle(),
                    'status' => $content->getStatus(),
                ];
            }else{
                $this->content = (object) [
                    'content' => 'Test İçerik - ' . random_string(16),
                    'slug' => '',
                    'title' => 'Test Başlık - ' . random_string(16),
                    'status' => STATUS_ACTIVE,
                    'test' => true
                ];
            }
        }else{
            $this->content = (object) [
                'is_array' => true,
            ];
        }
        return $this;
    }

    public function getLoginURL()
    {
        $helper = $this->facebook->getRedirectLoginHelper();
        $permissions = explode(',', $this->setting['permissions']);
        return $helper->getLoginUrl($this->setting['callbackURL'], $permissions);
    }

    public function getAccessToken()
    {
        $helper = $this->facebook->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(FacebookResponseException $e) {
            return null;
        } catch(FacebookSDKException $e) {
            return null;
        }

        if (! isset($accessToken)) {
            return null;
        }

        $token = $accessToken->getValue();

        $oAuth2Client = $this->facebook->getOAuth2Client();
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);

        $tokenMetadata->validateAppId($this->setting['appId']);
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                return null;
            }
            $token = $accessToken->getValue();
        }

        return $token;

    }

    public function getPage()
    {
        try {
            $response = $this->facebook->get(
                '/me/accounts',
                $this->setting['accessToken']
            );
        } catch(FacebookResponseException $e) {
            return null;
        } catch(FacebookSDKException $e) {
            return null;
        }

        $graphNode =  $response->getGraphEdge()->asArray();

        return (object) [
            'name' => $graphNode[0]['name'],
            'page_id' => $graphNode[0]['id']
        ];
    }

    public function publish($force = false)
    {

        $longLivedToken = $this->facebook->getOAuth2Client()->getLongLivedAccessToken($this->setting['accessToken']);
        $this->facebook->setDefaultAccessToken($longLivedToken);

        $response = $this->facebook->sendRequest('GET', $this->setting['pageId'], ['fields' => 'access_token'])
            ->getDecodedBody();

        $foreverPageAccessToken = $response['access_token'];
        $this->facebook->setDefaultAccessToken($foreverPageAccessToken);


        if (isset($this->content->test)){
            return $this->send();
        }

        if (isset($this->content->is_array)){
            return false;
        }

        $shared = $this->contentModel->share('shared', $this->content->id, 'Facebook');
        if ($this->setting['status'] && $this->content->status == STATUS_ACTIVE && (!$shared || $force)){
            $send = $this->send();
            if ($send){
                $this->contentModel->share('publish', $this->content->id, 'Facebook', 1);
                return true;
            }else{
                $this->contentModel->share('publish', $this->content->id, 'Facebook', 0);
                return false;
            }
        }
        return false;
    }

    private function send()
    {
        try {
            $this->facebook->sendRequest('POST', $this->setting['pageId'] . "/feed", [
                'message' => substr($this->content->content, 0, 500),
                'link' => base_url($this->content->slug), // TODO: URL proje sonunda kontrol et
            ]);
            return true;
        }catch (\Exception $exception){
            return false;
        }
    }

}