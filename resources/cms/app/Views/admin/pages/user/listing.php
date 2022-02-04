<?php $this->extend('admin/layout/main'); ?>

<?php $segment = service('request')->uri->getSegment(5); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= lang('Users.text.title') ?></h1>

                <div class="section-header-breadcrumb">
                    <a href="<?= base_url(route_to('admin_user_create')); ?>" class="btn btn-primary">
                        <?= lang('Users.text.create'); ?>
                    </a>
                </div>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link <?= empty($segment) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_user_listing', null)) ?>">
                                    <?= lang('Users.text.all') ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $segment == strtolower(STATUS_ACTIVE) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_user_listing', '/active')) ?>">
                                    <?= lang('Users.text.active') ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $segment == strtolower(STATUS_PENDING) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_user_listing', '/pending')) ?>">
                                    <?= lang('Users.text.pending') ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $segment == strtolower(STATUS_PASSIVE) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_user_listing', '/passive')) ?>">
                                    <?= lang('Users.text.passive') ?>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?= $segment == 'deleted' ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_user_listing', '/deleted')) ?>">
                                    <?= lang('Users.text.deleted') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= current_url(); ?>">
                            <div class="float-left">
                                <div class="row ml-3">
                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= lang('Users.text.action') ?>
                                        </button>
                                        <div class="dropdown-menu">
                                            <?php if ($segment != 'deleted'): ?>
                                                <a class="dropdown-item all-delete" href="javascript:void(0)" data-url="<?= base_url(route_to('admin_user_delete')); ?>"><?= lang('Users.text.delete') ?></a>
                                                <a class="dropdown-item all-status-change" data-status="<?= STATUS_ACTIVE ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= lang('Users.text.active_select') ?></a>
                                                <a class="dropdown-item all-status-change" data-status="<?= STATUS_PASSIVE ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= lang('Users.text.passive_select') ?></a>
                                                <a class="dropdown-item all-status-change" data-status="<?= STATUS_PENDING ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= lang('Users.text.pending_select') ?></a>
                                            <?php else: ?>
                                                <a class="dropdown-item all-undo-delete" data-url="<?= base_url(route_to('admin_user_undo_delete')); ?>" href="javascript:void(0)"><?= lang('Users.text.undo_delete') ?></a>
                                                <a class="dropdown-item all-purge-delete" data-url="<?= base_url(route_to('admin_user_purge_delete')); ?>" href="javascript:void(0)"><?= lang('Users.text.purge_delete') ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <select name="perpage" class="form-control">
                                            <option value=""><?= lang('Users.text.per_page_select') ?></option>
                                            <?php foreach (config('system')->perPageList as $per): ?>
                                                <option value="<?= $per ?>"><?= $per ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group ml-2">
                                        <select name="group" class="form-control">
                                            <option value=""><?= lang('Input.text.group_select') ?></option>
                                            <?php foreach ($groups as $group): ?>
                                                <option value="<?= $group->id; ?>"><?= $group->getTitle(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="row">
                                    <div class="input-group col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input value="<?= $dateFilter ?>" name="dateFilter" placeholder="<?= lang('Users.text.date_filter_placeholder') ?>" type="text" class="form-control daterange-cus">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-light date_filter_clear"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group col">
                                        <input value="<?= $search ?>" name="search" type="text" class="form-control" placeholder="<?= lang('Users.text.search') ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix mb-3"></div>

                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <tr>
                                    <th class="pt-2">
                                        <div class="custom-checkbox custom-checkbox-table custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th><?= lang('Input.text.full_name') ?></th>
                                    <th><?= lang('Input.text.email') ?></th>
                                    <th><?= lang('Users.text.group_name') ?></th>
                                    <th><?= lang('Users.text.created_at') ?></th>
                                    <th><?= lang('Users.text.status') ?></th>
                                </tr>
                                <?php foreach ($users as $key => $user): ?>
                                    <tr data-id="<?= $user->id; ?>">
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input data-id="<?= $user->id ?>" type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-<?= $user->id ?>">
                                                <label for="checkbox-<?= $user->id ?>" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><?= $user->getFullName(); ?>
                                            <?php if ($segment == 'deleted'): ?>
                                                <div class="table-links">
                                                    <div class="bullet"></div>
                                                    <a data-url="<?= base_url(route_to('admin_user_undo_delete')); ?>" class="text-success undo-delete" href="javascript:void(0)"><?= lang('Users.text.undo_delete') ?></a>
                                                    <div class="bullet"></div>
                                                    <a class="text-danger purge-delete" data-url="<?= base_url(route_to('admin_user_purge_delete')); ?>" href="javascript:void(0)"><?= lang('Users.text.purge_delete') ?></a>
                                                </div>
                                            <?php else: ?>
                                                <div class="table-links">
                                                    <div class="bullet"></div>
                                                    <a href="<?= base_url(route_to('admin_user_edit', $user->id)) ?>"><?= lang('Users.text.edit') ?></a>
                                                    <div class="bullet"></div>
                                                    <div class="dropdown d-inline mr-2">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <?= lang('Users.text.status_change') ?>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item status-change" data-status="<?= STATUS_ACTIVE ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= lang('Users.text.active_select') ?></a>
                                                            <a class="dropdown-item status-change" data-status="<?= STATUS_PASSIVE ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= lang('Users.text.passive_select') ?></a>
                                                            <a class="dropdown-item status-change" data-status="<?= STATUS_PENDING ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= lang('Users.text.pending_select') ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="bullet"></div>
                                                    <a data-url="<?= base_url(route_to('admin_user_delete')); ?>" href="javascript:void(0)" class="text-danger delete"><?= lang('Users.text.delete') ?></a>
                                                </div>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?= $user->getEmail(); ?>
                                        </td>
                                        <td>
                                            <?= $user->withGroup()->getTitle(); ?>
                                        </td>
                                        <td>
                                            <?= $user->getCreatedAt(); ?>
                                        </td>
                                        <td>
                                            <div style="<?= $user->getStatus() != STATUS_ACTIVE ? 'display: none' : '' ?>" class="badge badge-status badge-status-active badge-success"><?= lang('Users.text.active') ?></div>
                                            <div style="<?= $user->getStatus() != STATUS_PASSIVE ? 'display: none' : '' ?>" class="badge badge-status badge-status-passive badge-danger"><?= lang('Users.text.passive') ?></div>
                                            <div style="<?= $user->getStatus() != STATUS_PENDING ? 'display: none' : '' ?>" class="badge badge-status badge-status-pending badge-warning"><?= lang('Users.text.pending') ?></div>
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
        </section>
    </div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
    <script>
        $("input[name=dateFilter]").val('<?= $dateFilter?>');
        $("select[name=perPage]").val('<?= $perPage?>');
    </script>
<?php $this->endSection(); ?>