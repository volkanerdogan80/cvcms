<?php


namespace App\Entities;

use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\ContentModel;
use App\Models\ImageModel;
use App\Models\UserModel;
use \CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

class ContentEntity extends Entity
{
    protected $id;
    protected $module;
    protected $user_id;
    protected $slug;
    protected $title;
    protected $description;
    protected $content;
    protected $keywords;
    protected $thumbnail;
    protected $gallery;
    protected $views;
    protected $comment_status;
    protected $field;
    protected $page_type;
    protected $post_format;
    protected $similar;
    protected $status;

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setModule(string $module): void
    {
        $this->attributes['module'] = $module;
    }

    public function setUserId(int $userId = null): void
    {
        if (is_null($userId)){
            $this->attributes['user_id'] =  session('userData.id');
        }else{
            $this->attributes['user_id'] =  $userId;
        }
    }

    public function setSlug(array $title = null): void
    {
        $defaultLang = config('app')->defaultLocale;
        if(!is_null($title)){
            if(is_array($title)){
                $slug = cve_slug_creator($title[$defaultLang]);
            }else{
                $slug = cve_slug_creator($title);
            }
        }else{
            $slug = cve_slug_creator(json_decode($this->attributes['title'])->$defaultLang);
        }
        $this->attributes['slug'] = $slug;
    }

    public function setTitle(array $title): void
    {
        $this->attributes['title'] = json_encode($title, JSON_UNESCAPED_UNICODE);
    }

    public function setDescription(array $description): void
    {
        $this->attributes['description'] = json_encode($description, JSON_UNESCAPED_UNICODE);
    }

    public function setContent(array $content): void
    {
        $this->attributes['content'] = json_encode($content, JSON_UNESCAPED_UNICODE);
    }

    public function setKeywords(array $keywords): void
    {
        $this->attributes['keywords'] = json_encode($keywords, JSON_UNESCAPED_UNICODE);
    }

    public function setThumbnail($imageId = null): void
    {
        $this->attributes['thumbnail'] = $imageId;
    }

    public function setGallery($gallery = null)
    {
        if (is_null($gallery)){
            $this->attributes['gallery'] = $gallery;
        }else{
            $this->attributes['gallery'] = json_encode($gallery, JSON_UNESCAPED_UNICODE);
        }
    }

    public function setViews(int $view = 0): void
    {
        $this->attributes['views'] = $view;
    }

    public function setField($field = null): void
    {
        if (is_null($field)){
            $this->attributes['field'] = $field;
        }else{
            $this->attributes['field'] = json_encode($field, JSON_UNESCAPED_UNICODE);
        }
    }

    public function setPageType($type = null): void
    {
        $this->attributes['page_type'] = $type;
    }

    public function setPostFormat($format = null): void
    {
        $format = is_null($format) ? 'standard' : $format;
        $this->attributes['post_format'] = $format;
    }

    public function setSimilar($similar = null): void
    {
        if (is_null($similar)){
            $this->attributes['similar'] = $similar;
        }else{
            $this->attributes['similar'] = json_encode($similar, JSON_UNESCAPED_UNICODE);
        }
    }

    public function setCommentStatus($comment_status = null)
    {
        $comment_status = is_null($comment_status) ? STATUS_PASSIVE : $comment_status;
        $this->attributes['comment_status'] = $comment_status;
    }

    public function setStatus($status = null)
    {
        $status = is_null($status) ? STATUS_PENDING : $status;
        $this->attributes['status'] = $status;
    }

    public function getModule(): string
    {
        return $this->attributes['module'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getSlug(): string
    {
        return $this->attributes['slug'];
    }

    public function getTitle(?string $lang = null): string
    {
        $locale = !is_null($lang) ? $lang : service('request')->getLocale();
        $title = json_decode($this->attributes['title']);
        if (!isset($title->$locale)){
            $locale = config('app')->defaultLocale;
        }
        return $title->$locale;
    }

    public function getDescription(?string $lang = null): string
    {
        $locale = !is_null($lang) ? $lang : service('request')->getLocale();
        $description = json_decode($this->attributes['description']);
        if (!isset($description->$locale)){
            $locale = config('app')->defaultLocale;
        }
        return $description->$locale;
    }

    public function getContent(?string $lang = null): string
    {
        $locale = !is_null($lang) ? $lang : service('request')->getLocale();
        $content = json_decode($this->attributes['content']);
        if (!isset($content->$locale)){
            $locale = config('app')->defaultLocale;
        }
        return $content->$locale;
    }

    public function getKeywords(?string $lang = null, bool $is_array = false)
    {
        $locale = !is_null($lang) ? $lang : service('request')->getLocale();
        $keywords = json_decode($this->attributes['keywords']);
        if (!isset($keywords->$locale)){
            $locale = config('app')->defaultLocale;
        }

        if($is_array){
            return explode(',', $keywords->$locale);
        }
        return $keywords->$locale;
    }

    public function getThumbnail()
    {
        return $this->attributes['thumbnail'];
    }

    public function getGallery()
    {
        return json_decode($this->attributes['gallery']);
    }

    public function getViews(): int
    {
        return $this->attributes['views'];
    }

    public function getField(string $key, ?string $lang = null): ?string
    {
        $locale = !is_null($lang) ? $lang : service('request')->getLocale();

        if (!is_null($this->attributes['field'])){
            $field = json_decode($this->attributes['field']);

            if(isset($field->$key)){
                if (is_object($field->$key)){
                    return $field->$key->$locale ?? null;
                }
                return $field->$key;
            }
        }

        return null;
    }

    public function getAllField()
    {
        if ($this->attributes['field']){
            return json_decode($this->attributes['field']);
        }
        return [];

    }

    public function getPageType()
    {
        return $this->attributes['page_type'];
    }

    public function getPostFormat()
    {
        return $this->attributes['post_format'];
    }

    public function getSimilar()
    {
        if ($this->attributes['similar']){
            return json_decode($this->attributes['similar'], true);
        }
        return [];
    }

    public function getStatus()
    {
        return $this->attributes['status'];
    }

    public function getCommentStatus()
    {
        return $this->attributes['comment_status'];
    }

    public function getCategories(): array
    {
        $model = new ContentModel();
        $categories = [];
        foreach ($model->category('get', $this->attributes['id']) as $cat){
            array_push($categories, $cat->category_id);
        }
        return $categories;
    }

    public function getCreatedAt($humanize = false): ?string
    {
        if($humanize){
            $date = Time::parse($this->attributes['created_at']);
            return $date->humanize();
        }

        return $this->attributes['created_at'];
    }

    public function getUpdatedAt($humanize = false): ?string
    {
        if($humanize){
            $date = Time::parse($this->attributes['updated_at']);
            return $date->humanize();
        }

        return $this->attributes['updated_at'];
    }

    public function getDeletedAt($humanize = false): ?string
    {
        if($humanize){
            $date = Time::parse($this->attributes['deleted_at']);
            return $date->humanize();
        }

        return $this->attributes['deleted_at'];
    }

    public function withSimilar()
    {
        if (!is_null($this->attributes['similar'])){
            $model = new ContentModel();
            $similarID = json_decode($this->attributes['similar'], true);
            return $model->find($similarID);
        }
        return null;
    }

    public function withUser(): ?object
    {
        if ($this->attributes['user_id']){
            $model = new UserModel();
            if($user = $model->withDeleted()->find($this->attributes['user_id'])){
                return $user;
            }
        }
        return null;
    }

    public function withThumbnail()
    {
        if($this->attributes['thumbnail']){
            $model = new ImageModel();
            if($thumbnail = $model->find($this->attributes['thumbnail'])){
                return $thumbnail;
            }
        }
        return null;
    }

    public function withGallery()
    {
        if(is_null($this->attributes['gallery'])){
            return [];
        }
        $model = new ImageModel();
        $galleryList = json_decode($this->attributes['gallery'], true);
        return $model->find($galleryList);
    }

    public function withCategories()
    {
        $model = new CategoryModel();
        return $model->getCategoriesByContentId($this->attributes['id'], STATUS_ACTIVE, true);
    }

    public function withShare()
    {
        $model = new ContentModel();
        $result = $model->share('get', $this->attributes['id']);
        if($result){
            return $result;
        }
        return [];
    }

    public function withCount($social = 'all')
    {
        $model = new ContentModel();
        $result = $model->counter($social, $this->attributes['id']);
        if($result){
            return $result;
        }
        return [];
    }

    public function withComment()
    {
        $model = new CommentModel();
        return $model->withDeleted()
            ->where('content_id', $this->attributes['id'])
            ->orderBy('created_at', 'DESC')
            ->findAll(10);
    }
}