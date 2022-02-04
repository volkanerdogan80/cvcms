<?php


namespace App\Libraries;


use App\Models\ContentModel;

class LinkedIn
{
    protected $contentModel;
    protected $content;
    protected $setting;
    protected $curl;
    protected $csrf;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
        $this->setting = config('autoshare')->linkedin;
        $this->curl = \Config\Services::curlrequest();
        $this->csrf = csrf_hash();
    }

    public function getLoginURL()
    {
        session()->set('linkedincsrf', $this->csrf);
        return "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=". $this->setting['appId'] . "&redirect_uri=".$this->setting['callbackURL'] ."&state=". $this->csrf."&scope=". $this->setting['scopes'] ;
    }

    public function getAccessToken($code = null)
    {
        $response = $this->curl->request('POST', 'https://www.linkedin.com/oauth/v2/accessToken', [
            'form_params' => [
                'client_id' => $this->setting['appId'],
                'client_secret' => $this->setting['appSecret'],
                'redirect_uri' => $this->setting['callbackURL'],
                'code' => $code,
                'grant_type' => 'authorization_code',
            ]
        ]);

        return json_decode($response->getBody())->access_token;
    }

    public function getUser()
    {
        if (!empty($this->setting['accessToken'])){
            try {
                $response = $this->curl->request('GET', 'https://api.linkedin.com/v2/me', [
                    'query' => [
                        'projection' => '(id,firstName,lastName,profilePicture(displayImage~:playableStreams))',
                        'oauth2_access_token' => $this->setting['accessToken']
                    ]
                ]);

                $body = json_decode($response->getBody());
                $country = $body->firstName->preferredLocale->country;
                $language = $body->firstName->preferredLocale->language;
                $locale = $language . '_' . $country;
                $first_name = $body->firstName->localized->$locale;
                $last_name = $body->lastName->localized->$locale;
                return (object) [
                    'name' => $first_name . ' ' . $last_name,
                    'accountId' => $body->id
                ];
            }catch (\Exception $exception){
                return null;
            }
        }

        return null;
    }

    public function config($content_id = null)
    {
        if (!is_array($content_id)){
            if (!is_null($content_id)){
                $content = $this->contentModel->find($content_id);
                $this->content = (object) [
                    'id'        => $content->id,
                    'content'   => $content->getContent(),
                    'slug'      => $content->getSlug(),
                    'title'     => $content->getTitle(),
                    'status'    => $content->getStatus(),
                ];
            }else{
                $this->content = (object) [
                    'content'   => 'Test İçerik - ' . random_string(16),
                    'slug'      => '',
                    'title'     => 'Test Başlık - ' . random_string(16),
                    'status'    => STATUS_ACTIVE,
                    'test'      => true
                ];
            }
        }else{
            $this->content = (object) [
                'is_array' => true,
            ];
        }
        return $this;
    }

    public function publish($force = false)
    {
        if (isset($this->content->test)){
            return $this->send();
        }

        if (isset($this->content->is_array)){
            return false;
        }

        $shared = $this->contentModel->share('shared', $this->content->id, 'LinkedIn');
        if ($this->setting['status'] && $this->content->status == STATUS_ACTIVE && (!$shared || $force)){
            $send = $this->send();
            if ($send){
                $this->contentModel->share('publish', $this->content->id, 'LinkedIn', 1);
                return true;
            }else{
                $this->contentModel->share('publish', $this->content->id, 'LinkedIn', 0);
                return false;
            }
        }
        return false;
    }

    private function send()
    {
        try {
            $response = $this->curl->request('POST', 'https://api.linkedin.com/v2/ugcPosts?oauth2_access_token=' . $this->setting['accessToken'], [
                'json' => [
                    "author" => "urn:li:person:" . $this->setting['accountId'],
                    "lifecycleState" => "PUBLISHED",
                    "specificContent" => [
                        "com.linkedin.ugc.ShareContent" => [
                            "shareCommentary" => [
                                "text" => $this->content->content,
                            ],
                            "shareMediaCategory" => "ARTICLE",
                            "media"=> [[
                                "status" => "READY",
                                "description"=> [
                                    "text" => substr($this->content->content, 0, 200),
                                ],
                                "originalUrl" =>  base_url($this->content->slug), // TODO: URL proje sonunda kontrol et

                                "title" => [
                                    "text" => $this->content->title,
                                ],
                            ]],
                        ],

                    ],
                    "visibility" => [
                        "com.linkedin.ugc.MemberNetworkVisibility" => 'PUBLIC',
                    ]
                ]
            ]);

            $body = json_decode($response->getBody());
            if (isset($body->id)){
                return true;
            }
            return false;
        }catch (\Exception $exception){
            return false;
        }
    }
}