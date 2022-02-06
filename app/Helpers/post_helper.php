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
        return $model->where('status', STATUS_ACTIVE)->where($params)->first();
    });
}

/**
 * Returns content info
 * @param null $content | slug, id or object state of content
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_post($content = null)
{
    if (is_null($content)){
        $render = \Config\Services::renderer();
        return $render->getData()['content'];
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

/**
 * Returns Content ID
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_id($content = null)
{
    if (is_null($content)){
        return cve_post()->id;
    }
    return cve_post($content)->id;
}

/**
 * Returns Content Slug
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_slug($content = null)
{
    if (is_null($content)){
        return cve_post()->getSlug();
    }
    return cve_post($content)->getSlug();
}

/**
 * Returns Content Title
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_title($content = null)
{
    if (is_null($content)){
        return cve_post()->getTitle();
    }
    return cve_post($content)->getTitle();
}

/**
 * Returns Content Summary
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_description($content = null)
{
    if (is_null($content)){
        return cve_post()->getDescription();
    }
    return cve_post($content)->getDescription();
}

/**
 * Returns Content content
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_content($content = null)
{
    if (is_null($content)){
        return cve_post()->getContent();
    }
    return cve_post($content)->getContent();
}

/**
 * Returns Content Thumbnail ID
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_thumbnail_id($content = null)
{
    if (is_null($content)){
        return cve_post()->getThumbnail();
    }
    return cve_post($content)->getThumbnail();
}

/**
 * Returns Content Thumbnail link
 * @param null $content | slug, id or object state of content
 * @param null $size | aspect ratio of image | If there is no image in the public/image folder with received size value, it will be created and saved.
 * @return mixed
 */
function cve_post_thumbnail($content = null, $size = null)
{
    if (is_null($content)){
        return cve_post()->withThumbnail()->getUrl($size);
    }
    return cve_post($content)->withThumbnail()->getUrl($size);
}

/**
 * Returns aspect ratio of Gallery Images
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_gallery($content = null)
{
    if (is_null($content)){
        return cve_post()->withGallery();
    }
    return cve_post($content)->withGallery();
}

/**
 * Returns a category information of the content
 * @param int $index | Determines which index among the categories it is in
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function sdc_post_category(int $index = 0, $content = null)
{
    if (is_null($content)){
        return cve_post()->withCategories()[$index];
    }
    return cve_post($content)->withCategories()[$index];
}

/**
 * Returns content Tags(Keywords)
 * @param null $content| slug, id or object state of content
 * @param false $is_array | for array type  set to TRUE
 * @return mixed
 */
function cve_post_keywords($content = null, bool $is_array = false)
{
    if (is_null($content)){
        return cve_post()->getKeywords(null,$is_array);
    }
    return cve_post($content)->getKeywords(null,$is_array);
}

/**
 * Returns content Status
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_status($content = null)
{
    if (is_null($content)){
        return cve_post()->getStatus();
    }
    return cve_post($content)->getStatus();
}

/**
 * Returns Content Views
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_view($content = null)
{
    if (is_null($content)){
        return cve_post()->getViews();
    }
    return cve_post($content)->getViews();
}

/**
 * Returns page template if exist
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_template($content = null)
{
    if (is_null($content)){
        return cve_post()->getPageType();
    }
    return cve_post($content)->getPageType();
}

/**
 * Returns content module
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_module($content = null)
{
    if (is_null($content)){
        return cve_post()->getModule();
    }
    return cve_post($content)->getModule();
}

/**
 * Creates a link for content and returns
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_link($content = null)
{
    return base_url(route_to('content', cve_post_slug($content)));
}

/**
 * Returns author's id of content
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_author_id($content = null)
{
    if (is_null($content)){
        return cve_post()->getUserId();
    }
    return cve_post($content)->getUserId();
}

/**
 * Returns author of content
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_author($key = null, $content = null)
{
    if (is_null($content)){
        $user = cve_post()->withUser();
    }else{
        $user = cve_post($content)->withUser();
    }

    if (!is_null($key)){
        return $user->$key;
    }

    return $user;
}

/**
 * Returns specific extra field values of content
 * @param $key | key for extra field
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_field($key, $content = null)
{
    if (is_null($content)){
        return cve_post()->getField($key);
    }
    return cve_post($content)->getField($key);
}

/**
 * Returns all extra field values of content
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_all_field($content = null)
{
    if (is_null($content)){
        return cve_post()->getAllField();
    }
    return cve_post($content)->getAllField();
}

/**
 * Returns ids of related posts of content
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_similar_id($content = null)
{
    if (is_null($content)){
        return cve_post()->getSimilar();
    }
    return cve_post($content)->getSimilar();
}

/**
 *  Returns related posts of content
 * @param null $content | slug, id or object state of content
 * @return mixed
 */
function cve_post_similar($content = null)
{
    if (is_null($content)){
        return cve_post()->withSimilar();
    }
    return cve_post($content)->withSimilar();
}

/**
 * Returns created time of content
 * @param null $content | slug, id or object state of content
 * @param false $humanize | TRUE => for human readable type, FALSE => for formatted DATETIME
 * @return mixed
 */
function cve_post_created_at($content = null, bool $humanize = false)
{
    if (is_null($content)){
        return cve_post()->getCreatedAt($humanize);
    }
    return cve_post($content)->getCreatedAt($humanize);
}

/**
 * Returns last updated time of content
 * @param null $content | slug, id or object state of content
 * @param false $humanize | TRUE => for human readable type, FALSE => for formatted DATETIME
 * @return mixed
 */
function cve_post_updated_at($content = null, bool $humanize = false)
{
    if (is_null($content)){
        return cve_post()->getUpdatedAt($humanize);
    }
    return cve_post($content)->getUpdatedAt($humanize);
}
