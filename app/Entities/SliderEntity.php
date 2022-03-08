<?php


namespace App\Entities;

use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Models\ImageModel;
use \CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

class SliderEntity extends Entity
{
    protected $id;
    protected $skey;
    protected $svalue;
    protected $item = null;
    protected $button = null;
    protected $image = null;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function setId(int $id)
    {
        $this->attributes['id'] = $id;
    }
    public function setKey(string $key)
    {
        $this->attributes['skey'] = cve_slug_creator($key);
    }

    public function setValue($value = null)
    {
        $this->attributes['svalue'] = json_encode($value, JSON_UNESCAPED_UNICODE);;
    }

    public function getKey(): string
    {
        return $this->attributes['skey'];
    }

    public function getValue()
    {
        return json_decode($this->attributes['svalue']);
    }

    public function getItem($key)
    {
        $items = $this->getValue();
        if (isset($items->$key)){
            $this->item = $items->$key;
        }
        return $this;
    }

    public function getImage()
    {
        if (!is_null($this->item)){
            $this->image = $this->item->image;
        }
        return $this;
    }

    public function getImageId()
    {
        return $this->image;
    }

    public function  getImageUrl($size = null)
    {
        if (!is_null($this->image)){
            $model = new ImageModel();
            if($image = $model->find($this->image)){
                return base_url($image->getUrl($size));
            }
        }
        return null;
    }

    public function getTexts()
    {
        if (!is_null($this->item)){
            return $this->item->text;
        }
        return null;
    }

    public function getText($key, $lang = null)
    {
        if (!is_null($this->item)){
            $texts = $this->item->text;
            if (isset($texts->$key)){
                $locale = !is_null($lang) ? $lang : service('request')->getLocale();
                $text = $texts->$key;
                if (!isset($text->$locale)){
                    $locale = config('app')->defaultLocale;
                }
                return $text->$locale;
            }
        }
        return null;
    }

    public function getButtons()
    {
        if (!is_null($this->item)){
            return $this->item->button;
        }
        return null;
    }

    public function getButton($key, $lang = null)
    {
        if (!is_null($this->item)){
            $buttons = $this->item->button;
            if (isset($buttons->$key)){
                $this->button = $buttons->$key;
            }
        }
        return $this;
    }

    public function getButtonTitle($lang = null)
    {
        $locale = !is_null($lang) ? $lang : service('request')->getLocale();
        if (!is_null($this->button)){
            if (!isset($this->button->title->$locale)){
                $locale = config('app')->defaultLocale;
            }
            return $this->button->title->$locale;
        }
        return null;
    }

    public function getButtonUrl($lang = null)
    {
        $locale = !is_null($lang) ? $lang : service('request')->getLocale();
        if (!is_null($this->button)){
            if (!isset($this->button->url->$locale)){
                $locale = config('app')->defaultLocale;
            }
            return $this->button->url->$locale;
        }
        return null;
    }

    public function getCreatedAt($humanize = false)
    {
        if($humanize){
            $date = Time::parse($this->attributes['created_at']);
            return $date->humanize();
        }

        return $this->attributes['created_at'];
    }

    public function getUpdatedAt($humanize = false)
    {
        if($humanize){
            $date = Time::parse($this->attributes['updated_at']);
            return $date->humanize();
        }

        return $this->attributes['updated_at'];
    }

    public function getDeletedAt($humanize = false)
    {
        if($humanize){
            $date = Time::parse($this->attributes['deleted_at']);
            return $date->humanize();
        }

        return $this->attributes['deleted_at'];
    }
}