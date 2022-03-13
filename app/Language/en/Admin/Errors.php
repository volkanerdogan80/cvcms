<?php

return [
    'title' => 'Error Messages Translation File',
    'description' => 'The data in this field contains error messages used in the panel.',
    'text' => [
        'general_failure' => 'An error occurred while processing the operation.',
        'something_went_wrong' => 'Something went wrong!',
        'email_send_failure'         => 'An error occurred while sending mail. Please try again.',

        'user_info_failure'          => 'Login Failed.Please try again by checking your login information.',
        'user_not_found'             => 'No such user found. Please try again',
        'user_login_pending_failure' => 'You must confirm your account. Please check your email address.',
        'user_login_passive_failure' => 'You cannot login to your account. Please contact the administrator.',
        'no_login_permit'          => 'You are not authorized to login.',
        'registry_system_inactive'  => 'The registration system is currently inactive. Please try again later.',
        'login_system_inactive'     => 'The login system is currently inactive. Please try again later.',
        'success_register_failed_email' => 'Registration completed successfully, but an error occurred while sending the verification email.',

        'verification_failure'       => 'Verification Failed! ',
        'verification_failure_msg'   => 'An error occurred during the validation process. Please try again.',
        'verification_code_failure'  => 'An error occurred during the validation process. Please check your verification code and try again.',
        'reset_email_failure'        => 'An error occurred while sending the password reset email. Please try again.',
        'reset_verification_failure' => 'You cannot reset your password because the account verification failed. <br> Please go to the forgot password page and request a reset password again.',
        'reset_verify_failure_sep_1' => 'You cannot reset your password because the account verification failed.',
        'reset_verify_failure_sep_2' => 'Please go to the forgot password page and request a reset password again.',
        'reset_password_failure'        => 'Unable to perform password reset.  <br> Please make sure you click on the link in your password reset email.',
        'password_update_failure'    => 'An error occurred while updating the password. Please try again.',

        'delete_admin_group_failure'  => 'You cannot delete the Root Admin group. Please try again.',
        'delete_group_with_user'    => 'This record cannot be deleted, as there are dependent users in this user group.',
        'delete_admin_user_failure'   => 'You cannot delete administrators.',
        'delete_empty_fields'       => 'You must select at least one item in order to be able to delete. Please try again. ',
        'restore_empty_fields'      => 'You must select at least one item in order to be able to restore. Please try again. ',
        'purge_delete_empty_fields' => 'You must select at least one item in order to be able to permanently delete. Please try again.',
        'change_status_empty_fields'=> 'You must select at least one item in order to be able to change status. Please try again.',

        'delete_category_with_subs' => 'This record cannot be deleted, as there are sub-categories dependent on this category.',
        'delete_category_with_content' => 'This record cannot be deleted, as there are contents dependent on this category.',

        'status_change_failure' => 'An error occurred while changing status of the record. Please try again.',
        'create_failure'        => 'An error occurred while creating the record. Please try again.',
        'update_failure'        => 'An error occurred while updating the record. Please try again.',
        'delete_failure'        => 'An error occurred while deleting the record. Please try again.',
        'undo_delete_failure'   => 'An error occurred while recovering the record. Please try again.',
        'purge_delete_failure'  => 'An error occurred while permanently deleting the record. Please try again.',
        'invalid_request_type'  => 'Invalid request type. Please try again.',
        'unauthorized_request'  => 'You are not authorized to perform this operation!',

        'blog_edit_auth_failure'      => 'You are not authorized to edit this post. ',
        'blog_edit_failure'           => 'You cannot change the status of an article that does not belong to you.',
        'blog_delete_failure'         => 'You cannot delete an article that does not belong to you.',
        'blog_undo_delete_failure'    => 'You cannot restore an article that does not belong to you.',
        'blog_purge_delete_failure'   => 'You cannot permanently delete an article that does not belong to you.',

        'content_id_valid_failure'  => 'Content ID is required. Please try again.',
        'content_absent_failure'    => 'No such content was found. Please try again.',
        'content_status_inactive'   => 'Content must be active in order for you to post content.',

        'twitter_status_inactive'   => 'Twitter content sharing is inactive! Try again by enabling the sharing status from Auto Sharing Settings.',
        'facebook_status_inactive'  => 'Facebook content sharing is inactive! Try again by enabling the sharing status from Auto Sharing Settings.',
        'linkedin_status_inactive'  => 'Linkedin content sharing is inactive! Try again by enabling the sharing status from Auto Sharing Settings.',
        'facebook_test_publish_failure'   => 'A problem occurred while publishing Facebook test content. Please try again.',
        'linkedin_test_publish_failure'   => 'A problem occurred while publishing Linkedin test content. Please try again.',

        'default_language_delete_failure' => 'You cannot delete default language.',
        'default_language_status_failure' => 'You cannot change default language status.',
        'default_language_change_failure' => 'An error has occurred while changing the default language.',
        'default_language_inactive'     => 'Default language status must be active. ',

        'image_upload_failure'            => 'An error has occurred while uploading image. Please try again.',
        'image_deletion_failure'          => 'An error has occurred while deleting image. Please try again.',
        'image_database_failure'          => 'An error occurred while saving the image to the database. Please try again.',

        'comment_reply_failure'           => 'You are not allowed to reply to a comment that does not belong to you.',
        'comment_edit_failure'            => 'You are not allowed to edit a comment that does not belong to you.',
        'comment_reply_status_failure'    => 'You are not allowed to change the status of a comment that does not belong to you.',
        'comment_undo_delete_failure'     => 'You are not allowed to restore a deleted comment that does not belong to you.',
        'comment_purge_delete_failure'    => 'You are not allowed to permanently delete a comment that does not belong to you.',

        'message_not_found'         => 'No such message was found. Please try again.',
        'message_auth_failure'      => 'You are not authorized to perform this action.',
        'message_mark_read_failure' => 'An error occurred while marking the messages as read. Please try again.',
        'message_send_db_failure'   => 'Your message was sent to the recipient. But an error occurred while saving it to the system. Please try again.',

        'theme_active_deletion_error' => 'You cannot delete the currently active theme.',

        'page_status_failure'    => 'You are not allowed to change the status of a page that does not belong to you.',
        'page_delete_failure'    => 'You are not allowed to delete a page that does not belong to you.',
        'page_undo_delete_failure'     => 'You are not allowed to restore a page that does not belong to you.',
        'page_purge_delete_failure'    => 'You are not allowed to permanently delete a page that does not belong to you.',

        'notification_send_failure'   => 'An error occurred while sending notification. Please try again.',
        'realtime_visitors_failure'   => 'The instant visitor count information on your site cannot be accessed. The daily usage limit may have been reached.',

        'data_not_found' => 'Data not found!',
        'empty_slider_failure' => 'The slider must contain at least one element. If you want to remove this slider completely, you can do this by going to the sliders menu.'

    ]
];
