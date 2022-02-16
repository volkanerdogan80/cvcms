<?php


namespace App\Entities;

use \CodeIgniter\Entity;

class SettingEntity extends Entity
{
    protected $skey;
    protected $svalue;

    protected $dates = ['created_at', 'updated_at'];

    public function setKey(string $key): void
    {
        $this->attributes['skey'] = $key;
    }

    public function setValue(array $value, $array = false): void
    {
        $this->attributes['svalue'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getKey(): string
    {
        return $this->attributes['skey'];
    }

    public function getValue($key = null, $isArray = false)
    {
        if (!is_null($key)){
            if ($isArray){
                $setting =  json_decode($this->attributes['svalue'], true);
                return $setting[$key] ?? null;
            }

            $setting =  json_decode($this->attributes['svalue']);
            return $setting->$key ?? null;
        }

        if ($isArray){
            return json_decode($this->attributes['svalue'], true);
        }

        return json_decode($this->attributes['svalue']);
    }


}