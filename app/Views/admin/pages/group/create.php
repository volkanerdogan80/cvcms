<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Sidebar', 'group_create') ?></h1>
            </div>
            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card author-box card-primary">
                            <div class="card-header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <?php foreach (cve_language() as $key => $lang): ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?= $key == 0 ? 'active' : ''; ?> "
                                               id="<?= $lang->getCode(); ?>-tab"
                                               data-toggle="tab"
                                               href="#<?= $lang->getCode(); ?>"
                                               role="tab"
                                               aria-controls="<?= $lang->getCode(); ?>"
                                               aria-selected="true">
                                                <img width="20" src="<?= $lang->getFlag(); ?>">
                                                <?= $lang->getTitle(); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <form action="<?= current_url(); ?>" method="POST">
                                <div class="card-body">
                                        <?= csrf_field() ?>
                                        <div class="tab-content" id="myTabContent">
                                            <?php foreach (cve_language() as $key => $lang): ?>
                                                <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>" id="<?= $lang->getCode(); ?>" role="tabpanel" aria-labelledby="<?= $lang->getCode(); ?>-tab">
                                                    <div class="form-group row mb-4">
                                                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= $lang->getTitle(); ?> <?= cve_admin_lang('Inputs', 'group_title') ?></label>
                                                        <div class="col-sm-12 col-md-8">
                                                            <input name="title[<?= $lang->getCode(); ?>]" type="text" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="section-title mt-0"><?= cve_admin_lang('TableHeaders', 'group_permit') ?></div>

                                            <div class="form-group">
                                                <input id="permit-filter" type="text" class="form-control" placeholder="<?= cve_admin_lang('Inputs', 'filter_permits') ?>">
                                            </div>

                                            <ul class="list-group permit-list">
                                                <?php foreach (permissions() as $pkey => $pvalue): ?>
                                                    <li data-key="<?= $pkey ?>"
                                                        data-title="<?= cve_admin_lang('Permissions', $pkey); ?>"
                                                        class="<?= $pkey ?> list-group-item d-flex justify-content-between align-items-center"
                                                    >
                                                        <?= cve_admin_lang('Permissions', $pkey); ?>
                                                        <span class="badge badge-pill">
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="permission[<?= $pkey ?>]"
                                                               class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'save') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>

<script>
    $(document).on('change', '#permit-filter', function (){
        let permit_list = $('.permit-list').find('li');
        let filter = $(this).val().toUpperCase();
        permit_list.each(function (index, item){
            let title = $(item).data('title').toUpperCase();
            let key = $(item).data('key');
            if (title.indexOf(filter) > -1){
                $('.' + key).removeClass('display-none');
            }else{
                $('.' + key).addClass('display-none');
            }
        })
    })
</script>

<?php $this->endSection(); ?>


