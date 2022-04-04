<?php

function cve_site_setting($params = null)
{
    $setting = json_decode(json_encode(config('site')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}

function cve_site_title()
{
    $locale = service('request')->getLocale();
    return cve_site_setting("title." . $locale);
}

function cve_site_description()
{
    $locale = service('request')->getLocale();
    return cve_site_setting("description." . $locale);
}

function cve_site_keywords()
{
    $locale = service('request')->getLocale();
    return cve_site_setting("keywords." . $locale);
}

function cve_site_header_logo()
{
    return base_url(cve_site_setting('headerLogo'));
}

function cve_site_footer_logo()
{
    return base_url(cve_site_setting('footerLogo'));
}

function cve_site_mobile_logo()
{
    return base_url(cve_site_setting('mobileLogo'));
}

function cve_site_favicon()
{
    return base_url(cve_site_setting('favicon'));
}

function cve_system_setting($params = null)
{
    $setting = json_decode(json_encode(config('system')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}

function cve_system_maintenance()
{
    return cve_system_setting('maintenance');
}

function cve_system_register()
{
    return cve_system_setting('register');
}

function cve_system_login()
{
    return cve_system_setting('login');
}

function cve_system_email_verify()
{
    return cve_system_setting('emailVerify');
}

function cve_system_default_group()
{
    return cve_system_setting('defaultGroup');
}

function cve_system_register_page()
{
    return cve_system_setting('registerPage');
}

function cve_system_login_page()
{
    return cve_system_setting('loginPage');
}

function cve_system_forgot_page()
{
    return cve_system_setting('forgotPage');
}

function cve_system_install()
{
    return cve_system_setting('install');
}

function cve_system_per_page($index = null)
{
    if (is_null($index)) {
        return cve_system_setting('perPageList');
    }
    return cve_system_setting('perPageList.' . $index);
}

function cve_contact_setting($params = null)
{
    $setting = json_decode(json_encode(config('contact')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}

function cve_contact_office($office = null){
    $office =  $office == 0 || $office == 1 || is_null($office) ? null : $office - 1;
    if (is_null($office)){
        return cve_contact_setting('office');
    }
    return cve_contact_setting('office' . $office);
}

function cve_contact_office_name($office = null){
    return dot_array_search('name', cve_contact_office($office));
}

function cve_contact_office_address($office = null){
    return dot_array_search('address', cve_contact_office($office));
}

function cve_contact_office_fax($office = null){
    return dot_array_search('fax', cve_contact_office($office));
}

function cve_contact_office_map($office = null){
    return dot_array_search('map', cve_contact_office($office));
}

function cve_contact_office_phones($phone = null, $office = null){
    $phone =  $phone == 0 || $phone == 1 || is_null($phone) ? null : $phone - 1;
    $phone_list = dot_array_search('phones', cve_contact_office($office));

    if (is_null($phone)){
        return dot_array_search('phone', $phone_list);
    }

    return dot_array_search('phone' . $phone, $phone_list);
}

function cve_contact_office_phone_name($phone = null, $office = null)
{
    return dot_array_search('name', cve_contact_office_phones($phone, $office));
}

function cve_contact_office_phone_number($phone = null, $office = null)
{
    return dot_array_search('number', cve_contact_office_phones($phone, $office));
}

function cve_contact_office_emails($email = null, $office = null){
    $email =  $email == 0 || $email == 1 || is_null($email) ? null : $email - 1;
    $email_list = dot_array_search('emails', cve_contact_office($office));

    if (is_null($email)){
        return dot_array_search('email', $email_list);
    }

    return dot_array_search('email' . $email, $email_list);
}

function cve_contact_office_email_name($email = null, $office = null)
{
    return dot_array_search('name', cve_contact_office_emails($email, $office));
}

function cve_contact_office_email_email($email = null, $office = null)
{
    return dot_array_search('email', cve_contact_office_emails($email, $office));
}

function cve_autoshare_setting($params = null)
{
    $setting = json_decode(json_encode(config('autoshare')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}

function cve_autoshare_twitter_setting($params = null)
{
    $setting = json_decode(json_encode(config('autoshare')), true);
    if (is_null($params)) {
        return cve_autoshare_setting('twitter');
    }
    return cve_autoshare_setting('twitter.' . $params);
}

function cve_autoshare_facebook_setting($params = null)
{
    $setting = json_decode(json_encode(config('autoshare')), true);
    if (is_null($params)) {
        return cve_autoshare_setting('facebook');
    }
    return cve_autoshare_setting('facebook.' . $params);
}

function cve_autoshare_linkedin_setting($params = null)
{
    $setting = json_decode(json_encode(config('autoshare')), true);
    if (is_null($params)) {
        return cve_autoshare_setting('linkedin');
    }
    return cve_autoshare_setting('linkedin.' . $params);
}

function cve_autoshare_pinterest_setting($params = null)
{
    $setting = json_decode(json_encode(config('autoshare')), true);
    if (is_null($params)) {
        return cve_autoshare_setting('pinterest');
    }
    return cve_autoshare_setting('pinterest.' . $params);
}

function cve_autoshare_medium_setting($params = null)
{
    $setting = json_decode(json_encode(config('autoshare')), true);
    if (is_null($params)) {
        return cve_autoshare_setting('medium');
    }
    return cve_autoshare_setting('medium.' . $params);
}

function cve_autoshare_google_business_setting($params = null)
{
    $setting = json_decode(json_encode(config('autoshare')), true);
    if (is_null($params)) {
        return cve_autoshare_setting('googleMyBusiness');
    }
    return cve_autoshare_setting('googleMyBusiness.' . $params);
}

function cve_firebase_setting($params = null)
{
    $setting = json_decode(json_encode(config('firebase')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}

function cve_image_setting($params = null)
{
    $setting = json_decode(json_encode(config('images')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}

function cve_social_setting($params = null)
{
    $setting = json_decode(json_encode(config('social')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}

function cve_webmaster_setting($params = null)
{
    $setting = json_decode(json_encode(config('webmaster')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}

function cve_theme_setting($params = null)
{
    $setting = json_decode(json_encode(config('theme')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}

function cve_component_setting($params = null)
{
    $setting = json_decode(json_encode(config('component')), true);
    if (is_null($params)) {
        return $setting;
    }
    return dot_array_search($params, $setting);
}