<?php cve_theme_include('inc/head'); ?>
<?php cve_theme_include('inc/header'); ?>
    <section class="page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="<?= cve_route('homepage') ?>">Anasayfa</a></li>
                        <li class="active"><?= cve_post_title() ?></li>
                    </ol>
                    <h1 class="page-title"><?= cve_post_title() ?></h1>
                    <p class="page-subtitle"><?= cve_post_description() ?></p>
                    <?php foreach (config('contact') as $office): ?>
                        <div class="line thin"></div>
                        <div class="page-description">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <h2><strong><?= $office['name'] ?></strong></h2>
                                    <p>
                                        <?= cve_post_content() ?>
                                    </p>
                                    <p>
                                        <?php foreach ($office['phones'] as $phone): ?>
                                            <?= $phone['name'] ?>: <span class="bold"><?= $phone['number'] ?></span> <br>
                                        <?php endforeach; ?>
                                        <?php foreach ($office['emails'] as $email): ?>
                                            <?= $email['name'] ?>: <span class="bold"><?= $email['email'] ?></span> <br>
                                        <?php endforeach; ?>

                                        <br>
                                        <br>
                                        Address: <span class="bold"><?= $office['address'] ?></span>
                                    </p>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <section class="maps">
                                        <?= $office['map'] ?>
                                    </section>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <form class="row contact cve-contact-form" id="contact-form">
                                <?= csrf_field() ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="required"></span></label>
                                        <input type="text" class="form-control" name="name" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="required"></span></label>
                                        <input type="text" class="form-control" name="email" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" class="form-control" name="subject">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Your message <span class="required"></span></label>
                                        <textarea class="form-control" name="message" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php cve_theme_include('inc/footer'); ?>