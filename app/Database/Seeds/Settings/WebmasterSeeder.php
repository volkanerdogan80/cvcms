<?php


namespace App\Database\Seeds\Settings;


use App\Entities\SettingEntity;
use App\Models\UserRoleModel;
use App\Models\SettingModel;
use CodeIgniter\Database\Seeder;

class WebmasterSeeder extends Seeder
{
    public function run()
    {
        $entity = new SettingEntity();
        $model = new SettingModel();

        $default = config('webmaster');

        $data = [
            'googleVerify' => $default->googleVerify,
            'googleAnalytics' => $default->googleAnalytics,
            'accountId' => $default->accountId,
            'reCaptchaKey' => $default->reCaptchaKey,
            'yandexVerify' => $default->yandexVerify,
            'yandexMetrika' => $default->yandexMetrika,
            'code' => $default->code,
        ];

        $entity->setKey('webmaster');
        $entity->setValue($data);
        $model->insert($entity);
    }
}