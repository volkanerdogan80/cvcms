<?php

function admin_form_open()
{

}

function admin_form_close()
{

}

function admin_input($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $input='';
        foreach ($options as $key => $value){
            $input .= admin_input($value);
        }
        return $input;
    }

    $options = !is_array($options) ? [] : $options;
    $options = admin_default_data($options);

    return view('components/form/elements/input', [
        'options' => $options
    ]);
}

function admin_select($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $select='';
        foreach ($options as $key => $value){
            $select .= admin_select($value);
        }
        return $select;
    }

    $options = !is_array($options) ? [] : $options;
    $options = admin_default_data($options);

    return view('components/form/elements/select', [
        'options' => $options
    ]);
}

function admin_textarea($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $textarea = '';
        foreach ($options as $key => $value){
            $textarea .= admin_textarea($value);
        }
        return $textarea;
    }

    $options = !is_array($options) ? [] : $options;
    $options = admin_default_data($options);

    return view('components/form/elements/textarea', [
        'options' => $options
    ]);
}

function admin_radio($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $radio='';
        foreach ($options as $key => $value){
            $radio .= admin_radio($value);
        }
        return $radio;
    }

    $options = !is_array($options) ? [] : $options;
    $options = admin_default_data($options);

    return view('components/form/elements/radio', [
        'options' => $options
    ]);
}

function admin_color($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $color = '';
        foreach ($options as $key => $value){
            $color .= admin_color($value);
        }
        return $color;
    }

    $options = !is_array($options) ? [] : $options;
    $options['color'] = true;
    $options = admin_default_data($options);

    return view('components/form/elements/input', [
        'options' => $options
    ]);
}

function admin_tags($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $color = '';
        foreach ($options as $key => $value){
            $color .= admin_color($value);
        }
        return $color;
    }

    $options = !is_array($options) ? [] : $options;
    $options['tags'] = true;
    $options = admin_default_data($options);

    return view('components/form/elements/input', [
        'options' => $options
    ]);
}

function admin_date($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $date = '';
        foreach ($options as $key => $value){
            $date .= admin_date($value);
        }
        return $date;
    }

    $options = !is_array($options) ? [] : $options;
    $options['date'] = true;
    $options = admin_default_data($options);

    return view('components/form/elements/input', [
        'options' => $options
    ]);
}

function admin_datetime($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $datetime = '';
        foreach ($options as $key => $value){
            $datetime .= admin_datetime($value);
        }
        return $datetime;
    }

    $options = !is_array($options) ? [] : $options;
    $options['datetime'] = true;
    $options = admin_default_data($options);

    return view('components/form/elements/input', [
        'options' => $options
    ]);
}

function admin_daterange($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $daterange = '';
        foreach ($options as $key => $value){
            $daterange .= admin_daterange($value);
        }
        return $daterange;
    }

    $options = !is_array($options) ? [] : $options;
    $options['daterange'] = true;
    $options = admin_default_data($options);

    return view('components/form/elements/input', [
        'options' => $options
    ]);
}

function admin_switch($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $switch = '';
        foreach ($options as $key => $value){
            $switch .= admin_switch($value);
        }
        return $switch;
    }

    $options = !is_array($options) ? [] : $options;
    $options = admin_default_data($options);

    return view('components/form/elements/switch', [
        'options' => $options
    ]);
}

function admin_checkbox($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $checkbox = '';
        foreach ($options as $key => $value){
            $checkbox .= admin_checkbox($value);
        }
        return $checkbox;
    }

    $options = !is_array($options) ? [] : $options;
    $options = admin_default_data($options);

    return view('components/form/elements/checkbox', [
        'options' => $options
    ]);
}

function admin_form_group_row($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $result = '';
        foreach ($options as $key => $value){
            $result .= admin_form_group_row($value);
        }
        return $result;
    }

    $html = '';
    $label = admin_default_label_data($options);
    if (array_key_exists('input', $options)){
        $html = admin_input($options['input']);
    }

    if (array_key_exists('select', $options)){
        $html = admin_select($options['select']);
    }

    if (array_key_exists('textarea', $options)){
        $html = admin_textarea($options['textarea']);
    }

    if (array_key_exists('radio', $options)){
        $html = admin_radio($options['radio']);
    }

    if (array_key_exists('color', $options)){
        $html = admin_color($options['color']);
    }

    if (array_key_exists('tags', $options)){
        $html = admin_tags($options['tags']);
    }

    if (array_key_exists('date', $options)){
        $html = admin_date($options['date']);
    }

    if (array_key_exists('datetime', $options)){
        $html = admin_datetime($options['datetime']);
    }

    if (array_key_exists('daterange', $options)){
        $html = admin_daterange($options['daterange']);
    }

    if (array_key_exists('switch', $options)){
        $html = admin_switch($options['switch']);
    }

    if (array_key_exists('checkbox', $options)){
        $html = admin_checkbox($options['checkbox']);
    }

    return view('components/form/form_group_row', [
        'label' => $label,
        'html' => $html
    ]);
}

function admin_form_group($options = [])
{
    if (isset($options[0]) && is_array($options[0])){
        $result = '';
        foreach ($options as $key => $value){
            $result .= admin_form_group($value);
        }
        return $result;
    }

    $html = '';
    $label = admin_default_label_data($options);
    if (array_key_exists('input', $options)){
        $html = admin_input($options['input']);
    }

    if (array_key_exists('select', $options)){
        $html = admin_select($options['select']);
    }

    if (array_key_exists('textarea', $options)){
        $html = admin_textarea($options['textarea']);
    }

    if (array_key_exists('radio', $options)){
        $html = admin_radio($options['radio']);
    }

    if (array_key_exists('color', $options)){
        $html = admin_color($options['color']);
    }

    if (array_key_exists('tags', $options)){
        $html = admin_tags($options['tags']);
    }

    if (array_key_exists('date', $options)){
        $html = admin_date($options['date']);
    }

    if (array_key_exists('datetime', $options)){
        $html = admin_datetime($options['datetime']);
    }

    if (array_key_exists('daterange', $options)){
        $html = admin_daterange($options['daterange']);
    }

    if (array_key_exists('switch', $options)){
        $html = admin_switch($options['switch']);
    }

    if (array_key_exists('checkbox', $options)){
        $html = admin_checkbox($options['checkbox']);
    }

    return view('components/form/form_group', [
        'label' => $label,
        'html' => $html
    ]);
}

function admin_default_data($options)
{
    $options['name'] = !isset($options['name']) ? 'undefined' : $options['name'];
    $options['required'] = isset($options['required']) && $options['required'] ? 'required' : '';
    $options['type'] = !isset($options['type']) ? 'text' : $options['type'];
    $options['value'] = !isset($options['value']) || empty($options['value']) ? old($options['name']) : $options['value'];
    $options['value'] = old($options['name']) ? old($options['name']) : $options['value'];
    $options['value'] = is_string($options['value']) ? [$options['value']] : $options['value'];
    $options['value'] = !isset($options['value']) ? [''] : $options['value'];
    $options['options'] = !isset($options['options']) ? [] : $options['options'];
    $options['multiple'] = isset($options['multiple']) && $options['multiple'] ? 'multiple' : '';
    $options['color'] = isset($options['color']) ? $options['color'] : false;
    $options['tags'] = isset($options['tags']) ? $options['tags'] : false;
    $options['daterange'] = isset($options['daterange']) ? $options['daterange'] : false;
    $options['drops'] = isset($options['drops']) ? $options['drops'] : 'down';
    $options['opens'] = isset($options['opens']) ? $options['opens'] : 'right';
    $options['date'] = isset($options['date']) ? 'datepicker' : '';
    $options['datetime'] = isset($options['datetime']) ? 'datetimepicker' : '';
    $options['format'] = admin_default_format($options);
    $options['data'] = admin_data_attr($options);
    $options['extra'] = admin_extra_attr($options);
    return $options;
}

function admin_default_format($options)
{
    if($options['daterange']){
        $options['time'] = isset($options['time']) && $options['time'] ? true : false;
        $options['format'] = isset($options['format']) ? $options['format'] : 'DD-MM-YYYY';
        $options['format'] = $options['time'] ? $options['format'] . ' HH:mm:ss' : $options['format'];
    }elseif($options['color']){
        $options['format'] = isset($options['format']) ? $options['format'] : 'hex';
    }else{
        $options['format'] = '';
    }
    return $options['format'];
}

function admin_extra_attr($options)
{
    $extra = '';
    if (isset($options['extra'])){
        foreach ($options['extra'] as $key => $value){
            $extra .= $key."=".$value." ";
        }
    }
    return $extra;
}

function admin_data_attr($options)
{
    $data = '';
    if (isset($options['data'])){
        foreach ($options['data'] as $key => $value){
            $data .= "data-".$key."=".$value." ";
        }
    }
    return $data;
}

function admin_default_label_data($options)
{
    if (isset($options['label']) && is_array($options['label'])){
        $label = $options['label'];
        $label['data'] = admin_data_attr($options['label']);
        $label['extra'] = admin_extra_attr($options['label']);
    }elseif(isset($options['label']) && is_string($options['label'])){
        $label['title'] = $options['label'];
    }else{
        $label['title'] = '';
    }
    return $label;
}