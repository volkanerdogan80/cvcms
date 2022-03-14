<?php

return [
    'title' => 'Hata Mesajları Çeviri Dosyası',
    'description' => 'Bu alanda bulunan veriler panelde kullanılan hata mesajlarını içermektedir.',
    'text' => [
        'general_failure' => 'İşlem yapılırken bir hata meydana geldi.',
        'something_went_wrong' => 'Bir şeyler ters gitti!',
        'email_send_failure'         => 'Email gönderimi esnasında bir hata meydana geldi. Lütfen tekrar deneyiniz.',

        'user_info_failure'          => 'Giriş Başarısız. Lütfen giriş bilgilerinizi kontrol ederek tekrar deneyiniz.',
        'user_not_found'             => 'Böyle bir kullanıcı bulunamadı. Lütfen tekrar deneyiniz.',
        'user_login_pending_failure' => 'Hesabınızı onaylamanız gerekmektedir. Lütfen eposta adresinizi kontrol ederek tekrar deneyiniz.',
        'user_login_passive_failure' => 'Hesabınıza giriş yapamazsınız. Lütfen sistem yöneticisi ile iletişime geçiniz.',
        'no_login_permit'            => 'Giriş yapma yetkiniz bulunmamaktadır.',
        'registry_system_inactive'   => 'Kayıt sistemi şuan aktif değildir. Lütfen daha sonra tekrar deneyiniz.',
        'login_system_inactive'      => 'Giriş sistemi şuan aktif değildir. Lütfen daha sonra tekrar deneyiniz.',
        'success_register_failed_email' => 'Kayıt işlemi başarılı bir şekilde tamamlandı ancak doğrulama emaili gönderimi esnasında bir hata meydana geldi.',

        'verification_failure'       => 'Doğrulama İşlemi Başarısız',
        'verification_failure_msg'   => 'Doğrulama işlemi esnasında bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'verification_code_failure'  => 'Doğrulama işlemi esnasında bir hata meydana geldi. Lütfen doğrulama kodunuzu kontrol ederek tekrar deneyiniz.',
        'reset_email_failure'        => 'Şifre sıfırlama maili gönderilirken bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'reset_verification_failure' => 'Hesap doğrulama işlemi başarısız olduğu için şifrenizi sıfırlayamazsınız. <br> Lütfen şifremi unuttum sayfasına giderek tekrar şifre sıfırlama talebinde bulununuz.',
        'reset_verify_failure_sep_1' => 'Hesap doğrulama işlemi başarısız olduğu için şifrenizi sıfırlayamazsınız.',
        'reset_verify_failure_sep_2' => 'Lütfen şifremi unuttum sayfasına giderek tekrar şifre sıfırlama talebinde bulununuz.',
        'reset_password_failure'        => 'Şifre sıfırlama işlemi gerçekleştirilemiyor. <br> Lütfen şifre sıfırlama mailinizdeki linke tıkladığınızdan emin olun.',
        'password_update_failure'    => 'Şifre güncelleme esnasında bir hata meydana geldi. Lütfen tekrar deneyiniz.',

        'delete_admin_group_failure'  => 'Root Sistem Yöneticisi Grubunu silemezsiniz. Lütfen tekrar deneyiniz.',
        'delete_group_with_user'    => 'Bu kullanıcı grubuna bağımlı kullanıcılar bulunduğu için bu kayıt silinemez.',
        'delete_admin_user_failure' => 'Root Sistem Yöneticisi silinemez.',
        'delete_empty_fields'       => 'Silme işlemi yapabilmek için en az bir öğe seçmeniz gerekir. Lütfen tekrar deneyiniz.',
        'restore_empty_fields'      => 'Geri getirme işlemi yapabilmek için en az bir öğe seçmeniz gerekir. Lütfen tekrar deneyiniz.',
        'purge_delete_empty_fields' => 'Kalıcı olarak silme işlemi yapabilmek için en az bir öğe seçmeniz gerekir. Lütfen tekrar deneyiniz.',
        'change_status_empty_fields'=> 'Durum değişikliği işlemi yapabilmek için en az bir öğe seçmeniz gerekir. Lütfen tekrar deneyiniz.',

        'delete_category_with_subs'    => 'Bu kategoriye bağımlı alt kategoriler bulunduğu için bu kayıt silinemez.',
        'delete_category_with_content' => 'Bu kategoriye bağımlı içerikler bulunduğu için bu kayıt silinemez.',

        'status_change_failure' => 'Kaydın durumu değiştilirken bir hata meydana geldi. Lütfen tekrar deneyin.',
        'create_failure'        => 'Kayıt oluşturma esnasında bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'update_failure'        => 'Kayıt güncellenirken bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'delete_failure'        => 'Kayıt silinirken bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'undo_delete_failure'   => 'Kayıt geri getirilirken bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'purge_delete_failure'  => 'Kayıt sistemden kalıcı olarak silinirken bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'invalid_request_type'  => 'Geçersiz istek türü. Lütfen tekrar deneyiniz.',
        'unauthorized_request'  => 'Bu işlemi gerçekleştirmek için yetkiniz bulunmuyor!',

        'content_id_valid_failure'  => 'İçerik ID boş bırakılamaz. Lütfen tekrar deneyiniz.',
        'content_absent_failure'    => 'Böyle bir içerik bulunamadı.',
        'content_status_inactive'   => 'İçeriği yayınlabilmeniz için içerik aktif durumda olmalıdır.',

        'twitter_status_inactive'   => 'Twitter içerik paylaşımı aktif değil! Oto Paylaşım Ayarları\'dan paylaşım durumunu aktif yaparak tekrar deneyiniz.',
        'facebook_status_inactive'  => 'Facebook içerik paylaşımı aktif değil! Oto Paylaşım Ayarları\'dan paylaşım durumunu aktif yaparak tekrar deneyiniz.',
        'linkedin_status_inactive'  => 'Linkedin içerik paylaşımı aktif değil! Oto Paylaşım Ayarları\'dan paylaşım durumunu aktif yaparak tekrar deneyiniz.',
        'facebook_test_publish_failure'   => 'Facebook profilinizde test paylaşımı yapılırken bir sorun meydana geldi. Lütfen tekrar deneyiniz.',
        'linkedin_test_publish_failure'   => 'Facebook profilinizde test paylaşımı yapılırken bir sorun meydana geldi. Lütfen tekrar deneyiniz.',

        'default_language_delete_failure' => 'Varsayılan dili silemezsiniz.',
        'default_language_status_failure' => 'Varsayılan dilin durumunu değiştiremezsiniz.',
        'default_language_change_failure' => 'Varsayılan dil değiştirilirken bir hata meydana geldi.',
        'default_language_inactive'     => 'Varsayılan dil durumu aktif olmak zorundadır.',

        'image_upload_failure'            => 'İmaj yüklenirken bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'image_deletion_failure'          => 'İmaj silinirken bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'image_database_failure'          => 'İmaj veritabanına kaydedilirken bir hata meydana geldi. Lütfen tekrar deneyiniz.',

        'comment_reply_failure'           => 'Kendinize ait olmayan bir yoruma cevap veremezsiniz.',
        'comment_edit_failure'            => 'Kendinize ait olmayan bir yorumu düzenleyemezsiniz.',
        'comment_reply_status_failure'    => 'Kendinize ait olmayan bir yorumun durumunu değiştiremezsiniz.',
        'comment_undo_delete_failure'     => 'Kendinize ait olmayan silinmiş bir yorumu geri getiremezsiniz.',
        'comment_purge_delete_failure'    => 'Kendinize ait olmayan  bir yorumu kalıcı olarak silemezsiniz.',

        'message_not_found'         => 'Böyle bir mesaj bulunmadı. Lütfen tekrar deneyiniz.',
        'message_auth_failure'      => 'Bu işlemi yapma yetkisine sahip değilsiniz.',
        'message_mark_read_failure' => 'Mesajlar okundu olarak işaretlendirken bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'message_send_db_failure'   => 'Mesajınız alıcıya gönderildi. Ancak sisteme kaydedilirken bir hata meydana geldi. Lütfen tekrar deneyiniz.',

        'theme_active_deletion_error' => 'Aktif durumda bulunan temayı silemezsiniz.',

        'page_status_failure'    => 'Kendinize ait olmayan bir sayfanın durumunu değiştiremezsiniz.',
        'page_delete_failure'    => 'Kendinize ait olmayan bir sayfayı silemezsiniz.',
        'page_undo_delete_failure'     => 'Kendinize ait olmayan silinmiş bir sayfayı geri getiremezsiniz.',
        'page_purge_delete_failure'    => 'Kendinize ait olmayan silinmiş bir sayfayı kalıcı olarak silemezsiniz.',

        'notification_send_failure'   => 'Bildirim gönderimi esnasında bir hata meydana geldi. Lütfen tekrar deneyiniz.',
        'realtime_visitors_failure'   => 'Sitenizdeki anlık ziyaretçi sayısı bilgisine erişilemiyor. Günlük kullanım limiti dolmuş olabilir.',

        'data_not_found' => 'Böyle bir veri bulunamadı!',
        'empty_slider_failure' => 'Slider en az bir eleman içermek zorundadır. Bu sliderı tamamen kaldırmak istiyorsanız sliderlar menüsüne giderek bu işlemi gerçekleştirebilirsiniz.'
    ]
];
