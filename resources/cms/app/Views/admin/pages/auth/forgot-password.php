<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>

<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="<?= base_url('public/admin/img/stisla-fill.svg')?>" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                    <div class="card-header"><h4><?= Lang('ForgotPassword.text.title'); ?></h4></div>

                    <div class="card-body">
                        <p class="text-muted"><?= Lang('ForgotPassword.text.content'); ?></p>
                        <form method="POST">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="email"><?= Lang('Input.text.email'); ?></label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                            </div>

                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6Let_eIZAAAAABwHW3sQsCjvnFVHj7uBK6tkUmiy"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    <?= Lang('ForgotPassword.text.button'); ?>
                                </button>
                            </div>
                        </form>
                        <?= $this->include('admin/layout/partials/errors'); ?>
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
