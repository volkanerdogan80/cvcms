<?php


namespace App\Database\Seeds\Settings;

use App\Entities\SettingEntity;
use App\Models\SettingModel;
use CodeIgniter\Database\Seeder;

class SocialSeeder extends Seeder
{
    public function run()
    {
        $entity = new SettingEntity();
        $model = new SettingModel();

        $data = [];

        foreach (config('social') as $key => $value){
            $data[$key] = $value;
        }

        $entity->setKey('social');
        $entity->setValue($data);
        $model->insert($entity);
    }
}