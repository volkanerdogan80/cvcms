<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>

<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="<?= base_url('public/admin/img/stisla-fill.svg') ?>" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                    <div class="card-header"><h4><?= lang( 'ResetPassword.text.title'); ?></h4></div>

                    <div class="card-body">
                        <?= $this->include('admin/layout/partials/errors'); ?>
                        <p class="text-muted"><?= lang( 'ResetPassword.text.content'); ?></p>
                        <form method="POST">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="password"><?= lang( 'Input.text.new_password'); ?></label>
                                <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2" required>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm"><?= lang( 'Input.text.password2'); ?></label>
                                <input id="password-confirm" type="password" class="form-control" name="password2" tabindex="2" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    <?= lang( 'ResetPassword.text.button'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; CV Bilişim 2020
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->endSection(); ?>
