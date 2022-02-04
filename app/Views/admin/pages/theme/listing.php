<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('Sidebar', 'themes'); ?></h1>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <?php foreach ($themes as $key => $value): ?>
                        <?php $key = str_replace('\\', '', $key); ?>
                        <?php $theme = include APPPATH . 'Views/themes/' . $key . '/info.php'; ?>
                        <div class="col-12 col-md-4 col-lg-4">
                            <article class="article article-style-c">
                                <div class="article-header">
                                    <div class="article-image" data-background="<?= base_url('public/' . $key . '/screenshot.png'); ?>"></div>
                                    <?php if ($key == $active->getFolder()): ?>
                                        <div class="article-badge">
                                            <div class="article-badge-item bg-success">
                                                <i class="fas fa-fire"></i>
                                                <?= cve_admin_lang_path('General', 'active'); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="article-details">
                                    <div class="article-title">
                                        <h2><a href=""><?= $theme['name']; ?></a></h2>
                                    </div>
                                    <p><?= $theme['description'] ?? ''; ?></p>
                                    <div class="article-user">
                                        <img alt="image" src="<?= base_url('public/admin/img/avatar/avatar-1.png') ?>">
                                        <div class="article-user-details">
                                            <div class="user-detail-name">
                                                <a target="_blank" href="<?= $theme['web'] ?? '#'; ?>">
                                                    <?= $theme['author'] ?? ''; ?>
                                                </a>
                                            </div>
                                            <div class="text-job"><?= $theme['email'] ?? ''; ?></div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <?php if ($key == $active->getFolder()): ?>
                                            <div class="col-md-6">
                                                <a href="<?= base_url(route_to('admin_theme_setting')); ?>" class="btn btn-success btn-icon icon-left btn-block">
                                                    <i class="fas fa-tools"></i> <?= cve_admin_lang_path('Buttons', 'settings'); ?>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="<?= base_url(route_to('admin_theme_delete', $key)); ?>" class="btn btn-danger btn-icon icon-left  btn-block">
                                                    <i class="fas fa-trash"></i> <?= cve_admin_lang_path('Buttons', 'delete'); ?>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-md-6">
                                                <a href="<?= base_url(route_to('admin_theme_active', $key)); ?>" class="btn btn-primary btn-icon icon-left btn-block">
                                                    <i class="fas fa-lock-open"></i> <?= cve_admin_lang_path('Buttons', 'activate'); ?>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="<?= base_url(route_to('admin_theme_delete', $key)); ?>" class="btn btn-danger btn-icon icon-left btn-block">
                                                    <i class="fas fa-trash"></i> <?= cve_admin_lang_path('Buttons', 'delete'); ?>
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