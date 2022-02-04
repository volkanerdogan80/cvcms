<?php


namespace app\Libraries;

use App\Models\ContentModel;
use DG\Twitter\Twitter as DGTwitter;

class Twitter
{
    protected $contentModel;
    protected $content;
    protected $setting;
    protected $twitter;
    protected $title;
    protected $url;

    public function __construct()
    {
        $this->setting = config('autoshare')->twitter;
        $this->contentModel = new ContentModel();
    }

    public function config($content_id)
    {
        $this->twitter = new DGTwitter(
            $this->setting['apiKey'],
            $this->setting['apiKeySecret'],
            $this->setting['accessToken'],
            $this->setting['accessTokenSecret']
        );
        $this->content = $content_id;
        return $this;
    }

    public function publish($force = false)
    {
        if(!is_array($this->content)){
            $content = $this->contentModel->find($this->content);
            $shared = $this->contentModel->share('shared', $this->content, 'twitter');
            if ($this->setting['status'] && $content->getStatus() == STATUS_ACTIVE && (!$shared || $force)){
                try {
                    $this->twitter->send($content->getTitle() . ' ' . base_url($content->getSlug()));  // TODO: URL proje sonunda kontrol et
                    $this->contentModel->share('publish', $this->content, 'Twitter', 1);
                }catch (\Exception $exception){
                    $this->contentModel->share('publish', $this->content, 'Twitter', 0);
                }
            }
        }
    }

}