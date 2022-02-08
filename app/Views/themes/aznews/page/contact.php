<!-- İletişim Sayfası Şablonu -->

<?php $this->extend('themes/aznews/layout/main'); ?>

<?php $this->section('content'); ?>

<section class="contact-section">
    <div class="container">
        <div class="d-none d-sm-block mb-5 pb-4">
            <div id="map" style="height: 480px; width: 100%; position: relative; overflow: hidden;">
                <?= config('contact')->offices['office']['map']; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Get in Touch</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="<?= base_url(route_to('message_send')); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" type="text" placeholder="Konu Başlığı" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" placeholder="Mesajını yazın" required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="name" id="name" type="text" placeholder="Adınız Soyadınız" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="email" id="email" type="email" placeholder="Eposta Adresiniz" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm boxed-btn">Gönder</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3><?= config('contact')->offices['office']['name']; ?></h3>
                        <p><?= config('contact')->offices['office']['address']; ?></p>
                    </div>
                </div>
                <?php foreach (config('contact')->offices['office']['phones'] as $phone): ?>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3><?= $phone['name']; ?></h3>
                            <p><?= $phone['number']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php foreach (config('contact')->offices['office']['emails'] as $email): ?>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3><?= $email['name']; ?></h3>
                            <p><?= $email['email']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php $this->endSection(); ?>
