<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Whatsapp Numarası
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <input value="<?= cve_component_setting('area1') ?>" name="setting[area1]" type="text" class="form-control">
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
                        <input value="<?= cve_component_setting('area3') ?>" name="setting[area3]" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'update'); ?></button>
    </div>
</div>
