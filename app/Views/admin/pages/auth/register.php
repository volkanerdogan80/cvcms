<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>

<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="login-brand">
                    <img src="<?= base_url('public/admin/img/stisla-fill.svg') ?>" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                    <div class="card-header"><h4><?= cve_admin_lang_path('Auth', 'register') ?></h4></div>

                    <div class="card-body">
                        <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

                        <?php if(!config('system')->register): ?>
                            <div class="alert alert-warning alert-has-icon">
                                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title"><?= cve_admin_lang_path('Auth', 'informing') ?></div>
                                    <?= cve_admin_lang_path('Errors', 'registry_system_inactive') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?= base_url(route_to('admin_register')); ?>">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="first_name"><?= cve_admin_lang_path('Inputs', 'first_name') ?></label>
                                    <input id="first_name" type="text" class="form-control" name="first_name" autofocus required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="sur_name"><?= cve_admin_lang_path('Inputs', 'last_name') ?></label>
                                    <input id="sur_name" type="text" class="form-control" name="sur_name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email"><?= cve_admin_lang_path('Inputs', 'email') ?></label>
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="password" class="d-block"><?= cve_admin_lang_path('Inputs', 'password') ?></label>
                                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="password2" class="d-block"><?= cve_admin_lang_path('Inputs', 'password2') ?></label>
                                    <input id="password2" type="password" class="form-control" name="password2" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                                            <label class="custom-control-label" for="agree"><?= cve_admin_lang_path('Inputs', 'contract') ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" checked name="newsletter" class="custom-control-input" id="newsletter">
                                            <label class="custom-control-label" for="newsletter"><?= cve_admin_lang_path('Inputs', 'newsletter') ?></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            <?= cve_admin_lang_path('Auth', 'register') ?>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6Let_eIZAAAAABwHW3sQsCjvnFVHj7uBK6tkUmiy"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; CV Bilişim 2020 - <?= date('Y') ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->endSection(); ?>
