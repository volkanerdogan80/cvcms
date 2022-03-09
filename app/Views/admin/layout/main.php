<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>CMS Yönetim Paneli</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon shortcut" href="<?= base_url('public/admin/img/default/favicon.png');?>">

    <?= link_tag('public/admin/css/daterangepicker.css'); ?>
    <?= link_tag('public/admin/css/bootstrap-colorpicker.min.css'); ?>
    <?= link_tag('public/admin/css/select2.min.css'); ?>
    <?= link_tag('public/admin/css/selectric.css'); ?>
    <?= link_tag('public/admin/css/bootstrap-timepicker.min.css'); ?>
    <?= link_tag('public/admin/css/bootstrap-tagsinput.css'); ?>
    <?= link_tag('public/admin/css/iziToast.min.css'); ?>
    <?= link_tag('public/admin/css/prism.css'); ?>

    <?= link_tag('public/admin/css/dropzone-basic.css'); ?>
    <?= link_tag('public/admin/css/dropzone.css'); ?>
    <?= link_tag('public/admin/css/codemirror.css'); ?>

    <?= link_tag('public/admin/css/chocolat.css'); ?>

    <?= link_tag('public/admin/css/style.css'); ?>
    <?= link_tag('public/admin/css/components.css'); ?>

    <?= csrf_meta() ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php $this->renderSection('style'); ?>
</head>

<body>
<div id="app">
    <?php if(session()->isLogin){
        echo $this->include(PANEL_FOLDER . '/layout/partials/navbar');
        echo $this->include(PANEL_FOLDER . '/layout/partials/sidebar');
    } ?>

    <?php $this->renderSection('content'); ?>

    <?php if(session()->isLogin){
        echo $this->include(PANEL_FOLDER . '/layout/partials/footer');
    } ?>

</div>

<?= $this->include(PANEL_FOLDER . '/layout/partials/image-modal'); ?>
<?= $this->include(PANEL_FOLDER . '/layout/partials/comment-modal'); ?>
<?= $this->include(PANEL_FOLDER . '/layout/partials/notification-modal'); ?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
<script>
    let purgeDelete = {
        title: '<?= cve_admin_lang('General', 'are_you_sure') ?>',
        text: '<?= cve_admin_lang('General', 'purge_delete_desc') ?>'
    }
    /*let imagePickerModal = {
        buttonText: {
            single: '<?php // cve_admin_lang('Buttons', 'single_modal_button_title') ?>',
            multi: '<?php // cve_admin_lang('Buttons', 'multi_modal_button_title') ?>',
        },
        title: {
            single: '<?php // cve_admin_lang('Buttons', 'single_modal_title') ?>',
            multi: '<?php // cve_admin_lang('Buttons', 'multi_modal_title') ?>',
        }
    }*/
    let adminImagePicker = '<?= base_url(route_to('admin_image_picker')); ?>';
    let admin_image_upload = '<?= base_url(route_to('admin_image_upload')); ?>';
    let admin_message_listing = '<?= base_url(route_to('admin_message_listing', null)); ?>';
    let daterange = {
        today: '<?=cve_admin_lang('General', 'today') ?>',
        yesterday: '<?=cve_admin_lang('General', 'yesterday') ?>',
        last_7_days: '<?=cve_admin_lang('General', 'last_7_days') ?>',
        last_30_days: '<?=cve_admin_lang('General', 'last_30_days') ?>',
        this_month: '<?=cve_admin_lang('General', 'this_month') ?>',
        last_month: '<?=cve_admin_lang('General', 'last_month') ?>'
    }
</script>
<?= script_tag('public/admin/js/stisla.js'); ?>

<?= script_tag('public/admin/js/cleave.min.js'); ?>
<?= script_tag('public/admin/js/cleave-phone.us.js'); ?>
<?= script_tag('public/admin/js/jquery.pwstrength.min.js'); ?>
<?= script_tag('public/admin/js/daterangepicker.js'); ?>
<?= script_tag('public/admin/js/bootstrap-colorpicker.min.js'); ?>
<?= script_tag('public/admin/js/bootstrap-timepicker.min.js'); ?>
<?= script_tag('public/admin/js/bootstrap-tagsinput.min.js'); ?>
<?= script_tag('public/admin/js/select2.full.min.js'); ?>
<?= script_tag('public/admin/js/jquery.selectric.min.js'); ?>
<?= script_tag('public/admin/js/iziToast.min.js'); ?>
<?= script_tag('public/admin/js/sweetalert.min.js'); ?>
<?= script_tag('public/admin/js/prism.js'); ?>
<?= script_tag('public/admin/js/dropzone.js'); ?>
<?= script_tag('public/admin/js/jquery.chocolat.js'); ?>
<?= script_tag('public/admin/js/jquery.uploadPreview.min.js'); ?>

<?= script_tag('public/admin/js/jquery-ui.min.js'); ?>

<?= script_tag('public/admin/ckeditor/ckeditor.js'); ?>
<?= script_tag('public/admin/js/codemirror.js'); ?>

<?= script_tag('public/admin/js/request.js'); ?>
<?= script_tag('public/admin/js/scripts.js'); ?>
<?= script_tag('public/admin/js/custom.js'); ?>
<?= script_tag('public/admin/js/table-checkbox.js'); ?>
<?= script_tag('public/admin/js/listing.js'); ?>
<?= script_tag('public/admin/js/comments.js'); ?>
<?= script_tag('public/admin/js/image-picker.js'); ?>
<?= script_tag('public/admin/js/custom-field.js'); ?>
<?= script_tag('public/admin/js/messages.js'); ?>

<?php $this->renderSection('script'); ?>
</body>
</html>
