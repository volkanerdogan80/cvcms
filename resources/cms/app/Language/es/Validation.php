<?php

return [
    'title' => 'Verification System Messages Translation File',
    'text' => [
        'group_id_required' => 'Group ID is required field. Please try again.',
        'group_id_numeric' => 'Group ID can only contain numbers. Please try again.',

        'first_name_required' => 'Namespace is a required field. Please try again.',
        'first_name_string' => 'The namespace can only contain alphabetic characters. Please try again.',
        'first_name_min_length' => 'The name must contain at least 3 characters.',

        'sur_name_required' => 'The last name field is a required field. Please try again.',
        'sur_name_string' => 'The last name field can only contain alphabetic characters. Please try again.',
        'sur_name_min_length' => 'The surname must contain at least 3 characters.',

        'email_required' => 'The email field is a required field. Please try again.',
        'email_valid_email' => 'Your e-mail address is not legal. Please try again.',
        'email_valid_is_unique' => 'This e-mail address is used by another user. Please try again.',

        'password_required' => 'The password field is a required field. Please try again.',
        'password_min_length' => 'Password must be at least 3 characters. Please try again.',

        'password2_required' => 'The password field is a required field. Please try again.',
        'password2_min_length' => 'Password must be at least 3 characters. Please try again.',
        'password2_matches' => 'The passwords you entered do not match. Please try again.',

        'verify_key_required' => 'The authentication key is a required field. Please try again.',
        'verify_key_alpha' =>  'The verification key can only contain alphabetic characters. Please try again.',

        'verify_code_numeric'   =>  'The verification code can only contain numbers, please try again.',
        'verify_code_min_length'    =>  'The verification code must be at least 6 characters. Please try again.',

        'status_required'  =>  'User status is a required field. Please try again.',

        'slug_required' => 'Group slug value is required field. Please try again.',
        'slug_unique' => 'The slug value must be unique. Please try again.',
        'title_required' => 'Title field is required. Please try again.',
        'permissions_required' => 'You need to set group permissions. Please try again',

        'code_required' => 'Country code is required field. Please try again.',
        'code_min_length' => 'Country code must be at least 2 characters. Please try again.',
        'code_is_unique' => 'Country code has been added before. Please try again.',
        'flag_required' => 'Country flag code is required field. Please try again.',
        'flag_min_length' => 'Country code must be at least 2 characters. Please try again',

        'image_name_required' => 'Image name is a required field. Please try again.',
        'image_slug_required' => 'Image slug value is required field. Please try again.',
        'image_url_required' => 'Image URL is required field. Please try again.',
        'image_type_required' => 'Image type is required field. Please try again.',
        'image_size_required' => 'Image size is required field. Please try again.',
        'image_upload_input_name' => 'The image upload input does not meet the required requirements. Please try again.',
        'image_upload_mime_in' => 'Image extension can only be JPG, PNG and JPEG. Please try again.',
        'image_upload_max_size' => 'The image size you want to upload is too large. Please try again.',

        'settings_skey_required' => 'Settings is the key mandatory field. Please try again',
        'settings_svalue_required' => 'Settings values are required field. Please try again',

        'category_module_required' => 'Category module is required field. Please try again.',
        'category_module_alpha_numeric' => 'The category module must be alphabetical and numbered. Please try again.',
        'category_user_id_required' => 'User ID creating a category is a mandatory field. Please try again.',
        'category_user_id_numeric' => 'The user ID that creates a category should consist of numbers. Please try again.',
        'category_parent_id_numeric' => 'The upper category ID should consist of numbers. Please try again.',
        'category_slug_required' => 'Category slug value is required field. Please try again.',
        'category_slug_alpha_numeric_punct' => 'Category slug value can be from letters, numbers and signs. Please try again.',
        'category_slug_is_unique' => 'Category slug value is used by another category. Please try again.',
        'category_title_required' => 'Category title is required field. Please try again.',
        'category_title_string' => 'Category title must be text. Please try again.',
        'category_description_string' => 'Category description has to be text. Please try again.',
        'category_keywords_string' => 'Category tags have to be text. Please try again.',
        'category_image_numeric' => 'Category image value can only be numbers. Please try again.',
        'category_status_alpha' => 'Category status can only contain alphabetic characters. Please try again.',
    ]
];