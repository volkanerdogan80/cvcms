<?php


namespace App\Entities;

use \CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

class LanguageEntity extends Entity
{
    protected $code;
    protected $flag;
    protected $title;
    protected $status;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setCode(string $code): void
    {
        $this->attributes['code'] = $code;
    }

    public function setFlag(?string $flag = null): void
    {
        if (is_null($flag)){
            $this->attributes['flag'] = $this->attributes['code'];
        }else{
            $this->attributes['flag'] = $flag;
        }
    }

    public function setTitle(array $title): void
    {
        $this->attributes['title'] = json_encode($title, JSON_UNESCAPED_UNICODE);
    }

    public function setStatus(string $status = STATUS_PASSIVE): void
    {
        $this->attributes['status'] = $status;
    }

    public function setDeletedAt(): void
    {
        $this->attributes['deleted_at'] =  date('Y-m-d H:i:s');
    }

    public function getCode(): string
    {
        return $this->attributes['code'];
    }

    public function getFlag(): string
    {
        return base_url(PUBLIC_ADMIN_PATH . 'flag/' . $this->attributes['flag'] . '.svg');
    }

    public function getTitle(string $lang = null): string
    {
        $locale = !is_null($lang) ? $lang : service('request')->getLocale();
        $title = json_decode($this->attributes['title']);
        if (!isset($title->$locale)){
            $locale = config('app')->defaultLocale;
        }
        return $title->$locale;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function getChange()
    {
        $uri = new \CodeIgniter\HTTP\URI(current_url());
        $segments = $uri->getSegments();

        if (in_array($segments[0], config('app')->supportedLocales)){
            $segments[0] = $this->attributes['code'];
        }else{
            array_unshift($segments, $this->attributes['code']);
        }

        $query = $uri->getQuery();
        $new_uri = implode('/', $segments);
        $new_uri = $query ? $new_uri . '?'. $query : $new_uri;
        return base_url($new_uri);
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

}