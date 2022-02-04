<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= lang('Users.text.create') ?></h1>
            </div>
            <?= $this->include('admin/layout/partials/errors'); ?>
            <div class="section-body">
                <form action="<?= current_url(); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.first_name'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="first_name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.last_name'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="sur_name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.email'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="email" type="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.password'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="password" type="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.status'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <select name="status" class="form-control select2" required>
                                        <option value="<?= STATUS_ACTIVE ?>"><?= lang('Users.text.active') ?></option>
                                        <option value="<?= STATUS_PASSIVE ?>"><?= lang('Users.text.passive') ?></option>
                                        <option value="<?= STATUS_PENDING ?>"><?= lang('Users.text.pending') ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.group_select'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <select name="group_id" class="form-control select2" required>
                                        <?php foreach ($groups as $group): ?>
                                            <option value="<?= $group->id; ?>"><?= $group->getTitle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.bio'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <textarea name="bio" class="form-control" style="height: 150px"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row " style="justify-content: center">
                                <div class="col-sm-12 col-md-8">
                                    <button type="submit" class="btn btn-success btn-block btn-lg"><?= lang('Users.text.save_btn'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>