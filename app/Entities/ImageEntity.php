<?php


namespace App\Entities;

use \CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

class ImageEntity extends Entity
{
    protected $id;
    protected $name;
    protected $group;
    protected $group_name;
    protected $url;
    protected $type;
    protected $size;

    protected $dates = ['created_at', 'updated_at'];

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setGroup($group = null)
    {
        $this->attributes['group'] = $group;
    }

    public function setGroupName($group_name = null)
    {
        $this->attributes['group_name'] = $group_name;
    }

    public function setSlug(string $name): void
    {
        $slug = explode('.', $name);
        $this->attributes['slug'] = $slug[0];
    }

    public function setUrl(string $param): void
    {
        $this->attributes['url'] = UPLOAD_FOLDER_PATH . '/' . $param;
    }

    public function setType(string $type): void
    {
        $this->attributes['type'] = $type;
    }

    public function setSize(int $size): void
    {
        $this->attributes['size'] = $size;
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getGroup(): string
    {
        return $this->attributes['group'];
    }

    public function getGroupName(): string
    {
        return $this->attributes['group_name'];
    }

    public function getSlug(): string
    {
        return $this->attributes['slug'];
    }

    public function getUrl($size = null)
    {
        if (!is_null($size)){
            $image = UPLOAD_FOLDER_PATH . $this->attributes['slug'] . '-' . $size . '.' . $this->attributes['type'];
            if(!file_exists(ROOTPATH . $image)){
                if ($this->manipulation($size)){
                    return base_url($image);
                }
                return base_url($this->attributes['url']);
            }
            return base_url($image);
        }
        return base_url($this->attributes['url']);
    }

    private function manipulation($size)
    {
        try {
            $manipulation = \Config\Services::image();
            $manipulation->withFile(ROOTPATH. $this->attributes['url']);
            $sizeExp = explode('x', $size);
            $width = $sizeExp[0];
            $height = $sizeExp[1];
            $path = ROOTPATH . UPLOAD_FOLDER_PATH . $this->attributes['slug'] . '-' . $size . '.' . $this->attributes['type'];
            $manipulation->fit($width, $height, 'center');
            $manipulation->save($path);
            return true;
        }catch (\Exception $exception){
            return false;
        }
    }

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function getSize(): int
    {
        return $this->attributes['size'];
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

}