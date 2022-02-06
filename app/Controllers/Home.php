<?php namespace App\Controllers;



use App\Entities\ThemeEntity;
use App\Models\ThemeModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new ThemeModel();
        $entity = new ThemeEntity();

        /*$entity->setFolder('test entity');
        $entity->setName('Test Theme');
        $entity->setAuthor('TVErdoğan');
        $entity->setWeb('https://cvmuhendislik.com');
        $entity->setEmail('terdogan80@hotmail.com');
        $entity->setStatus(STATUS_PASSIVE);
        $entity->setSetting(['OK', 'GOT IT']);
        $model->insert($entity);*/

        //$theme = $model->find(1);
        //print_r($theme->getWeb());
        //print_r(config('theme')->area1);

        //cve_lang_data('CVE Blog Başlık', service('request')->getLocale());
        //echo service('request')->getLocale();
        print_r(cve_user_created_at('volkanerdogan80@gmail.com', true));

    }
}
