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

/**
 * Label solda oluşturuluyor. Form grubu row ile oluşturuyor.
 */
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

    return view('components/form/form-group-row', [
        'label' => $label,
        'html' => $html
    ]);
}

/**
 * Label üstte oluşturuluyor. Form grubu row olmadan oluşturuyor.
 */
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

    return view('components/form/form-group', [
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
    $options['options'] = !isset($options['options']) ? [] : $options['options'];
    $options['multiple'] = isset($options['multiple']) && $options['multiple'] ? 'multiple' : '';
    $options['data'] = admin_data_attr($options);
    $options['extra'] = admin_extra_attr($options);
    return $options;
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
    }else{
        $label['title'] = $options['label'];
    }
    return $label;
}