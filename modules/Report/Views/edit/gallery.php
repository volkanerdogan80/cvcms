<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4><?= cve_admin_lang('General', 'image_gallery'); ?></h4>
            <div class="card-header-action">
                <?= cve_multi_image_picker(
                    cve_admin_lang('Buttons', 'single_modal_button_title'),
                    'gallery', 'report-gallery-list',
                    'btn-primary'
                ); ?>
            </div>
        </div>
        <div class="card-body">
            <?= cve_multi_image_area('report-gallery-list', 'gallery', $content->withGallery()); ?>
        </div>
    </div>
</div>