<?php foreach ($sliders->getValue() as $ckey => $slider): ?>
    <div class="card" id="<?= $ckey; ?>-dimiss">
        <div class="card-header">
            <h4><?= cve_admin_lang('Sliders', 'slider_item') ?></h4>
            <div class="card-header-action">
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                        <?= cve_admin_lang('Sliders', 'add') ?>
                    </a>
                    <div class="dropdown-menu">
                        <a href="javascript:void(0)" data-id="<?= $ckey; ?>" data-url="<?= base_url(route_to('admin_slider_new_text')); ?>" class="dropdown-item has-icon slider-new-text-item">
                            <i class="far fa-edit"></i>
                            <?= cve_admin_lang('Sliders', 'add_text') ?>
                        </a>
                        <a href="javascript:void(0)" data-id="<?= $ckey; ?>" data-url="<?= base_url(route_to('admin_slider_new_button')); ?>" class="dropdown-item has-icon slider-new-button-item">
                            <i class="fas fa-mouse-pointer"></i>
                            <?= cve_admin_lang('Sliders', 'add_button') ?>
                        </a>
                    </div>
                </div>
                <a class="btn btn-icon btn-info slider-card-collapse" data-id="<?= $ckey; ?>" href="javascript:void(0)"><i class="fas fa-minus"></i></a>
                <a class="btn btn-icon btn-danger slider-card-remove" href="javascript:void(0)"><i class="fas fa-times"></i></a>
            </div>
        </div>
        <div class="collapse show" id="<?= $ckey; ?>-collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <?= cve_single_image_picker($ckey. 'slider-image', 'slider['.$ckey.'][image]',  $ckey.'-slider-image-id', [
                                'image' => $sliders->getItem($ckey)->getImage()->getImageUrl(),
                                'value' => $sliders->getItem($ckey)->getImage()->getImageId(),
                            ]); ?>
                    </div>
                    <div class="col-md-10">
                        <div class="section-title mt-0"><?= cve_admin_lang('Sliders', 'texts') ?></div>
                        <div class="<?= $ckey; ?>-text-list">
                            <?php foreach ($sliders->getItem($ckey)->getTexts() as $tkey => $text): ?>
                                <div class="custom-field slider-item">
                                    <ul class="nav nav-tabs" style="border-bottom: 0px" id="myTab" role="tablist">
                                        <?php foreach (cve_language() as $key => $lang): ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= $key == 0 ? 'active' : ''; ?> "
                                                   id="<?= $lang->getCode(); ?>-tab"
                                                   data-toggle="tab"
                                                   href="#<?= $ckey; ?>-<?= $tkey; ?>-<?= $lang->getCode(); ?>"
                                                   role="tab"
                                                   aria-controls="<?= $ckey; ?>-<?= $tkey; ?>-<?= $lang->getCode(); ?>"
                                                   aria-selected="true">
                                                    <img width="20" src="<?= $lang->getFlag(); ?>">
                                                    <?= $lang->getTitle(); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <input value="<?= $tkey; ?>" name="slider[<?= $ckey; ?>][text][<?= $tkey; ?>][key]" placeholder="<?= cve_admin_lang('Sliders', 'text_key') ?>" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="tab-content" id="myTabContent">
                                                <?php foreach (cve_language() as $key => $lang): ?>
                                                    <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>"
                                                         id="<?= $ckey; ?>-<?= $tkey; ?>-<?= $lang->getCode(); ?>"
                                                         role="tabpanel"
                                                         aria-labelledby="<?= $ckey; ?>-<?= $tkey; ?>-<?= $lang->getCode(); ?>-tab"
                                                         style="padding: 0px"
                                                    >
                                                        <div class="form-group mt-3">
                                                            <input value="<?= $sliders->getItem($ckey)->getText($tkey, $lang->getCode()); ?>" name="slider[<?= $ckey; ?>][text][<?= $tkey; ?>][lang][<?= $lang->getCode(); ?>]"  placeholder="<?= cve_admin_lang('Sliders', 'text_value') ?>" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-1  mt-3">
                                            <button class="btn btn-danger btn-lg field-remove">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="section-title mt-0"><?= cve_admin_lang('Sliders', 'buttons') ?></div>
                        <div class="<?= $ckey; ?>-button-list">

                            <?php foreach ($sliders->getItem($ckey)->getButtons() as $bkey => $button): ?>
                                <div class="custom-field slider-item">
                                    <ul class="nav nav-tabs" style="border-bottom: 0px" id="myTab" role="tablist">
                                        <?php foreach (cve_language() as $key => $lang): ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= $key == 0 ? 'active' : ''; ?> "
                                                   id="<?= $lang->getCode(); ?>-tab"
                                                   data-toggle="tab"
                                                   href="#<?= $ckey; ?>-<?= $bkey; ?>-<?= $lang->getCode(); ?>"
                                                   role="tab"
                                                   aria-controls="<?= $ckey; ?>-<?= $bkey; ?>-<?= $lang->getCode(); ?>"
                                                   aria-selected="true">
                                                    <img width="20" src="<?= $lang->getFlag(); ?>">
                                                    <?= $lang->getTitle(); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <div class="form-group mt-3">
                                                <input value="<?= $bkey; ?>" name="slider[<?= $ckey; ?>][button][<?= $bkey; ?>][key]" placeholder="<?= cve_admin_lang('Sliders', 'button_key') ?>" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="tab-content" id="myTabContent">
                                                <?php foreach (cve_language() as $key => $lang): ?>
                                                    <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>"
                                                         id="<?= $ckey; ?>-<?= $bkey; ?>-<?= $lang->getCode(); ?>"
                                                         role="tabpanel"
                                                         aria-labelledby="<?= $ckey; ?>-<?= $bkey; ?>-<?= $lang->getCode(); ?>-tab"
                                                         style="padding: 0px"
                                                    >
                                                        <div class="form-group mt-3">
                                                            <div class="input-group">
                                                                <input value="<?= $sliders->getItem($ckey)->getButton($bkey)->getButtonTitle($lang->getCode()) ?>" name="slider[<?= $ckey; ?>][button][<?= $bkey; ?>][title][<?= $lang->getCode(); ?>]" type="text" class="form-control" placeholder="<?= cve_admin_lang('Sliders', 'button_value') ?>">
                                                                <input value="<?= $sliders->getItem($ckey)->getButton($bkey)->getButtonUrl($lang->getCode()) ?>" name="slider[<?= $ckey; ?>][button][<?= $bkey; ?>][url][<?= $lang->getCode(); ?>]" type="text" class="form-control" placeholder="<?= cve_admin_lang('Sliders', 'button_url') ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-1  mt-3">
                                            <button class="btn btn-danger btn-lg field-remove">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

