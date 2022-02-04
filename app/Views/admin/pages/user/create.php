<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('Sidebar', 'user_create') ?></h1>
            </div>
            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>
            <div class="section-body">
                <form action="<?= current_url(); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('Inputs', 'first_name') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="first_name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('Inputs', 'last_name') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="sur_name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('Inputs', 'email') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="email" type="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('Inputs', 'password') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="password" type="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('Inputs', 'status') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <select name="status" class="form-control select2" required>
                                        <option value=""><?= cve_admin_lang_path('Inputs', 'status_select') ?></option>
                                        <option value="<?= STATUS_ACTIVE ?>"><?= cve_admin_lang_path('Buttons', 'active') ?></option>
                                        <option value="<?= STATUS_PASSIVE ?>"><?= cve_admin_lang_path('Buttons', 'passive') ?></option>
                                        <option value="<?= STATUS_PENDING ?>"><?= cve_admin_lang_path('Buttons', 'pending') ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('Inputs', 'group_select') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <select name="group_id" class="form-control select2" required>
                                        <option value=""><?= cve_admin_lang_path('Inputs', 'group_select') ?></option>
                                        <?php foreach ($groups as $group): ?>
                                            <option value="<?= $group->id; ?>"><?= $group->getTitle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang_path('Inputs', 'bio') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <textarea name="bio" class="form-control" style="height: 150px"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row " style="justify-content: center">
                                <div class="col-sm-12 col-md-8">
                                    <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'save') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>