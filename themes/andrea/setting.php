<?php $this->section('style'); ?>
<!-- Custom CSS codes here -->
<?php $this->endSection() ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Örnek İnput 1
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <input value="<?= $theme->getSetting('area1'); ?>" name="setting[area1]" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Örnek İnput 2
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <input value="<?= $theme->getSetting('area2'); ?>" name="setting[area2]" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Örnek İnput 3
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <input value="<?= $theme->getSetting('area3'); ?>" name="setting[area3]" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Örnek İnput 4
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <input value="<?= $theme->getSetting('area4'); ?>" name="setting[area4]" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'save'); ?></button>
    </div>
</div>

<?php $this->section('script'); ?>
    <!-- Custom JS codes here -->
<?php $this->endSection() ?>