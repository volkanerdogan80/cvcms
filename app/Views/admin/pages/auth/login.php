<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>

    <section class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="p-4 m-3">
                    <img src="<?= base_url('public/admin/img/stisla-fill.svg') ?>" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
                    <h4 class="text-dark font-weight-normal"><?= cve_admin_lang('Auth', 'welcome') ?></h4>
                    <p class="text-muted"><?= cve_admin_lang('Auth', 'start') ?></p>

                    <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

                    <?php if(!config('system')->login): ?>
                        <div class="alert alert-warning alert-has-icon">
                            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                            <div class="alert-body">
                                <div class="alert-title"><?= cve_admin_lang('Auth', 'informing') ?></div>
                                <?= cve_admin_lang('errors', 'login_system_passive') ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= base_url(route_to('admin_login')); ?>" class="needs-validation" novalidate="">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="email"><?= cve_admin_lang('Inputs', 'email') ?></label>
                            <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label"><?= cve_admin_lang('Inputs', 'password') ?></label>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                        </div>
                        <?php if(config('webmaster')->reCaptchaKey): ?>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6Let_eIZAAAAABwHW3sQsCjvnFVHj7uBK6tkUmiy"></div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group text-right">
                            <a href="<?= base_url(route_to('admin_forgot_password')); ?>" class="float-left mt-3">
                                <?= cve_admin_lang('Auth', 'forgot_password') ?>
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                <?= cve_admin_lang('Auth', 'login') ?>
                            </button>
                        </div>

                        <div class="mt-5 text-center">
                            <?= cve_admin_lang('Auth', 'no_account') ?>
                            <a href="<?= base_url(route_to('admin_register')); ?>"><?= cve_admin_lang('Auth', 'create_account') ?></a>
                        </div>
                    </form>

                    <div class="text-center mt-5 text-small">
                        Copyright &copy; CMS. Made with 💙 by CV Mühendislik
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?= base_url('public/admin/img/unsplash/login-bg.jpg'); ?>">
                <div class="absolute-bottom-left index-2">
                    <div class="text-light p-5 pb-2">
                        <div class="mb-5 pb-3">
                            <?php if ($time->getHour() > 5 && $time->getHour() <= 11){ ?>
                                <h1 class="mb-2 display-4 font-weight-bold"><?= cve_admin_lang('Auth', 'good_morning') ?></h1>
                            <?php }elseif($time->getHour() > 11 && $time->getHour() <= 16){ ?>
                                <h1 class="mb-2 display-4 font-weight-bold"><?= cve_admin_lang('Auth', 'good_afternoon') ?></h1>
                            <?php }elseif($time->getHour() > 16 && $time->getHour() <= 22){ ?>
                                <h1 class="mb-2 display-4 font-weight-bold"><?= cve_admin_lang('Auth', 'good_evening') ?></h1>
                            <?php }else{ ?>
                                <h1 class="mb-2 display-4 font-weight-bold"><?= cve_admin_lang('Auth', 'goodnight') ?></h1>
                            <?php } ?>

                            <h5 class="font-weight-normal text-muted-transparent"><?= $time; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->endSection(); ?>