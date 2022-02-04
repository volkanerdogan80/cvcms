<?php


namespace App\Database\Seeds\Settings;

use App\Entities\SettingEntity;
use App\Models\SettingModel;
use \CodeIgniter\Database\Seeder;

class SitemapSeeder extends Seeder
{
    public function run()
    {
        $entity = new SettingEntity();
        $model = new SettingModel();

        $default = config('sitemap');

        $data = [];

        foreach (config('system')->modules as $key => $module){
            $data = array_merge($data, [
                $key => [
                    'status' => 0,
                    'priority' => 0,
                    'changefreq' => 'never'
                ],
            ]);
        }

        $entity->setKey('sitemap');
        $entity->setValue($data);
        $model->insert($entity);

    }
}