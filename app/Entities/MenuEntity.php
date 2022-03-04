<?php


namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\CategoryModel;
use App\Models\ContentModel;
use CodeIgniter\I18n\Time;

class MenuEntity extends Entity
{
    protected $id;
    protected $skey;
    protected $svalue;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }
    public function setKey(string $key): void
    {
        $this->attributes['skey'] = cve_slug_creator($key);
    }

    public function setValue(?string $value = null): void
    {
        $this->attributes['svalue'] = $value;
    }

    public function getKey(): string
    {
        return $this->attributes['skey'];
    }

    public function getItem($item)
    {
        if ($item->module == 'content'){
            $model = new ContentModel();
            if ($result = $model->withDeleted()->find($item->id)){
                return $result;
            }
        }elseif ($item->module == 'category'){
            $model = new CategoryModel();
            if ($result = $model->withDeleted()->find($item->id)){
                return $result;
            }
        }elseif($item->module == 'custom'){
            return $this;
        }
        return $this;
    }

    public function getTitle($item = null, $lang = null)
    {
        $locale = !is_null($lang) ? $lang : service('request')->getLocale();
        $key = $locale . 'title';
        if (!isset($item->$key)){
            $locale = config('app')->defaultLocale;
            $key = $locale . 'title';
        }

        if (isset($item->$key)){
            return $item->$key;
        }
        return cve_admin_lang('Errors', 'data_not_found');
    }

    public function getValue()
    {
        return json_decode($this->attributes['svalue']);
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