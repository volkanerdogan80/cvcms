<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>
<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= cve_admin_lang('Settings', 'contact_setting') ?></h1>
            <div class="section-header-breadcrumb">
                <a href="javascript:void(0);"
                   class="btn btn-primary new-field"
                   data-url="<?= base_url(route_to("admin_field_add")); ?>"
                   data-type="office"
                   style="margin-right: 7px">
                    <i class="fas fa-plus"></i> <?= cve_admin_lang('Settings', 'create_office') ?>
                </a>
            </div>
        </div>

        <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

        <div class="section-body">
            <form action="<?= current_url(); ?>" method="post">
                <?= csrf_field(); ?>
                <div id="custom-field">
                    <?php foreach ($setting->getValue() as $key => $value): ?>
                        <div class="card">
                            <div class="card-header">
                                <h4><?= $value->name ?> <?= cve_admin_lang('ContactSettings', 'office_info') ?> </h4>
                                <div class="card-header-action">
                                    <?php if ($key != 'office'): ?>
                                        <a class="btn btn-icon btn-danger office-remove" href="javascript:void(0) ">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                    <a data-collapse="#<?= $key ?>" class="btn btn-icon btn-info" href="#">
                                        <i class="fas fa-minus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="collapse show" id="<?= $key ?>">
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'office_title') ?></label>
                                        <div class="col-sm-12 col-md-8">
                                            <input name="contact[<?= $key ?>][name]" value="<?= $value->name ?>"
                                                   placeholder="<?= cve_admin_lang('ContactSettings', 'office_title') ?>"
                                                   type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'office_address') ?></label>
                                        <div class="col-sm-12 col-md-8">
                                            <input name="contact[<?= $key ?>][address]" value="<?= $value->address ?>"
                                                   placeholder="<?= cve_admin_lang('ContactSettings', 'office_address') ?>"
                                                   type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div id="contact-phone-area">
                                        <?php $p = 0; ?>
                                        <?php foreach ($value->phones as $kphone => $phone): ?>
                                            <div class="form-group row mb-4 phone-field">
                                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'phone') ?></label>
                                                <div class="col-sm-6 col-md-4">
                                                    <input name="contact[<?= $key ?>][phones][<?= $kphone ?>][name]"
                                                           value="<?= $phone->name; ?>"
                                                           placeholder="<?= cve_admin_lang('ContactSettings', 'entitle') ?>"
                                                           type="text" class="form-control">
                                                </div>
                                                <div class="col-sm-6 col-md-4">
                                                    <input name="contact[<?= $key ?>][phones][<?= $kphone ?>][number]"
                                                           value="<?= $phone->number; ?>"
                                                           placeholder="<?= cve_admin_lang('ContactSettings', 'phone') ?>"
                                                           type="text" class="form-control">
                                                </div>
                                                <?php if ($p == 0): ?>
                                                    <div class="col-sm-6 col-md-2">
                                                        <a href="javascript:void(0);" data-name="<?= $key; ?>"
                                                           class="btn btn-icon btn-primary contact-phone-add"><i
                                                                    class="fas fa-plus"></i></a>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-sm-6 col-md-2">
                                                        <a href="javascript:void(0);"
                                                           class="btn btn-icon btn-danger contact-phone-remove"><i
                                                                    class="fas fa-minus"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php $p++ ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <div id="contact-email-area">
                                        <?php $e = 0; ?>
                                        <?php foreach ($value->emails as $kemail => $email): ?>
                                            <div class="form-group row mb-4 email-field">
                                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'email') ?></label>
                                                <div class="col-sm-12 col-md-4">
                                                    <input name="contact[<?= $key ?>][emails][<?= $kemail ?>][name]"
                                                           value="<?= $email->name ?>"
                                                           placeholder="<?= cve_admin_lang('ContactSettings', 'entitle') ?>"
                                                           type="text" class="form-control">
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <input name="contact[<?= $key ?>][emails][<?= $kemail ?>][email]"
                                                           value="<?= $email->email ?>"
                                                           placeholder="<?= cve_admin_lang('ContactSettings', 'email') ?>"
                                                           type="text" class="form-control">
                                                </div>
                                                <?php if ($e == 0): ?>
                                                    <div class="col-sm-6 col-md-2">
                                                        <a href="javascript:void(0);" data-name="<?= $key; ?>"
                                                           class="btn btn-icon btn-primary contact-email-add"><i
                                                                    class="fas fa-plus"></i></a>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-sm-6 col-md-2">
                                                        <a href="javascript:void(0);"
                                                           class="btn btn-icon btn-danger contact-email-remove"><i
                                                                    class="fas fa-minus"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php $e++ ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'fax') ?></label>
                                        <div class="col-sm-12 col-md-8">
                                            <input name="contact[<?= $key ?>][fax]" value="<?= $value->fax ?>"
                                                   placeholder="<?= cve_admin_lang('ContactSettings', 'fax') ?>"
                                                   type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'google_map') ?></label>
                                        <div class="col-sm-12 col-md-8">
                                            <textarea style="height: 200px" name="contact[<?= $key ?>][map]"
                                                      class="form-control"><?= $value->map ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="card">
                    <div class="card-footer text-right">
                        <button type="submit"
                                class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'save') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="form-group row mb-4 phone-field" id="contact-phone-field" style="display: none">
    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'phone') ?></label>
    <div class="col-sm-6 col-md-4">
        <input name="contact[office][phones][phone][name]" id="phone-name" value=""
               placeholder="<?= cve_admin_lang('ContactSettings', 'entitle') ?>" type="text" class="form-control">
    </div>
    <div class="col-sm-6 col-md-4">
        <input name="contact[office][phones][phone][number]" id="phone-number" value=""
               placeholder="<?= cve_admin_lang('ContactSettings', 'phone') ?>" type="text" class="form-control">
    </div>
    <div class="col-sm-6 col-md-2">
        <a href="javascript:void(0);" class="btn btn-icon btn-danger contact-phone-remove"><i class="fas fa-minus"></i></a>
    </div>
</div>

<div class="form-group row mb-4 email-field" id="contact-email-field" style="display: none">
    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'email') ?></label>
    <div class="col-sm-12 col-md-4">
        <input name="contact[office][emails][email][name]" id="email-name" value=""
               placeholder="<?= cve_admin_lang('ContactSettings', 'entitle') ?>" type="text" class="form-control">
    </div>
    <div class="col-sm-12 col-md-4">
        <input name="contact[office][emails][email][email]" id="email-email" value=""
               placeholder="<?= cve_admin_lang('ContactSettings', 'email') ?>" type="text" class="form-control">
    </div>
    <div class="col-sm-6 col-md-2">
        <a href="javascript:void(0);" class="btn btn-icon btn-danger contact-email-remove"><i class="fas fa-minus"></i></a>
    </div>

</div>


<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<?= script_tag(PUBLIC_ADMIN_JS_PATH . 'contact.js'); ?>
<?php $this->endSection(); ?>
