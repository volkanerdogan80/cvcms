<div class="card">
    <div class="card-header">
        <h4>Yeni Ofis Bilgileri</h4>
        <div class="card-header-action">
            <a data-id="#<?= $random; ?>" class="btn btn-icon btn-info contact-collapse" href="javascript:void(0)">
                <i class="fas fa-minus"></i>
            </a>
        </div>
    </div>
    <div class="collapse show" id="<?= $random; ?>">
        <div class="card-body">
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'office_title') ?></label>
                <div class="col-sm-12 col-md-8">
                    <input name="contact[<?= $random; ?>][name]" value="" placeholder="<?= cve_admin_lang('ContactSettings', 'office_title') ?>" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'office_address') ?></label>
                <div class="col-sm-12 col-md-8">
                    <input name="contact[<?= $random; ?>][address]" value="" placeholder="<?= cve_admin_lang('ContactSettings', 'office_address') ?>" type="text" class="form-control">
                </div>
            </div>
            <div id="contact-phone-area">
                <div class="form-group row mb-4 phone-field">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'phone') ?></label>
                    <div class="col-sm-6 col-md-4">
                        <input name="contact[<?= $random; ?>][phones][phone][name]" value="" placeholder="<?= cve_admin_lang('ContactSettings', 'entitle') ?>" type="text" class="form-control">
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <input name="contact[<?= $random; ?>][phones][phone][number]" value="" placeholder="<?= cve_admin_lang('ContactSettings', 'phone') ?>" type="text" class="form-control">
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <a href="javascript:void(0);" data-name="<?= $random; ?>" class="btn btn-icon btn-primary contact-phone-add"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div id="contact-email-area">
                <div class="form-group row mb-4 email-field">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'email') ?></label>
                    <div class="col-sm-12 col-md-4">
                        <input name="contact[<?= $random; ?>][emails][email][name]" value="" placeholder="<?= cve_admin_lang('ContactSettings', 'entitle') ?>" type="text" class="form-control">
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <input name="contact[<?= $random; ?>][emails][email][email]" value="" placeholder="<?= cve_admin_lang('ContactSettings', 'email') ?>" type="text" class="form-control">
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <a href="javascript:void(0);" data-name="<?= $random; ?>" class="btn btn-icon btn-primary contact-email-add"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'fax') ?></label>
                <div class="col-sm-12 col-md-8">
                    <input name="contact[<?= $random; ?>][fax]" value="" placeholder="<?= cve_admin_lang('ContactSettings', 'fax') ?>" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('ContactSettings', 'google_map') ?></label>
                <div class="col-sm-12 col-md-8">
                    <textarea style="height: 200px" name="contact[<?= $random; ?>][map]" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>