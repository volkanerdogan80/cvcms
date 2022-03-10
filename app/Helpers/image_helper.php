<?php

function get_images($params = null)
{
    $model = new \App\Models\ImageModel();
    return cve_cache(cve_cache_name('get_images', $params), function () use($model, $params) {
        return $model->getImages($params);
    });
}

function get_image($params)
{
    $model = new \App\Models\ImageModel();
    return cve_cache(cve_cache_name('get_image', $params), function () use($model, $params) {
        return $model->getImage($params);
    });
}

function cve_images($params = null)
{
    return get_images($params);
}

function cve_image($image = null){
    if (is_object($image)){
        return $image;
    }elseif(is_numeric($image) || is_integer($image)){
        return get_image(['id' => $image]);
    }elseif(is_string($image)){
        return get_image(['slug' => $image]);
    }else{
        return null;
    }
}

function cve_image_id($image = null)
{
    if($image = cve_image($image)){
        return $image->id;
    }
    return null;
}

function cve_image_group($image = null)
{
    if($image = cve_image($image)){
        return $image->getGroup();
    }
    return null;
}

function cve_image_group_name($image = null)
{
    if($image = cve_image($image)){
        return $image->getGroupName();
    }
    return null;
}

function cve_image_name($image = null)
{
    if($image = cve_image($image)){
        return $image->getName();
    }
    return null;
}

function cve_image_slug($image = null)
{
    if($image = cve_image($image)){
        return $image->getSlug();
    }
    return null;
}

function cve_image_url($image = null, $size = null)
{
    if($image = cve_image($image)){
        return $image->getUrl($size);
    }
    return null;
}

function cve_image_type($image = null)
{
    if($image = cve_image($image)){
        return $image->getType();
    }
    return null;
}

function cve_image_size($image = null)
{
    if($image = cve_image($image)){
        return $image->getSize();
    }
    return null;
}

function cve_image_created_at($image = null, $humanize = false)
{
    if ($image = cve_image($image)){
        return $image->getCreatedAt($humanize);
    }
    return null;
}

function cve_image_updated_at($image = null, $humanize = false)
{
    if ($image = cve_image($image)){
        return $image->getUpdatedAt($humanize);
    }
    return null;
}
