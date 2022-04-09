<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Sidebar', 'components'); ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="form-group">
                    <input id="component-filter" type="text" class="form-control" placeholder="<?= cve_admin_lang('Inputs', 'search'); ?>">
                </div>
                <div class="row component-list">
                    <?php foreach ($components as $key => $value):  ?>
                        <?php $key = str_replace('\\', '', $key); ?>
                        <?php $component = include COMPONENTS_PATH . $key . '/info.php'; ?>
                        <div class="col-12 col-md-3 col-lg-3 component-item">
                            <article class="article article-style-c" style="height: 400px">
                                <div class="article-header" style="height: 100px">
                                    <div class="article-image" data-background="<?= base_url(PUBLIC_ADMIN_IMAGE_PATH . 'component.png'); ?>"></div>
                                    <?php if ($value['status'] == STATUS_ACTIVE): ?>
                                        <div class="article-badge">
                                            <div class="article-badge-item bg-success">
                                                <i class="fas fa-fire"></i>
                                                <?= cve_admin_lang('General', 'active'); ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="article-badge">
                                            <div class="article-badge-item bg-danger">
                                                <i class="fas fa-fire"></i>
                                                <?= cve_admin_lang('General', 'passive'); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="article-details">
                                    <div class="article-title">
                                        <h2 class="component-title" data-title="<?= $component['name']; ?>"><a href=""><?= $component['name']; ?></a></h2>
                                    </div>
                                    <p style="height: 100px"><?= $component['description'] ?? ''; ?></p>
                                    <div class="article-user">
                                        <img alt="image" src="<?= base_url(PUBLIC_ADMIN_IMAGE_PATH . 'avatar/avatar-1.png') ?>">
                                        <div class="article-user-details">
                                            <div class="user-detail-name">
                                                <a target="_blank" href="<?= $component['web'] ?? '#'; ?>">
                                                    <?= $component['author'] ?? ''; ?>
                                                </a>
                                            </div>
                                            <div class="text-job"><?= $component['email'] ?? ''; ?></div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <?php if ($value['status'] == STATUS_ACTIVE): ?>
                                            <div class="col-md-6">
                                                <a href="<?= base_url(route_to('admin_component_passive', $key)); ?>" class="btn btn-warning btn-block">
                                                    <?= cve_admin_lang('Buttons', 'passivate'); ?>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a style="<?= $value['setting'] == STATUS_PASSIVE ? 'display:none': ''; ?>" href="<?= base_url(route_to('admin_component_setting', $key)); ?>" class="btn btn-primary btn-block">
                                                    <?= cve_admin_lang('Buttons', 'settings'); ?>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-md-6">
                                                <a href="<?= base_url(route_to('admin_component_active', $key)); ?>" class="btn btn-success btn-block">
                                                    <?= cve_admin_lang('Buttons', 'activate'); ?>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="<?= base_url(route_to('admin_component_delete', $key)); ?>" class="btn btn-danger btn-block">
                                                    <?= cve_admin_lang('Buttons', 'delete'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>