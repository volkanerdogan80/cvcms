<?php

function get_slider($params)
{
    $model = new \App\Models\SliderModel();
    return cve_cache(cve_cache_name('get_category', $params), function () use ($model, $params){
        return $model->getSlider($params);
    });
}

function cve_slider($slider)
{
    if (is_object($slider)){
        return $slider;
    }elseif(is_numeric($slider) || is_integer($slider)){
        return get_slider(['id' => $slider]);
    }elseif(is_string($slider)){
        return get_slider(['skey' => $slider]);
    }else{
        return null;
    }
}

function cve_slider_id($slider)
{
    if ($data = cve_slider($slider)){
        return $data->id;
    }
    return null;
}

function cve_slider_key($slider)
{
    if ($data = cve_slider($slider)){
        return $data->getKey();
    }
    return null;
}

function cve_slider_data($slider)
{
    if ($data = cve_slider($slider)){
        return $data->getValue();
    }
    return null;
}

function cve_slider_image_id($slider, $item)
{
    if ($data = cve_slider($slider)){
        return $data->getItem($item)->getImage()->getImageId();
    }
    return null;
}

function cve_slider_image_url($slider, $item, $size = null)
{
    if ($data = cve_slider($slider)){
        return $data->getItem($item)->getImage()->getImageUrl($size);
    }
    return null;
}

function cve_slider_texts($slider, $item)
{
    if ($data = cve_slider($slider)){
        return $data->getItem($item)->getTexts();
    }
    return null;
}

function cve_slider_text($slider, $item, $key, $lang = null)
{
    if ($data = cve_slider($slider)){
        return $data->getItem($item)->getText($key, $lang);
    }
    return null;
}

function cve_slider_buttons($slider, $item)
{
    if ($data = cve_slider($slider)){
        return $data->getItem($item)->getButtons();
    }
    return null;
}

function cve_slider_button_title($slider, $item, $key, $lang = null)
{
    if ($data = cve_slider($slider)){
        return $data->getItem($item)->getButton($key)->getButtonTitle($lang);
    }
    return null;
}

function cve_slider_button_url($slider, $item, $key, $lang = null)
{
    if ($data = cve_slider($slider)){
        return $data->getItem($item)->getButton($key)->getButtonUrl($lang);
    }
    return null;
}

function cve_slider_created_at($slider, $humanize = false)
{
    if ($data = cve_slider($slider)){
        return $data->getCreatedAt($humanize);
    }
    return null;
}

function cve_slider_updated_at($slider, $humanize = false)
{
    if ($data = cve_slider($slider)){
        return $data->getUpdatedAt($humanize);
    }
    return null;
}
