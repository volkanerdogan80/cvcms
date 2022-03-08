<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $segment = service('request')->uri->getSegment(5); ?>

<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= cve_admin_lang('Sidebar','slider_listing'); ?></h1>
            <div class="section-header-breadcrumb">
                <?php if(service('request')->uri->getSegment(5) != 'deleted'): ?>
                    <a href="<?= base_url(route_to('admin_slider_listing', '/deleted')); ?>" class="btn btn-danger">
                        <?= cve_admin_lang('Buttons','trash_box'); ?>
                    </a>
                <?php else: ?>
                    <a href="<?= base_url(route_to('admin_slider_listing', null)); ?>" class="btn btn-success">
                        <?= cve_admin_lang('Buttons','all'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="<?= base_url(route_to('admin_slider_create')); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <?= cve_admin_lang('Sidebar','slider_create'); ?>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="col-form-label">
                                        <?= cve_admin_lang('Inputs','slider_title'); ?>
                                    </label>
                                    <input name="name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success btn-block btn-lg">
                                    <?= cve_admin_lang('Buttons','save'); ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang('Sidebar','sliders'); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <tr>
                                        <th><?= cve_admin_lang('TableHeaders','slider_title'); ?></th>
                                        <th><?= cve_admin_lang('General','created_at'); ?></th>
                                    </tr>
                                    <?php foreach ($sliders as $key => $slider): ?>
                                        <tr data-id="<?= $slider->id; ?>">
                                            <td><?= $slider->getKey(); ?>
                                                <?php if ($segment == 'deleted'): ?>
                                                    <div class="table-links">
                                                        <div class="bullet"></div>
                                                        <a data-url="<?= base_url(route_to('admin_slider_undo_delete')); ?>"
                                                           class="text-success undo-delete" href="javascript:void(0)">
                                                            <?= cve_admin_lang('Buttons','undo_delete'); ?>
                                                        </a>

                                                        <div class="bullet"></div>
                                                        <a data-url="<?= base_url(route_to('admin_slider_purge_delete')); ?>"
                                                           class="text-danger purge-delete"
                                                           href="javascript:void(0)">
                                                            <?= cve_admin_lang('Buttons','purge_delete'); ?>
                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="table-links">
                                                        <div class="bullet"></div>
                                                        <a href="<?= base_url(route_to('admin_slider_edit', $slider->id)); ?>">
                                                            <?= cve_admin_lang('Buttons','edit'); ?>
                                                        </a>

                                                        <div class="bullet"></div>
                                                        <a data-url="<?= base_url(route_to('admin_slider_delete')); ?>"
                                                           href="javascript:void(0)"
                                                           class="text-danger delete">
                                                            <?= cve_admin_lang('Buttons','delete'); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?= $slider->getCreatedAt(); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <?= $pager->links('default', 'cms_pager'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->endSection(); ?>
