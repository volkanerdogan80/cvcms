<?php namespace App\Controllers;

use App\Entities\SliderEntity;
use App\Models\SliderModel;

class Home extends BaseController
{

    public function index()
    {

        print_r(cve_slider_button_title('anasayfa-slider', 'yJqx', 'buton'));
        // $model = new ContentModel();
        //$content = $model->find(1);
        //$model = new SliderModel();
        //$entity = new SliderEntity();
        //echo cve_slug_creator('Türkçe Başlık');

        //$slider = $model->find(1);
        //print_r($slider->getItem('item1')->getButton('button2'));
        /*$entity->setKey('Anasayfa Slider');
        $entity->setValue([
            'item1' => [
                'image' => 111,
                'text' => [
                    'text1.1' => [
                        'tr'=> 'Türkçe Slider Yazı 1',
                        'en' => 'English Slider Text 1'
                    ]

                ],
                'button' => [
                    'button1.1' => [
                        'title' => [
                            'tr'=> 'Türkçe Buton Yazı 1.1',
                            'en' => 'English Button Text 1.1'
                        ],
                        'url' => [
                              'tr' => 'http://localhost/tr/admin/dashboard',
                              'en' => 'http://localhost/tr/admin/dashboard',
                        ]
                    ],
                    'button1.2' => [
                        'title' => [
                            'tr'=> 'Türkçe Buton Yazı 1.2',
                            'en' => 'English Button Text 1.2'
                        ],
                        'url' => [
                            'tr' => 'http://localhost/tr/admin/dashboard',
                            'en' => 'http://localhost/tr/admin/dashboard',
                        ]                    ],
                    'button1.3' => [
                        'title' => [
                            'tr'=> 'Türkçe Buton Yazı 1.3',
                            'en' => 'English Button Text 1.3'
                        ],
                        'url' => [
                            'tr' => 'http://localhost/tr/admin/dashboard',
                            'en' => 'http://localhost/tr/admin/dashboard',
                        ]                    ]
                ]
            ],
            'item2' => [
                'image' => 112,
                'text' => [
                    'text2.1' => [
                        'tr'=> 'Türkçe Slider Yazı 2.1.1',
                        'en' => 'English Slider Text 2.1.2'
                    ],
                    'text2.2' => [
                        'tr'=> 'Türkçe Slider Yazı 2.2.1',
                        'en' => 'English Slider Text 2.2.1'
                    ]

                ],
                'button' => [
                    'button2.1' => [
                        'title' => [
                            'tr'=> 'Türkçe Buton Yazı 2.1.1',
                            'en' => 'English Button Text 2.1.1'
                        ],
                        'url' => [
                            'tr' => 'http://localhost/tr/admin/dashboard',
                            'en' => 'http://localhost/tr/admin/dashboard',
                        ]                    ]
                ]
            ]
        ]);

        $model->insert($entity);

          /*  $model->insert([
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
        //print_r(cve_module_list());
    }

}
