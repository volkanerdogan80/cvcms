<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $segment = service('request')->uri->getSegment(5); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Sidebar', 'user_listing') ?></h1>

                <div class="section-header-breadcrumb">
                    <a href="<?= base_url(route_to('admin_user_create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> <?= cve_admin_lang('Sidebar', 'user_create') ?>
                    </a>
                </div>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link <?= empty($segment) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_user_listing', null)) ?>">
                                    <?= cve_admin_lang('Buttons', 'all') ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $segment == strtolower(STATUS_ACTIVE) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_user_listing', '/active')) ?>">
                                    <?= cve_admin_lang('Buttons', 'active') ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $segment == strtolower(STATUS_PENDING) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_user_listing', '/pending')) ?>">
                                    <?= cve_admin_lang('Buttons', 'pending') ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $segment == strtolower(STATUS_PASSIVE) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_user_listing', '/passive')) ?>">
                                    <?= cve_admin_lang('Buttons', 'passive') ?>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?= $segment == 'deleted' ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_user_listing', '/deleted')) ?>">
                                    <?= cve_admin_lang('Buttons', 'trash_box') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card author-box card-primary">
                    <div class="card-body">
                        <form action="<?= current_url(); ?>">
                            <div class="float-left">
                                <div class="row ml-3">
                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= cve_admin_lang('Buttons', 'action') ?>
                                        </button>
                                        <div class="dropdown-menu">
                                            <?php if ($segment != 'deleted'): ?>
                                                <a class="dropdown-item all-delete" href="javascript:void(0)" data-url="<?= base_url(route_to('admin_user_delete')); ?>"><?= cve_admin_lang('Buttons', 'delete') ?></a>
                                                <a class="dropdown-item all-status-change" data-status="<?= STATUS_ACTIVE ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'activate') ?></a>
                                                <a class="dropdown-item all-status-change" data-status="<?= STATUS_PASSIVE ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'passivate') ?></a>
                                                <a class="dropdown-item all-status-change" data-status="<?= STATUS_PENDING ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'standby') ?></a>
                                            <?php else: ?>
                                                <a class="dropdown-item all-undo-delete" data-url="<?= base_url(route_to('admin_user_undo_delete')); ?>" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'undo_delete') ?></a>
                                                <a class="dropdown-item all-purge-delete" data-url="<?= base_url(route_to('admin_user_purge_delete')); ?>" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'purge_delete') ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right mr-2">
                                <div class="row">
                                    <button type="button" class="btn btn-primary btn-lg mr-2" data-toggle="modal" data-target="#filter"><?= cve_admin_lang('Buttons', 'filter') ?></button>
                                    <a href="<?= current_url(); ?>" class="btn btn-primary btn-lg"><?= cve_admin_lang('Buttons', 'clear') ?></a>
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
                                    <th><?= cve_admin_lang('TableHeaders', 'full_name') ?></th>
                                    <th><?= cve_admin_lang('TableHeaders', 'email') ?></th>
                                    <th><?= cve_admin_lang('TableHeaders', 'group_title') ?></th>
                                    <th><?= cve_admin_lang('General', 'created_at') ?></th>
                                    <th><?= cve_admin_lang('General', 'status') ?></th>
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
                                                    <a data-url="<?= base_url(route_to('admin_user_undo_delete')); ?>" class="text-success undo-delete" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'undo_delete') ?></a>
                                                    <div class="bullet"></div>
                                                    <a class="text-danger purge-delete" data-url="<?= base_url(route_to('admin_user_purge_delete')); ?>" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'purge_delete') ?></a>
                                                </div>
                                            <?php else: ?>
                                                <div class="table-links">
                                                    <div class="bullet"></div>
                                                    <a href="<?= base_url(route_to('admin_user_edit', $user->id)) ?>"><?= cve_admin_lang('Buttons', 'edit') ?></a>
                                                    <div class="bullet"></div>
                                                    <div class="dropdown d-inline mr-2">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <?= cve_admin_lang('Buttons', 'change_status') ?>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item status-change" data-status="<?= STATUS_ACTIVE ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'activate') ?></a>
                                                            <a class="dropdown-item status-change" data-status="<?= STATUS_PASSIVE ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'passivate') ?></a>
                                                            <a class="dropdown-item status-change" data-status="<?= STATUS_PENDING ?>" data-url="<?= base_url(route_to('admin_user_status')); ?>" href="javascript:void(0)"><?= cve_admin_lang('Buttons', 'standby') ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="bullet"></div>
                                                    <a data-url="<?= base_url(route_to('admin_user_delete')); ?>" href="javascript:void(0)" class="text-danger delete"><?= cve_admin_lang('Buttons', 'delete') ?></a>
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
                                            <div style="<?= $user->getStatus() != STATUS_ACTIVE ? 'display: none' : '' ?>" class="badge badge-status badge-status-active badge-success"><?= cve_admin_lang('General', 'active') ?></div>
                                            <div style="<?= $user->getStatus() != STATUS_PASSIVE ? 'display: none' : '' ?>" class="badge badge-status badge-status-passive badge-danger"><?= cve_admin_lang('General', 'passive') ?></div>
                                            <div style="<?= $user->getStatus() != STATUS_PENDING ? 'display: none' : '' ?>" class="badge badge-status badge-status-pending badge-warning"><?= cve_admin_lang('General', 'pending') ?></div>
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
    <div id="filter" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= cve_admin_lang('Buttons', 'filter') ?></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?= current_url(); ?>" method="get">
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input value="" name="dateFilter" placeholder="<?= cve_admin_lang('Inputs', 'date_filter') ?>" type="text" class="form-control daterange-cus">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-light date_filter_clear"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="group" class="form-control">
                                        <option value=""><?= cve_admin_lang('Inputs', 'group_select') ?></option>
                                        <?php foreach ($groups as $group): ?>
                                            <option value="<?= $group->id; ?>"><?= $group->getTitle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="per_page"  class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        <option value=""><?= cve_admin_lang('Inputs', 'per_page') ?></option>
                                        <?php foreach (config('system')->perPageList as $per): ?>
                                            <option value="<?= $per ?>"><?= $per ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input value="<?= $search; ?>" name="search" type="text" class="form-control" placeholder="<?= cve_admin_lang('Inputs', 'search') ?>...">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-lg" type="submit"><?= cve_admin_lang('Buttons', 'filter') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
    <script>
        $("input[name=dateFilter]").val('<?= $dateFilter?>');
        $("select[name=perPage]").val('<?= $perPage?>');
    </script>
<?php $this->endSection(); ?>