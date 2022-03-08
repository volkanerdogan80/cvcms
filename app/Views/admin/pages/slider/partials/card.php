<div class="card" id="<?= $random; ?>-dimiss">
    <div class="card-header">
        <h4><?= cve_admin_lang('Sliders', 'slider_item') ?></h4>
        <div class="card-header-action">
            <div class="dropdown">
                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                    <?= cve_admin_lang('Sliders', 'add') ?>
                </a>
                <div class="dropdown-menu">
                    <a href="javascript:void(0)" data-id="<?= $random; ?>" data-url="<?= base_url(route_to('admin_slider_new_text')); ?>" class="dropdown-item has-icon slider-new-text-item">
                        <i class="far fa-edit"></i>
                        <?= cve_admin_lang('Sliders', 'add_text') ?>
                    </a>
                    <a href="javascript:void(0)" data-id="<?= $random; ?>" data-url="<?= base_url(route_to('admin_slider_new_button')); ?>" class="dropdown-item has-icon slider-new-button-item">
                        <i class="fas fa-mouse-pointer"></i>
                        <?= cve_admin_lang('Sliders', 'add_button') ?>
                    </a>
                </div>
            </div>
            <a class="btn btn-icon btn-info slider-card-collapse" data-id="<?= $random; ?>" href="javascript:void(0)"><i class="fas fa-minus"></i></a>
            <a class="btn btn-icon btn-danger slider-card-remove" href="javascript:void(0)"><i class="fas fa-times"></i></a>
        </div>
    </div>
    <div class="collapse show" id="<?= $random; ?>-collapse">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <?= cve_single_image_picker($random. 'slider-image', 'slider['.$random.'][image]',  $random.'-slider-image-id', ['required' => true]); ?>
                </div>
                <div class="col-md-10">
                    <div class="section-title mt-0"><?= cve_admin_lang('Sliders', 'texts') ?></div>
                    <div class="<?= $random; ?>-text-list">


                    </div>
                    <div class="section-title mt-0"><?= cve_admin_lang('Sliders', 'buttons') ?></div>
                    <div class="<?= $random; ?>-button-list">


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>