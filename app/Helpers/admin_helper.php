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
            $input .= view('components/form/input', [
                'options' => admin_default_input_data($value)
            ]);
        }
        return $input;
    }

    $options = admin_default_input_data($options);

    return view('components/form/input', [
        'options' => $options
    ]);
}

function admin_row_input()
{

}

function admin_default_input_data($options)
{
    $options['name'] = !isset($options['name']) ? 'undefined' : $options['name'];
    $options['required'] = isset($options['required']) && $options['required'] ? 'required' : '';
    $options['type'] = !isset($options['type']) ? 'text' : $options['type'];
    $options['value'] = !isset($options['value']) || empty($options['value']) ? old($options['name']) : $options['value'];

    if (isset($options['data'])){
        $data = '';
        foreach ($options['data'] as $key => $value){
            $data .= "data-".$key."=".$value." ";
        }
        $options['data'] = $data;
    }

    if (isset($options['extra'])){
        $extra = '';
        foreach ($options['extra'] as $key => $value){
            $extra .= $key."=".$value." ";
        }
        $options['extra'] = $extra;
    }
    return $options;
}