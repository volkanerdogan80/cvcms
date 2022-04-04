<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Componentler</h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                                    <?php foreach ($components as $key => $value):  ?>
                                        <?php $key = str_replace('\\', '', $key); ?>
                                        <?php $component = include COMPONENTS_PATH . $key . '/info.php'; ?>
                                        <li class="media">
                                            <div class="media-body">
                                                <div style="<?= $value['status'] == STATUS_PASSIVE ? 'display: none': ''; ?>" class="media-right">
                                                    <div class="text-success">Aktif</div>
                                                </div>
                                                <div style="<?= $value['status'] == STATUS_PASSIVE ? '': 'display: none'; ?>" class="media-right">
                                                    <div class="text-danger">Pasif</div>
                                                </div>

                                                <div class="media-title mb-1"><?= $component['name']; ?></div>
                                                <div class="media-links" style="margin-bottom: 15px">
                                                    <a><?= $component['author']; ?></a>
                                                    <div class="bullet"></div>
                                                    <a><?= $component['email']; ?></a>
                                                    <div class="bullet"></div>
                                                    <a><?= $component['web']; ?></a>
                                                </div>
                                                <div class="media-description text-muted"><?= $component['description']; ?></div>
                                                <div class="media-links">
                                                    <a style="<?= $value['status'] == STATUS_PASSIVE ? '': 'display: none'; ?>" href="<?= base_url(route_to('admin_component_active', $key)); ?>">Aktifleştir</a>
                                                    <div style="<?= $value['status'] == STATUS_PASSIVE ? '': 'display: none'; ?>" class="bullet"></div>
                                                    <a style="<?= $value['status'] == STATUS_PASSIVE ? 'display: none': ''; ?>" href="<?= base_url(route_to('admin_component_passive', $key)); ?>">Pasifleştir</a>
                                                    <div style="<?= $value['status'] == STATUS_PASSIVE ? 'display: none': ''; ?>" class="bullet"></div>
                                                    <a href="<?= base_url(route_to('admin_component_setting', $key)); ?>">Ayarlar</a>
                                                    <div class="bullet"></div>
                                                    <a href="<?= base_url(route_to('admin_component_delete', $key)); ?>" class="text-danger">Sil</a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>