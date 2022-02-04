<?php

return [
    'title' => 'Doğrulama Sistemi Mesajları Çeviri Dosyası',
    'text' => [
        'group_id_required' => 'Grup ID Zorunlu alandır. Lütfen tekrar deneyin.',
        'group_id_numeric' => 'Grup ID sadece rakamlardan oluşabilir. Lütfen tekrar deneyin.',

        'first_name_required' => 'İsim alanı zorunlu bir alandır. Lütfen tekrar deneyin.',
        'first_name_string' => 'İsim alanı sadece alfabetik karakterlerden oluşabilir. Lütfen tekrar deneyin.',
        'first_name_min_length' => 'İsim en az 3 karakterden oluşmalıdır.',

        'sur_name_required' => 'Soyisim alanı zorunlu bir alandır. Lütfen tekrar deneyin.',
        'sur_name_string' => 'Soyisim alanı sadece alfabetik karakterlerden oluşabilir. Lütfen tekrar deneyin.',
        'sur_name_min_length' => 'Soyisim en az 3 karakterden oluşmalıdır.',

        'email_required' => 'Eposta alanı zorunlu bir alandır. Lütfen tekrar deneyin.',
        'email_valid_email' => 'Eposta adresiniz kurallara uygun değil. Lütfen tekrar deneyin.',
        'email_valid_is_unique' => 'Bu eposta adresi başka bir kullanıcı tarafından kullanılıyor. Lütfen tekrar deneyin.',

        'password_required' => 'Şifre alanı zorunlu bir alandır. Lütfen tekrar deneyin.',
        'password_min_length' => 'Şifre en az 3 karakterden oluşmalıdır. Lütfen tekrar deneyin.',

        'password2_required' => 'Şifre alanı zorunlu bir alandır. Lütfen tekrar deneyin.',
        'password2_min_length' => 'Şifre en az 3 karakterden oluşmalıdır. Lütfen tekrar deneyin.',
        'password2_matches' => 'Girmiş olduğunuz şifreler eşleşmiyor. Lütfen tekrar deneyin.',

        'verify_key_required' => 'Doğrulama anahtarı zorunlu alandır. Lütfen tekrar deneyin.',
        'verify_key_alpha' =>  'Doğrulama anahtarı sadece alfabetik karakterlerden oluşabilir. Lütfen tekrar deneyin.',

        'verify_code_numeric'   =>  'Doğrulama kodu sadece rakamlardan oluşabilir lütfen tekrar deneyin.',
        'verify_code_min_length'    =>  'Doğrulama kodu en az 6 karakterden oluşmalıdır. Lütfen tekrar deneyin.',

        'status_required'  =>  'Kullanıcı durumu zorunlu alandır. Lütfen tekrar deneyin.',

        'slug_required' => 'Grup slug değeri zorunlu alandır. Lütfen tekrar deneyin.',
        'slug_unique' => 'Slug değeri benzersiz olmalıdır. Lütfen tekrar deneyin.',
        'title_required' => 'Başlık alanı zorunlu alandır. Lütfen tekrar deneyin.',
        'permissions_required' => 'Grup izinlerini belirlemeniz gerekmektedir. Lütfen tekrar deneyin',

        'code_required' => 'Ülke kodu zorunlu alandır. Lütfen tekrar deneyin.',
        'code_min_length' => 'Ülke kodu en az 2 karakterli olmalıdır. Lütfen tekrar deneyin.',
        'code_is_unique' => 'Ülke kodu daha önce eklenmiş. Lütfen tekrar deneyin.',
        'flag_required' => 'Ülke bayrak kodu zorunlu alandır. Lütfen tekrar deneyin.',
        'flag_min_length' => 'Ülke kodu en az 2 karakterli olmalıdır. Lütfen tekrar deneyin',

        'image_name_required' => 'Resim adı zorunlu alandır. Lütfen tekrar deneyin.',
        'image_slug_required' => 'Resim slug değeri zorunlu alandır. Lütfen tekrar deneyin.',
        'image_url_required' => 'Resim URL zorunlu alandır. Lütfen tekrar deneyin.',
        'image_type_required' => 'Resim türü zorunlu alandır. Lütfen tekrar deneyin.',
        'image_size_required' => 'Resim boyutu zorunlu alandır. Lütfen tekrar deneyin.',
        'image_upload_input_name' => 'Resim yükleme inputu gerekli şartları sağlamıyoru. Lütfen tekrar deneyin.',
        'image_upload_mime_in' => 'Resim uzantısı sadece JPG, PNG ve JPEG olabilir. Lütfen tekrar deneyin.',
        'image_upload_max_size' => 'Yüklemek istediğini resim boyutu çok büyük. Lütfen tekrar deneyin.',

        'settings_skey_required' => 'Ayarlar anahtar zorunlu alandır. Lütfen tekrar deneyin',
        'settings_svalue_required' => 'Ayarlar değerler  zorunlu alandır. Lütfen tekrar deneyin',

        'category_module_required' => 'Kategori modülü zorunlu alandır. Lütfen tekrar deneyin.',
        'category_module_alpha_numeric' => 'Kategori modülü alfabetik ve rakamlardan oluşmalıdır. Lütfen tekrar deneyin.',
        'category_user_id_required' => 'Kategori oluşturan kullanıcı ID zorunlu alandır. Lütfen tekrar deneyin.',
        'category_user_id_numeric' => 'Kategori oluşturan kullanıcı ID rakamlardan oluşmalıdır. Lütfen tekrar deneyin.',
        'category_parent_id_numeric' => 'Üst kategori ID rakamlardan oluşmalıdır. Lütfen tekrar deneyin.',
        'category_slug_required' => 'Kategori slug değeri zorunlu alandır. Lütfen tekrar deneyin.',
        'category_slug_alpha_numeric_punct' => 'Kategori slug değeri harf, rakam ve işaretlerden oluşabilir. Lütfen tekrar deneyin.',
        'category_slug_is_unique' => 'Kategori slug değeri başka bir kategori tarafından kullanılıyor. Lütfen tekrar deneyin.',
        'category_title_required' => 'Kategori başlığı zorunlu alandır. Lütfen tekrar deneyin.',
        'category_title_string' => 'Kategori başlığı metin olmak zorunda. Lütfen tekrar deneyin.',
        'category_description_string' => 'Kategori açıklaması metin olmak zorunda. Lütfen tekrar deneyin.',
        'category_keywords_string' => 'Kategori etiketleri metin olmak zorunda. Lütfen tekrar deneyin.',
        'category_image_numeric' => 'Kategori resim değeri sadece rakam olabilir. Lütfen tekrar deneyin.',
        'category_status_alpha' => 'Kategori durumu sadece alfabetik karakterlerden oluşabilir. Lütfen tekrar deneyin.',
    ]
];