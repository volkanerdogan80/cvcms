<?php

/**
 * Veritabanından istenilen içeriği getirir
 * @param $params | Where metotu için gerekli olan koşullar
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function get_post($params)
{
    $params = array_merge($params, ['status' => STATUS_ACTIVE]);
    $model = new \App\Models\ContentModel();
    return cve_cache(cve_cache_name('get_post', $params), function () use ($model, $params) {
        return $model->getContent($params);
    });
}

/**
 * Belirtilen şartlarda birden fazla içerik geri döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function get_posts($params)
{
    $params = array_merge($params, ['status' => STATUS_ACTIVE]);
    $model = new \App\Models\ContentModel();
    return cve_cache(cve_cache_name('get_posts', $params), function () use ($model, $params) {
        return $model->getContents($params);
    });
}

/**
 * İçerik ile ilgili bilgileri döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_post($content = null)
{
    if (is_null($content)){
        $render = \Config\Services::themeRenderer();
        if (isset($render->getData()['content'])){
            return $render->getData()['content'];
        }
    }

    if (is_object($content)){
        return $content;
    }elseif(is_numeric($content) || is_integer($content)){
        return get_post(['id' => $content]);
    }elseif(is_string($content)){
        return get_post(['slug' => $content]);
    }else{
        return null;
    }
}

/**
 * Kullanıcılar tarafından kullanılacak olan birden fazla içerik dönen metot
 * @param null $params
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_posts($params = null){

    if (!is_null($params)){
        return get_posts($params);
    }

    $render = \Config\Services::themeRenderer();
    if (isset($render->getData()['contents'])){
        return $render->getData()['contents'];
    }
    return null;
}

/**
 * İçeriğe ait ID döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_id($content = null)
{
    if ($data = cve_post($content)){
        return $data->id;
    }
    return null;
}

/**
 * İçeriğe ait Slug döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_slug($content = null)
{
    if ($data = cve_post($content)){
        return $data->getSlug();
    }
    return null;
}

/**
 * İçeriğe ait Başlık döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_title($content = null, $lang = null)
{
    if ($data = cve_post($content)){
        return $data->getTitle($lang);
    }
    return null;
}

/**
 * İçeriğe ait Özet döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_description($content = null)
{
    if ($data = cve_post($content)){
        return $data->getDescription();
    }
    return null;
}

/**
 * İçeriğe ait İçerik alanını döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_content($content = null)
{
    if ($data = cve_post($content)){
        return $data->getContent();
    }
    return null;
}

/**
 * İçeriğe ait öne çıkartılmış göresin ID değerini döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_thumbnail_id($content = null)
{
    if ($data = cve_post($content)){
        return $data->getThumbnail();
    }
    return null;
}

/**
 * İçeriğe ait öne çıkartılmış görselinin linkini döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @param null $size | resim'e ait en-boy oranları
 * @return mixed
 */
function cve_post_thumbnail($content = null, $size = null)
{
    if (is_array($content)){
        $size = $content['size'] ?? null;
        $content = $content['content'] ?? null;
    }

    if ($data = cve_post($content)){
        if($thumbnail = $data->withThumbnail()){
            return $thumbnail->getUrl($size);
        }
    }
    return null;
}

/**
 * İçeriğe ait etiketleri döner
 * @param null $content| İçerik ile ilgili slug, id veya içeriğin object hali
 * @param false $is_array | etiketleri array olarak isteniliyorsa true ayarlanmalıdır
 * @return mixed
 */
function cve_post_keywords($content = null, $is_array = false)
{
    if ($data = cve_post($content)){
        return $data->getKeywords(null,$is_array);
    }
    return null;
}

function cve_keyword_link($keyword)
{
    return sprintf("%s?q=%s", base_url(route_to('search')), $keyword);
}

/**
 * İçeriğin durumunu döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_status($content = null)
{
    if ($data = cve_post($content)){
        return $data->getStatus();
    }
    return null;
}

/**
 * İçeriğin görüntülenme sayısını döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_view($content = null)
{
    if ($data = cve_post($content)){
        return $data->getViews();
    }
    return null;
}

/**
 * İçeriğin sayfa şablonu var ise döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_template($content = null)
{
    if ($data = cve_post($content)){
        return $data->getPageType();
    }
    return null;
}

/**
 * İçeriğe ait modül değerini döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_module($content = null)
{
    if ($data = cve_post($content)){
        return $data->getModule();
    }
    return null;
}

/**
 * İçeriğe link oluşturur ve geri döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_link($content = null)
{
    return base_url(route_to('content', cve_post_slug($content)));
}

/**
 * İçeriği oluşturan kullanıcının ID değerini döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_author_id($content = null)
{
    if ($data = cve_post($content)){
        return $data->getUserId();
    }
    return null;
}

/**
 * İçeriği oluşturan kullanıcının bilgilerini döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_author($content = null, $key = null)
{
    if (is_array($content)){
        $key = $content['key'] ?? null;
        $content = $content['content'] ?? null;
    }

    if ($data = cve_post($content)){
        $user = $data->withUser();
        if (!is_null($key) && !is_null($user)){
            return $user->$key;
        }
        return $user;
    }
    return null;
}

/**
 * İçeriğe ait özel alan bilgisini döner
 * @param $key | hangi özel alan kullanılmak isteniyorsa o alanın anahtar değeri
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_field($key, $content = null)
{
    if ($data = cve_post($content)){
        return $data->getField($key);
    }
    return null;
}

/**
 * İçeriğe ait tüm özel alanları döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_all_field($content = null)
{
    if ($data = cve_post($content)){
        return $data->getAllField();
    }
    return null;
}

/**
 * İçeriğe ait benzer yazıların ID değerlerini döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_similar_id($content = null)
{
    if ($data = cve_post($content)){
        return $data->getSimilar();
    }
    return null;
}

/**
 * İçeriğe ait benzer yazıları döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_similar($content = null, $limit = 3, $type = false)
{
    if ($data = cve_post($content)){
        if ($similar_id = cve_post_similar_id($data)){
            $model = new \App\Models\ContentModel();
            return cve_cache('cve_post_similar_' . cve_post_id($data), function () use($model, $similar_id, $limit) {
                return $model->getContentsByIds($similar_id, $limit)['contents'];
            });
        }

        if ($type && $type == 'category'){
            $category_id = cve_cat_id($data, true);
            $model = new \App\Models\ContentModel();
            return cve_cache('cve_post_similar_' . cve_post_id($data), function () use($model, $category_id, $limit) {
                return $model->getContentsByCategoryId($category_id, $limit)['contents'];
            });
        }

        if ($type && $type == 'random'){
            $category_id = cve_cat_id($data, true);
            return cve_random_post(['category' => $category_id, 'limit' => $limit]);
        }
    }
    return null;
}

/**
 * İçeriğe ait gallery resimlerini döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_gallery($content = null)
{
    if ($data = cve_post($content)){
        return $data->withGallery();
    }
    return null;
}

/**
 * İçerik yorum durumunu geri döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return bool
 *
 */
function cve_post_comment_status($content = null){
    if ($data = cve_post($content)){
        return $data->getCommentStatus();
    }
    return null;
}


/**
 * İçerik post format değerini getirir
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return null
 */
function cve_post_format($content = null){
    if ($data = cve_post($content)){
        return $data->getPostFormat();
    }
    return null;
}

/**
 * İçeriğe ait 1 adet kategori bilgisini döner
 * @param int $index | kategoriler arasından kaçın index'deki olduğunu belirler
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_category($content = null)
{
    if ($data = cve_post($content)){

        $model = new \App\Models\CategoryModel();
        $content_id = cve_post_id($content);

        return cve_cache('post_category_' . $content_id, function () use($model, $content_id){
            return $model->getCategoryByContentId($content_id);
        });
    }
    return null;
}

/**
 * İçerik kategorilerini getirir
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_categories($content = null)
{
    if ($data = cve_post($content)){

        $model = new \App\Models\CategoryModel();
        $content_id = cve_post_id($content);

        return cve_cache('post_categories_' . $content_id, function () use($model, $content_id){
            return $model->getCategoriesByContentId($content_id);
        });
    }
    return null;
}

/**
 * İçeriğe ait yorumları getirir
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_post_comments($content = null)
{
    if ($data = cve_post_id($content)){
        return cve_comments_level($content);
    }
    return null;
}

/**
 * İçerikte kaç adet beğeni varsa onu döner
 * @return int
 */
function cve_post_comment_count($content = null)
{
    if ($content_id = cve_post_id($content)){
        $model = new \App\Models\CommentModel();
        return cve_cache('cve_post_comment_count_' . $content_id, function () use ($model, $content_id){
            return $model->getCommentsCountByContentId($content_id);
        });
    }
    return null;
}

/**
 * Bir içeriğin kaç adet beğeni aldığını getirir
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return \CodeIgniter\Cache\CacheInterface|false|int|mixed
 */
function cve_post_liked($content = null)
{
    if ($content_id = cve_post_id($content)){
        $model = new \App\Models\LikeModel();
        return cve_cache('content_like_count_' . $content_id, function () use($model, $content_id){
            return $model->getLikeCountByContentId($content_id);
        });
    }
    return 0;
}

/**
 * Bir içeriğin kaç adet favoriye aldındığını getirir
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return \CodeIgniter\Cache\CacheInterface|false|int|mixed
 */
function cve_post_favorite($content = null)
{
    if ($content_id = cve_post_id($content)){
        $model = new \App\Models\FavoriteModel();
        return cve_cache('content_favorite_count_' . $content_id, function () use($model, $content_id){
            return $model->getFavoriteCountByContentId($content_id);
        });
    }
    return 0;
}

/**
 * Bir içeriğer verilen toplam puanı getirir.
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return \CodeIgniter\Cache\CacheInterface|false|int|mixed
 */
function cve_post_rating_avg($content = null)
{
    if ($content_id = cve_post_id($content)){
        $model = new \App\Models\RatingModel();
        return cve_cache('content_vote_' . $content_id, function () use($model, $content_id){
            return $model->getRatingAvgByContentId($content_id);
        });
    }
    return 3;
}

/**
 * Bir içeriğin hangi derecede kaç puan aldığını getirir
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return \CodeIgniter\Cache\CacheInterface|false|int|mixed
 */
function cve_post_rating_score($content = null){
    $vote_list = ['5' => 0, '4' => 0, '3' => 0, '2' => 0, '1' => 0];
    if ($content_id = cve_post_id($content)){
        $model = new \App\Models\RatingModel();
        $score_list =  cve_cache('content_score_' . $content_id, function () use($model, $content_id){
            return $model->getRatingCountByContentID($content_id);
        });
        foreach ($vote_list as $key => $vote) {
            foreach ($score_list as $score){
                if ($key == $score->vote){
                    $vote_list[$key] = $score->count;
                }
            }
        }
    }
    return $vote_list;
}

/**
 * Bir sonraki yazı bilgilerini getirir
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_post_next($content = null)
{
    $model = new \App\Models\ContentModel();
    $content_id = cve_post_id($content);

    return cve_cache('next_post_' . $content_id, function () use($model, $content_id){
        return $model->getNextContent($content_id);
    });
}

/**
 * Bir önceki yazı bilgilerini getirir
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function cve_post_prev($content = null)
{
    $model = new \App\Models\ContentModel();
    $content_id = cve_post_id($content);

    return cve_cache('prev_post_' . $content_id, function () use($model, $content_id){
        return $model->getPrevContent($content_id);
    });
}

/**
 * İçeriğin oluşturulma tarihini döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_created_at($content = null, $humanize = false)
{
    if ($data = cve_post($content)){
        return $data->getCreatedAt($humanize);
    }
    return null;
}

/**
 * İçeriğin güncellenme tarihini döner
 * @param null $content | İçerik ile ilgili slug, id veya içeriğin object hali
 * @return mixed
 */
function cve_post_updated_at($content = null, $humanize = false)
{
    if ($data = cve_post($content)){
        return $data->getUpdatedAt($humanize);
    }
    return null;
}

function cve_post_pager($contents = null, $group = 'default', $template = 'cms_pager')
{
    if (!is_null($contents)){
        if (isset($contents['pager'])){
            $pager = $contents['pager'];
            return $pager->links($group, $template);
        }
    }

    $render = \Config\Services::themeRenderer();
    if (isset($render->getData()['pager'])){
        $pager = $render->getData()['pager'];
        return $pager->links($group, $template);
    }
    return null;
}