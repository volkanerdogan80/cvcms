<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= lang('settings.text.system_setting'); ?></h1>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <form action="<?= current_url(); ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.maintenance'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('maintenance') ? 'checked' : ''; ?> type="radio" name="maintenance" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('maintenance') ? 'checked' : ''; ?> type="radio" name="maintenance" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.passive'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.register_system'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('register') ? 'checked' : ''; ?> type="radio" name="register" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('register') ? 'checked' : ''; ?> type="radio" name="register" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.passive'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.login_system'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('login') ? 'checked' : ''; ?> type="radio" name="login" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('login') ? 'checked' : ''; ?> type="radio" name="login" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.passive'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.email_verify'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $setting->getValue('emailVerify') ? 'checked' : ''; ?> type="radio" name="emailVerify" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= !$setting->getValue('emailVerify') ? 'checked' : ''; ?> type="radio" name="emailVerify" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('input.text.passive'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.default_group'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <select name="defaultGroup" class="form-control select2">
                                        <?php foreach ($groups as $group): ?>
                                            <?php if($setting->getValue('defaultGroup') == $group->id): ?>
                                                <option selected value="<?= $group->id; ?>"><?= $group->getTitle(); ?></option>
                                            <?php else: ?>
                                                <option value="<?= $group->id; ?>"><?= $group->getTitle(); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('input.text.per_page_list'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="perPageList" value="<?= $setting->getValue('perPageList'); ?>" type="text" class="form-control inputtags">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-block btn-lg"><?= lang('settings.text.save_btn'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>

<script>
    $(".inputtags").tagsinput('items');
</script>

<?php $this->endSection(); ?>