<div class="col-12 col-md-4 col-lg-4">
    <div class="card">
        <div class="card-body">
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1">
                            Atanan
                        </p>
                        <?= $content->withUser()->getFullName(); ?>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1">Raporu Oluşturan</p>
                        <?= $content->withUser()->getFullName(); ?>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1">Durumu</p>
                        <?= $content->getStatus() ?>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1">Çözüm Durumu</p>
                        Morbi leo risus
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1">Oluşturma Tarihi</p>
                        <?= $content->getCreatedAt(true); ?>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1">Güncelleme Tarihi</p>
                        <?= $content->getUpdatedAt(true); ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
