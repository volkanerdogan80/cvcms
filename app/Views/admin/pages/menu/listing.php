<?php $this->extend('admin/layout/main'); ?>

<?php $segment = service('request')->uri->getSegment(5); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Sidebar', 'menu_management') ?></h1>
                <div class="section-header-breadcrumb">
                    <?php if(service('request')->uri->getSegment(5) != 'delete'): ?>
                        <a href="<?= base_url(route_to('admin_menu_listing', '/delete')); ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i> <?= cve_admin_lang('Buttons', 'trash_box') ?></a>
                    <?php else: ?>
                        <a href="<?= base_url(route_to('admin_menu_listing', null)); ?>" class="btn btn-success"><i class="fas fa-check"></i> <?= cve_admin_lang('Buttons', 'all_records') ?></a>
                    <?php endif; ?>
                </div>

            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-4">
                        <form action="<?= base_url(route_to('admin_menu_create')); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4><?= cve_admin_lang('TableHeaders', 'menu_create') ?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-form-label"><?= cve_admin_lang('Inputs', 'menu_title') ?></label>
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'save') ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4><?= cve_admin_lang('TableHeaders', 'menus') ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table">
                                            <th><?= cve_admin_lang('TableHeaders', 'menu_title') ?></th>
                                            <th><?= cve_admin_lang('General', 'created_at') ?></th>
                                        </tr>
                                        <?php foreach ($menus as $key => $menu): ?>
                                            <tr data-id="<?= $menu->id; ?>">
                                                <td><?= $menu->getKey(); ?>
                                                    <?php if ($segment == 'delete'): ?>
                                                        <div class="table-links">
                                                            <div class="bullet"></div>
                                                            <a data-url="<?= base_url(route_to('admin_menu_undo_delete')) ?>" class="text-success undo-delete" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'undo_delete') ?></a>
                                                            <div class="bullet"></div>
                                                            <a class="text-danger purge-delete" data-url="<?= base_url(route_to('admin_menu_purge_delete')) ?>" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'purge_delete') ?></a>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="table-links">
                                                            <div class="bullet"></div>
                                                            <a href="<?= base_url(route_to('admin_menu_edit', $menu->id)) ?>"><?= cve_admin_lang('Buttons', 'edit') ?></a>
                                                            <div class="bullet"></div>
                                                            <a data-url="<?= base_url(route_to('admin_menu_delete')) ?>" href="javascript:void(0)" class="text-danger delete"><?= cve_admin_lang('Buttons', 'delete') ?></a>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?= $menu->getCreatedAt(); ?>
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