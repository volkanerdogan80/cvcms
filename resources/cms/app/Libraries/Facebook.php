<?php


namespace App\Libraries;

use \Facebook\Facebook as FacebookGrap;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookResponseException;

class Facebook
{
    protected $setting;
    protected $facebook;

    public function __construct()
    {
        $this->setting = config('autoshare')->facebook;
        $this->facebook = new FacebookGrap([
            'app_id' => $this->setting['appId'],
            'app_secret' => $this->setting['appSecret'],
            'default_graph_version' => 'v2.5'
        ]);
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

        print_r($tokenMetadata);
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

        //return (object) [
        //    'name'      => $graphNode[0]['name'],
        //    'page_id'   => $graphNode[0]['id']
        //];
    }

}