<?php

//--------------------------------------------------------------------
// App Namespace
//--------------------------------------------------------------------
// This defines the default Namespace that is used throughout
// CodeIgniter to refer to the Application directory. Change
// this constant to change the namespace that all application
// classes should use.
//
// NOTE: changing this will require manually modifying the
// existing namespaces of App\* namespaced-classes.
//
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
|--------------------------------------------------------------------------
| Composer Path
|--------------------------------------------------------------------------
|
| The path that Composer's autoload file is expected to live. By default,
| the vendor folder is in the Root directory, but you can customize that here.
*/
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
|--------------------------------------------------------------------------
| Timing Constants
|--------------------------------------------------------------------------
|
| Provide simple ways to work with the myriad of PHP functions that
| require information to be in seconds.
*/
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('STATUS_ACTIVE')            || define('STATUS_ACTIVE', 'ACTIVE');
defined('STATUS_PASSIVE')           || define('STATUS_PASSIVE', 'PASSIVE');
defined('STATUS_PENDING')           || define('STATUS_PENDING', 'PENDING');
defined('STATUS_APPROVED')          || define('STATUS_APPROVED', 'APPROVED');
defined('STATUS_DRAFT')             || define('STATUS_DRAFT', 'DRAFT');
defined('STATUS_READ')          || define('STATUS_READ', 'READ');
defined('STATUS_UNREAD')          || define('STATUS_UNREAD', 'UNREAD');

defined('REQUEST_WEB')          || define('REQUEST_WEB', 'WEB');
defined('REQUEST_API')          || define('REQUEST_API', 'API');

defined('DEFAULT_ADMIN_GROUP')      || define('DEFAULT_ADMIN_GROUP', 'admin');
defined('DEFAULT_REGISTER_USER')    || define('DEFAULT_REGISTER_USER', 'user');
defined('LOGIN_PERMIT_KEY')         || define('LOGIN_PERMIT_KEY', 'user_login');
defined('ADMIN_LOGIN_PERMIT_KEY')   || define('ADMIN_LOGIN_PERMIT_KEY', 'admin_login');

defined('PANEL_FOLDER')      || define('PANEL_FOLDER', 'admin');
defined('UPLOAD_FOLDER_PATH')       || define('UPLOAD_FOLDER_PATH', 'public/upload/');
defined('PUBLIC_ADMIN_PATH')        || define('PUBLIC_ADMIN_PATH', 'public/admin/');
defined('PUBLIC_ADMIN_IMAGE_PATH')  || define('PUBLIC_ADMIN_IMAGE_PATH', 'public/admin/img/');
defined('PUBLIC_ADMIN_JS_PATH')     || define('PUBLIC_ADMIN_JS_PATH', 'public/admin/js/');
defined('PUBLIC_ADMIN_CSS_PATH')    || define('PUBLIC_ADMIN_CSS_PATH', 'public/admin/css/');

defined('DEFAULT_IMAGE_SELECT_ICON')   || define('DEFAULT_IMAGE_SELECT_ICON', PUBLIC_ADMIN_IMAGE_PATH . 'default/default-image.png');
defined('DEFAULT_VIDEO_SELECT_ICON')   || define('DEFAULT_VIDEO_SELECT_ICON', PUBLIC_ADMIN_IMAGE_PATH . 'default/default-video.png');
defined('DEFAULT_FILE_SELECT_ICON')    || define('DEFAULT_FILE_SELECT_ICON', PUBLIC_ADMIN_IMAGE_PATH . 'default/default-file.png');

defined('LOADING_GIF') || define('LOADING_GIF', PUBLIC_ADMIN_IMAGE_PATH . 'loading.gif');

defined('LANGUAGE_PATH')        || define('LANGUAGE_PATH', APPPATH . 'Language/');
defined('THEMES_FOLDER')          || define('THEMES_FOLDER', 'themes/');
defined('THEMES_PATH')          || define('THEMES_PATH', ROOTPATH . THEMES_FOLDER . '/');

defined('COMPONENTS_FOLDER')          || define('COMPONENTS_FOLDER', 'components/');
defined('COMPONENTS_PATH')          || define('COMPONENTS_PATH', ROOTPATH . COMPONENTS_FOLDER . '/');

defined('PANEL_NAME')          || define('PANEL_NAME', 'CVECMS');
defined('PANEL_SHORT_NAME')          || define('PANEL_SHORT_NAME', 'CVE');
