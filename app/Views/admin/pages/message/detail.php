<div class="tickets">
    <div class="ticket-content">
        <div class="ticket-header">
            <div class="ticket-sender-picture img-shadow">
                <img src="<?= base_url(PUBLIC_ADMIN_IMAGE_PATH . 'avatar/avatar-5.png') ?>" alt="image">
            </div>
            <div class="ticket-detail">
                <div class="ticket-title">
                    <h4><?= $message->getSubject(); ?></h4>
                </div>
                <div class="ticket-info">
                    <div class="font-weight-600"><?= $message->getName(); ?></div>
                    <div class="bullet"></div>
                    <div class="font-weight-600"><?= $message->getEmail(); ?></div>
                    <div class="bullet"></div>
                    <div class="font-weight-600"><?= $message->getPhone(); ?></div>
                    <div class="bullet"></div>
                    <div class="font-weight-600"><?= $message->getWeb(); ?></div>
                    <div class="bullet"></div>
                    <div class="text-primary font-weight-600"><?= $message->getCreatedAt(true); ?></div>
                </div>
            </div>
        </div>
        <div class="ticket-description">
            <p><?= $message->getMessage(); ?></p>

            <div class="ticket-divider"></div>

            <?php if ($message->getReply()): ?>
                <?php foreach ($message->getReply() as $reply): ?>
                    <div class="ticket-header">
                        <div class="ticket-sender-picture img-shadow">
                            <img src="<?= base_url(PUBLIC_ADMIN_IMAGE_PATH . 'avatar/avatar-1.png') ?>" alt="image">
                        </div>
                        <div class="ticket-detail">
                            <div class="ticket-title">
                                <h4><?= $reply->getSubject(); ?></h4>
                            </div>
                            <div class="ticket-info">
                                <div class="font-weight-600"><?= $reply->getName(); ?></div>
                                <div class="bullet"></div>
                                <div class="font-weight-600"><?= $reply->getEmail(); ?></div>
                                <div class="bullet"></div>
                                <div class="font-weight-600"><?= $reply->getPhone(); ?></div>
                                <div class="bullet"></div>
                                <div class="font-weight-600"><?= $reply->getWeb(); ?></div>
                                <div class="bullet"></div>
                                <div class="text-primary font-weight-600"><?= $reply->getCreatedAt(true); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="ticket-description">
                        <p><?= $reply->getMessage(); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="ticket-form">
                <div class="form-group">
                    <textarea class="form-control reply-message ckedtor" id="replyTextarea" style="height: 200px" placeholder="Lütfen Cevabınızı yazın."></textarea>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        Mesaj uzunluğu en az 20 karakterden oluşmalıdır. Aksi taktirde gönderemezsiniz.
                    </div>
                    <div class="col-md-4">
                        <div class="form-group text-right">
                            <button data-id="<?= $message->id; ?>"
                                    data-refresh="<?= base_url(route_to('admin_message_detail')); ?>"
                                    data-url="<?= base_url(route_to('admin_message_reply')); ?>"
                                    class="btn btn-primary btn-lg message-send"
                            >
                                Gönder
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    CKEDITOR.replace( 'replyTextarea', {
        height: 150,
        filebrowserUploadUrl: "<?= base_url(route_to('admin_image_upload')); ?>"
    });
</script>