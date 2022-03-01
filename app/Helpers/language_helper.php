<?php

function cve_language($used = false, $status = STATUS_ACTIVE)
{
    $model =  new \App\Models\LanguageModel();
    $locale = service('request')->getLocale();

    if (is_null($status)){
        return $model->findAll();
    }

    if ($used){
        return $model->where('status', $status)->where('code', $locale)->first();
    }
    return $model->where('status', $status)->findAll();
}
function cve_lang_data($data, $lang = null)
{
    if(is_array($data)){
        $data = json_decode($data);
    }

    $locale = !is_null($lang) ? $lang : service('request')->getLocale();

    if(isset($data->$locale)){
        return $data->$locale;
    }
    $defaultLocale = config('app')->defaultLocale;
    return $data->$defaultLocale;
}

function cve_admin_lang($file, $text = null)
{
    if(!is_null($text)){
        return lang('Admin/' . ucfirst($file) . '.text.' . $text);
    }
    return lang('Admin/' . ucfirst($file)  . '.text');
}

function cve_theme_lang($file, $text = null)
{
    if (!is_null($text)){
        return lang( ucfirst(cve_theme_folder()) . '/' . ucfirst($file) . '.text.' . $text);
    }
    return lang(ucfirst(cve_theme_folder()) . '/' . ucfirst($file) . '.text');
}


function cve_module_lang($module, $text = null)
{
    if (!is_null($text)){
        return lang(  'Module/' . ucfirst($module) . '.text.' . $text);
    }
    return lang( 'Module/' . ucfirst($module) . '.text');
}