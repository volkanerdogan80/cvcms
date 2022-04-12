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

    return view('components/form/elements/input/input', [
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

    return view('components/form/elements/select-box/select', [
        'options' => $options
    ]);
}

function admin_row_input($options = [])
{
    $label = [];
    $input = [];
    if (isset($options[0]) && is_array($options[0])){
        $row = '';
        foreach ($options as $key => $value){
            $row .= admin_row_input($value);
        }
        return $row;
    }

    $label = admin_default_label_data($options);

    if (isset($options['input']) && is_array($options['input'])){
        $input = $options['input'];
        $input['placeholder'] = !isset($input['placeholder']) ? $label['title'] : $input['placeholder'];
    }else{
        $input['name'] = $options['input'];
        $input['placeholder'] = $label['title'];
    }

    return view('components/form/elements/input/row_input', [
        'label' => $label,
        'input' => $input
    ]);
}

function admin_row_select($options = [])
{
    $label = [];
    $select = [];

    if (isset($options[0]) && is_array($options[0])){
        $row = '';
        foreach ($options as $key => $value){
            $row .= admin_row_select($value);
        }
        return $row;
    }

    $label = admin_default_label_data($options);

    if (isset($options['select']) && is_array($options['select'])){
        $select = $options['select'];
    }else{
        $select['name'] = $options['select'];
    }

    return view('components/form/elements/select-box/row_select', [
        'label' => $label,
        'select' => $select
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