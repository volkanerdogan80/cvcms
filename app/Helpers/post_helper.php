<?php

/**
 * Returns the requested content from the database
 * @param $params | Necessary conditions for where clause
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function get_post($params)
{
    $model = new \App\Models\ContentModel();
    return cve_cache(cve_cache_name('get_post', $params), function () use ($model, $params) {
        return $model->getContent($params);
    });
}

/**
 * Returns content info
 * @param null $content | Slug and id (related to content) or object state of the content
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
    }elseif(is_string($content)){
        return get_post(['slug' => $content]);
    }elseif(is_numeric($content) || is_integer($content)){
        return get_post(['id' => $content]);
    }else{
        return null;
    }
}


function cve_posts(){
    $render = \Config\Services::themeRenderer();
    if (isset($render->getData()['contents'])){
        return $render->getData()['contents'];
    }
    return null;
}

/**
 * Returns Content ID
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns Content Slug
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns Content Title
 * @param null $content | Slug and id (related to content) or object state of the content
 * @param null $lang | Language code
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
 * Returns Content Summary
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns Content content
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns Content Thumbnail ID
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns Content Thumbnail link
 * @param null $content | Slug and id (related to content) or object state of the content
 * @param null $size | aspect ratio of image | If there is no image in the public/image folder with received size value, it will be created and saved.
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
 * Returns aspect ratio of Gallery Images
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return null
 */
function cve_post_format($content = null){
    if ($data = cve_post($content)){
        return $data->getPostFormat();
    }
    return null;
}

/**
 * Returns a category information of the content
 * @param int|null $index | Determines which index among the categories it is in
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return mixed
 */
function cve_post_category($content = null, int $index = null)
{
    if ($data = cve_post($content)){
        if ($categories = $data->withCategories()){
            if (is_null($index)){
                return end($categories);
            }

            if (!isset($categories[$index])){
                return end($categories);
            }

            return $categories[$index];
        }
    }
    return null;
}

/**
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return mixed
 */
function cve_post_categories($content = null)
{
    if ($data = cve_post($content)){
        return $data->withCategories();
    }
    return null;
}

/**
 * Returns content Tags(Keywords)
 * @param null $content| Slug and id (related to content) or object state of the content
 * @param false $is_array | for array type  set to TRUE
 * @return mixed
 */
function cve_post_keywords($content = null, bool $is_array = false)
{
    if ($data = cve_post($content)){
        return $data->getKeywords(null,$is_array);
    }
    return null;
}

/**
 * Generates url for given tag
 * @param $keyword
 * @return string
 */
function cve_tag_link($keyword): string
{
    return sprintf("%s?q=%s", base_url(route_to('search')), $keyword);
}

/**
 * Returns content Status
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns Content Views
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns page template if exist
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns content module
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Creates a link for content and returns
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return string
 */
function cve_post_link($content = null): string
{
    return base_url(route_to('content', cve_post_slug($content)));
}

/**
 * Returns author's id of content
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns author of content
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return mixed
 */
function cve_post_author($content = null, $key = null)
{
    if (is_array($content)){
        $key = $content['key'] ?? null;
        $content = $content['content'] ?? null;
    }

    if ($data = cve_post($content)){
        if (!is_null($key)){
            return $data->withUser()->$key;
        }
        return $data->withUser();
    }
    return null;
}

/**
 * Returns specific extra field values of content
 * @param $key | key for extra field
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns all extra field values of content
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns ids of related posts of content
 * @param null $content | Slug and id (related to content) or object state of the content
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
 *  Returns related posts of content
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return mixed
 */
function cve_post_similar($content = null)
{
    if ($data = cve_post($content)){
        return $data->withSimilar();
    }
    return null;
}

/**
 * Returns comments for content
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_post_comments($content = null)
{
    if (cve_post_id($content)){
        return cve_comments_level($content);
    }
    return null;
}


/**
 * Returns the number of likes of the content.
 * @return int
 */
function cve_post_comment_count(): int
{
    return count(cve_post_comments());
}

/**
 * Returns the number of likes a content has
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return \CodeIgniter\Cache\CacheInterface|false|int|mixed
 */
function cve_post_liked($content = null){
    $model = new \App\Models\LikeModel();
    $content_id = cve_post_id($content);
    if(is_null($content_id)){
        return 0;
    }
    return cve_cache('content_like_' . $content_id, function () use($model, $content_id){
        return $model->getContentLikeCount($content_id);
    });
}

/**
 * Returns how many times a content has been favorited
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return \CodeIgniter\Cache\CacheInterface|false|int|mixed
 */
function cve_post_favorite($content = null){
    $model = new \App\Models\FavoriteModel();
    $content_id = cve_post_id($content);
    if(is_null($content_id)){
        return 0;
    }
    return cve_cache('content_favorite_' . $content_id, function () use($model, $content_id){
        return $model->getContentFavoriteCount($content_id);
    });
}

/**
 * Returns average rating of a content
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return \CodeIgniter\Cache\CacheInterface|false|int|mixed
 */
function cve_post_rating_avg($content = null){
    $model = new \App\Models\RatingModel();
    $content_id = cve_post_id($content);
    if(is_null($content_id)){
        return 3;
    }
    return cve_cache('content_vote_' . $content_id, function () use($model, $content_id){
        return $model->getContentVoteAvg($content_id);
    });
}

/**
 * Returns how many people voted on a content based on points. (Ex: 1 point => 5 people, 2 points => 10 people etc.)
 * @param null $content | Slug and id (related to content) or object state of the content
 * @return \CodeIgniter\Cache\CacheInterface|false|int|mixed
 */
function cve_post_rating_score($content = null){
    $model = new \App\Models\RatingModel();
    $content_id = cve_post_id($content);
    $vote_list = ['5' => 0, '4' => 0, '3' => 0, '2' => 0, '1' => 0];

    if(is_null($content_id)){
        return $vote_list;
    }

    $score_list =  cve_cache('content_score_' . $content_id, function () use($model, $content_id){
        return $model->getContentVoteCount($content_id);
    });

    foreach ($vote_list as $key => $vote) {
        foreach ($score_list as $score){
            if ($key == $score->vote){
                $vote_list[$key] = $score->count;
            }
        }
    }

    return $vote_list;
}

/**
 * Returns next post information
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns previous post information
 * @param null $content | Slug and id (related to content) or object state of the content
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
 * Returns created time of content
 * @param null $content | Slug and id (related to content) or object state of the content
 * @param false $humanize | TRUE => for human readable type, FALSE => for formatted DATETIME
 * @return mixed
 */
function cve_post_created_at($content = null, bool $humanize = false)
{
    if ($data = cve_post($content)){
        return $data->getCreatedAt($humanize);
    }
    return null;
}

/**
 * Returns last updated time of content
 * @param null $content | Slug and id (related to content) or object state of the content
 * @param false $humanize | TRUE => for human readable type, FALSE => for formatted DATETIME
 * @return mixed
 */
function cve_post_updated_at($content = null, bool $humanize = false)
{
    if ($data = cve_post($content)){
        return $data->getUpdatedAt($humanize);
    }
    return null;
}
