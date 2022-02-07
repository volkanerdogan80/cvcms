<?php namespace App\Controllers;



use App\Entities\CommentEntity;
use App\Models\CommentModel;

class Home extends BaseController
{
    public function index()
    {
        /*$model = new CommentModel();
        $entity = new CommentEntity();

        $entity->setContentId(1);
        $entity->setCommentId(5);
        $entity->setName('Sakine Gürler');
        $entity->setEmail('sakine@hotmail.com');
        $entity->setComment('Yorum 1.1.1.1');
        $entity->setStatus(STATUS_ACTIVE);

        $model->insert($entity);*/

        //$theme = $model->find(1);
        //print_r($theme->getWeb());
        //print_r(config('theme')->area1);

        //cve_lang_data('CVE Blog Başlık', service('request')->getLocale());
        //echo service('request')->getLocale();
        print_r(cve_link());

    }
}
