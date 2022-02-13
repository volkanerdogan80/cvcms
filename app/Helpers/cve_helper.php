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
    return null;
}

function cve_admin_lang_path($file, $text = null)
{

    if(!is_null($text)){
        return lang('Admin/' . ucfirst($file) . '.text.' . $text);
    }
    return lang('Admin/' . ucfirst($file)  . '.text');
}

function cve_autoshare($content_id)
{

    $model = new \App\Models\ContentModel();

    if (!is_array($content_id)){
        $settings = config('autoshare');

        $facebook_shared_status = $model->share('shared', $content_id, 'Facebook');
        if ($settings->facebook['status'] && !$facebook_shared_status){
            $facebook = new \App\Libraries\Facebook();
            $facebook->config($content_id)->publish();
        }

        $twitter_shared_status = $model->share('shared', $content_id, 'Twitter');
        if ($settings->twitter['status'] && !$twitter_shared_status){
            $twitter = new \App\Libraries\Twitter();
            $twitter->config($content_id)->publish();
        }

        $linkedin_shared_status = $model->share('shared', $content_id, 'Linkedin');
        if ($settings->linkedin['status'] && !$linkedin_shared_status){
            $linkedIn = new \App\Libraries\LinkedIn();
            $linkedIn->config($content_id)->publish();
        }
    }
}

function cve_permit_control($permit): bool
{
    if (session('userData.group') == DEFAULT_ADMIN_GROUP){
        return true;
    }

    if (in_array($permit,session('permissions'))){
        return true;
    }

    return false;
}

function cve_cache($key, $callback)
{
    $cache = config('cache');
    $request = service('request');
    if ($cache->raw){
        if($key == 'generate'){
            $segment = implode('_', $request->uri->getSegments());
            $query = $request->uri->getQuery();
            $query = str_replace('&', '_', $query);
            $query = str_replace('=', '_', $query);
            $key = $query ? $segment . '_' . $query : $segment;
        }

        if($key == 'segment'){
            $key = implode('_', $request->uri->getSegments());
        }

        if (is_array($key)){
            $key = implode('_', $key);
            if ($page = $request->getGet('page')){
                $key .= '_' . $page;
            }
        }

        if(!$result = cache(cve_slug_creator($key))){
            $result = call_user_func($callback);
            cache()->save(cve_slug_creator($key), $result, $cache->raw_time);
        }

        //session()->set('cache_conf', $cache);   //TODO: session oluşturup sonrasında yeniden işlem yapıldığında aynı session açık olduğu sürece timeout oluyor.
        //session()->markAsTempdata('cache_conf', 300);

        return $result;
    }

    return call_user_func($callback);
}

function cve_cache_name($name, $params = null)
{
    if (is_null($params)){
        return md5($name);
    }

    return md5($name . '-' . serialize($params));
}

function cve_single_image_picker(string $src, string $inputName, string $inputID, array $option = [])
{
    $required = isset($option['required']) ? 'required' : '';
    $width = $option['width'] ?? '180px';
    $image = $option['image'] ?? base_url(DEFAULT_IMAGE_SELECT_ICON);
    $value = $option['value'] ?? '';

    return '<input type="hidden" value="'.$value.'" name="'.$inputName.'" id="'.$inputID.'" '.$required.'>
    <a class="btn single-image-picker" href="" 
    style="padding:0px"
    data-src="'.$src.'"
    data-input="'.$inputID.'">
    <img style="width: '.$width.'"
    src="'.$image.'"
    alt=""
    id="'.$src.'">
    </a>';
}

function cve_multi_image_picker(string $title, string $inputName, string $areaID, string $btnClass = 'btn-primary')
{
    return '<button style="border-radius: 5px !important;" class="btn '.$btnClass.' multi-image-picker"
    data-url="'.base_url(route_to("admin_image_multi_modal")).'"
    data-input="'.$inputName.'"
    data-area="'.$areaID.'">'.$title.'</button>';
}

function cve_multi_image_area(string $areaID, string $inputName = null, $images = null)
{
    $image_list = "";
    if(!is_null($images)){
        $image_list = view(PANEL_FOLDER . '/pages/image/gallery-item',[
            'areaID' => $areaID,
            'images' => $images,
            'inputName' => $inputName
        ]);
    }
    return '<div id="'.$areaID.'" class="row gutters-sm">'.$image_list.'</div>';
}

function cve_tree_menu($data, $item)
{
    if (isset($item->children)){
        echo view(PANEL_FOLDER . '/pages/menu/partials/item', [
            'partial' => 'child-start',
            'menu' => $data,
            'item' => $item
        ]);
        foreach ($item->children as $child) {
            cve_tree_menu($data, $child);
        }
        echo view(PANEL_FOLDER . '/pages/menu/partials/item', [
            'partial' => 'child-end',
        ]);
    }else{
        echo view(PANEL_FOLDER . '/pages/menu/partials/item', [
            'partial' => 'item',
            'menu' => $data,
            'item' => $item
        ]);
    }
}

function cve_slug_creator($str, $options = array())
{
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function cve_module_view($module, $path): string
{
    return '\Modules/'. ucfirst($module) . '/Views/' . $path;
}

function cve_module_list()
{
    $module_list = [];
    if (file_exists(ROOTPATH.'modules')) {
        $modulesPath = ROOTPATH.'modules/';
        $modules = scandir($modulesPath);

        foreach ($modules as $module) {
            if ($module === '.' || $module === '..') continue;
            $module_list[] = $module;
        }
        return $module_list;
    }
}

function recurse_copy($src,$dst)
{
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

function delete_directory($dirname): bool
{
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
            else
                delete_directory($dirname.'/'.$file);
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}