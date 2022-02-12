<?php namespace App\Controllers;

use App\Models\FavoriteModel;
use App\Models\LikeModel;
use App\Models\NewsletterModel;

class Home extends BaseController
{
    public function index()
    {

        /*$model = new NewsletterModel();
        $model->insert([
            'name' => 'Volkan Erdoğan',
            'email' => 'volkanerdogan80@gmail.com',
            'token' => random_string('alpha',64)
        ]);

        print_r($model->errors());*/


        /*$entity = new CommentEntity();
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
        print_r(cve_post(1));
    }

}
