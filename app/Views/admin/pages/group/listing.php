<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Sidebar', 'group_listing') ?></h1>
                <div class="section-header-breadcrumb">
                    <a href="<?= base_url(route_to('admin_group_create')); ?>" class="btn btn-primary" style="margin-right: 7px"><i class="fas fa-plus"></i> <?= cve_admin_lang('Sidebar', 'group_create') ?></a>
                        <?php if(service('request')->uri->getSegment(5) != 'delete'): ?>
                            <a href="<?= base_url(route_to('admin_group_listing', '/delete')); ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i> <?= cve_admin_lang('Buttons', 'trash_box') ?></a>
                        <?php else: ?>
                            <a href="<?= base_url(route_to('admin_group_listing', null)); ?>" class="btn btn-success"><i class="fas fa-check"></i> <?= cve_admin_lang('Buttons', 'all_records') ?></a>
                        <?php endif; ?>
                </div>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card author-box card-primary">
                            <div class="card-body">
                                <div class="float-left">
                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= cve_admin_lang('Buttons', 'action') ?>
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <?php if(service('request')->uri->getSegment(5) != 'delete'): ?>
                                                <a class="dropdown-item all-delete" href="javascript:void(0)" data-url="<?= base_url(route_to('admin_group_delete')) ?>"><?= cve_admin_lang('Buttons', 'delete') ?></a>
                                            <?php else: ?>
                                                <a class="dropdown-item all-undo-delete" href="javascript:void(0)" data-url="<?= base_url(route_to('admin_group_undo_delete')) ?>"><?= cve_admin_lang('Buttons', 'undo_delete') ?></a>
                                                <a class="dropdown-item all-purge-delete" href="javascript:void(0)" data-url="<?= base_url(route_to('admin_group_purge_delete')) ?>"><?= cve_admin_lang('Buttons', 'purge_delete') ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <form action="<?= current_url(); ?>" method="GET">
                                        <div class="input-group">
                                            <input name="search" type="text" class="form-control" placeholder="<?= cve_admin_lang('Inputs', 'search') ?>...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table table-striped custom-table">
                                        <tr>
                                            <th class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th><?= cve_admin_lang('TableHeaders', 'slug') ?></th>
                                            <th><?= cve_admin_lang('TableHeaders', 'group_title') ?></th>
                                            <?php if(service('request')->uri->getSegment(5) != 'delete'): ?>
                                                <th><?= cve_admin_lang('General', 'created_at') ?></th>
                                            <?php else: ?>
                                                <th><?= cve_admin_lang('General', 'deleted_at') ?></th>
                                            <?php endif; ?>
                                            <th><?= cve_admin_lang('Buttons', 'action') ?></th>
                                        </tr>
                                        <?php foreach ($groups as $group): ?>
                                            <tr data-id="<?= $group->id ?>">
                                                <td class="p-0 text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input data-id="<?= $group->id ?>" type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-<?= $group->id ?>">
                                                        <label for="checkbox-<?= $group->id ?>" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td><?= $group->getSlug(); ?></td>
                                                <td><?= $group->getTitle(); ?></td>
                                                <?php if(service('request')->uri->getSegment(5) != 'delete'): ?>
                                                    <td><?= $group->getCreatedAt(); ?></td>
                                                <?php else: ?>
                                                    <td><?= $group->getDeletedAt(); ?></td>
                                                <?php endif; ?>
                                                <td>
                                                    <?php if($group->getDeletedAt()):  ?>
                                                        <button data-url="<?= base_url(route_to('admin_group_undo_delete')) ?>" class="btn btn-icon btn-success undo-delete"><i class="fas fa-trash-restore"></i></button>
                                                    <?php else:  ?>
                                                        <a href="<?= base_url(route_to('admin_group_edit', $group->id)) ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                                        <button data-url="<?= base_url(route_to('admin_group_delete')) ?>" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                                                    <?php endif;  ?>
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