<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= lang('Groups.text.title'); ?></h1>
                <div class="section-header-breadcrumb">
                    <a href="<?= base_url(route_to('admin_group_create')); ?>" class="btn btn-primary" style="margin-right: 7px"><?= lang('Groups.text.new_group_create'); ?></a>
                        <?php if(service('request')->uri->getSegment(5) != 'delete'): ?>
                            <a href="<?= base_url(route_to('admin_group_listing', '/delete')); ?>" class="btn btn-danger"><?= lang('Groups.text.deleted_list_btn'); ?></a>
                        <?php else: ?>
                            <a href="<?= base_url(route_to('admin_group_listing', null)); ?>" class="btn btn-success"><?= lang('Groups.text.active_list_btn'); ?></a>
                        <?php endif; ?>
                </div>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-left">
                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= lang('Groups.text.action'); ?>
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <?php if(service('request')->uri->getSegment(5) != 'delete'): ?>
                                                <a class="dropdown-item all-delete" href="javascript:void(0)" data-url="<?= base_url(route_to('admin_group_delete')) ?>"><?= lang('Groups.text.delete_btn'); ?></a>
                                            <?php else: ?>
                                                <a class="dropdown-item all-undo-delete" href="javascript:void(0)" data-url="<?= base_url(route_to('admin_group_undo_delete')) ?>"><?= lang('Groups.text.undo_delete_btn'); ?></a>
                                                <a class="dropdown-item all-purge-delete" href="javascript:void(0)" data-url="<?= base_url(route_to('admin_group_purge_delete')) ?>"><?= lang('Groups.text.purge_delete_btn'); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <form action="<?= current_url(); ?>" method="GET">
                                        <div class="input-group">
                                            <input name="search" type="text" class="form-control" placeholder="Search">
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
                                            <th><?= lang('Groups.text.table_slug'); ?></th>
                                            <th><?= lang('Groups.text.group_name'); ?></th>
                                            <?php if(service('request')->uri->getSegment(5) != 'delete'): ?>
                                                <th><?= lang('Groups.text.created_at'); ?></th>
                                            <?php else: ?>
                                                <th><?= lang('Groups.text.deleted_at'); ?></th>
                                            <?php endif; ?>
                                            <th><?= lang('Groups.text.action'); ?></th>
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