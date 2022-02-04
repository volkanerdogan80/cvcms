<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $segment = service('request')->uri->getSegment(5); ?>

<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= cve_admin_lang_path('Sidebar', 'comments') ?></h1>
        </div>

        <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link <?= empty($segment) ? 'active' : '' ?>"
                               href="<?= base_url(route_to('admin_comment_listing', null)) ?>">
                                <?= cve_admin_lang_path('Buttons', 'all') ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $segment == strtolower(STATUS_ACTIVE) ? 'active' : '' ?>"
                               href="<?= base_url(route_to('admin_comment_listing', '/active')) ?>">
                                <?= cve_admin_lang_path('Buttons', 'active') ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $segment == strtolower(STATUS_PENDING) ? 'active' : '' ?>"
                               href="<?= base_url(route_to('admin_comment_listing', '/pending')) ?>">
                                <?= cve_admin_lang_path('Buttons', 'pending') ?>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $segment == 'deleted' ? 'active' : '' ?>"
                               href="<?= base_url(route_to('admin_comment_listing', '/deleted')) ?>">
                                <?= cve_admin_lang_path('Buttons', 'trash_box') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="float-right mr-2">
                        <div class="row">
                            <button type="button" class="btn btn-primary btn-lg mr-2" data-toggle="modal" data-target="#filter"><?= cve_admin_lang_path('Buttons', 'filter') ?></button>
                            <a href="<?= current_url(); ?>" class="btn btn-primary btn-lg"><?= cve_admin_lang_path('Buttons', 'clear') ?></a>
                        </div>
                    </div>
                    <div class="clearfix mb-3"></div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><?= cve_admin_lang_path('Comments', 'comments') ?></h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder comment-list">
                                    <?php foreach ($comments as $comment): ?>
                                        <li class="media comment-<?= $comment->id ?>" data-level="<?= $comment->level; ?>" data-id="<?= $comment->id ?>" style="margin-left: <?= $comment->level*50; ?>px">
                                            <img alt="image" class="mr-3 rounded-circle" width="70" src="<?= base_url('public/admin/img/avatar/avatar-1.png') ?>">
                                            <div class="media-body">
                                                <div class="media-right">
                                                    <div style="<?= $comment->getStatus() == STATUS_ACTIVE ? '' : 'display: none' ?>" class="text-primary comment-status-active comment-status"><?= cve_admin_lang_path('Comments', 'approved') ?></div>
                                                    <div style="<?= $comment->getStatus() == STATUS_PENDING ? '' : 'display: none' ?>" class="text-warning comment-status-pending comment-status"><?= cve_admin_lang_path('Comments', 'pending') ?></div>
                                                </div>
                                                <div class="media-title mb-1"><?= $comment->getName() ?></div>
                                                <div class="text-job text-muted mb-1"><?= $comment->getEmail() ?></div>
                                                <div class="text-time"><?= $comment->getUpdatedAt(true) ?></div>
                                                <h2 class="section-title"><?= $comment->withContent()->getTitle() ?></h2>
                                                <div class="media-description text-muted"><?= $comment->getComment() ?></div>
                                                <?php if ($segment != 'deleted'): ?>
                                                    <div class="media-links">
                                                        <a href="javascript:void(0)"
                                                           class="comment-status-active comment-status comment-reply-show"
                                                           data-url="<?= base_url(route_to('admin_comment_reply_modal')); ?>"
                                                           style="<?= $comment->getStatus() == STATUS_ACTIVE ? '' : 'display: none' ?>">
                                                            <?= cve_admin_lang_path('Buttons', 'reply') ?>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                           class="comment-status-change comment-status-pending comment-status"
                                                           style="<?= $comment->getStatus() == STATUS_PENDING ? '' : 'display: none' ?>"
                                                           data-status="<?= STATUS_ACTIVE ?>"
                                                           data-url="<?= base_url(route_to('admin_comment_status')); ?>">
                                                            <?= cve_admin_lang_path('Buttons', 'approve') ?>
                                                        </a>
                                                        <div class="bullet comment-status-change comment-status-active comment-status" style="<?= $comment->getStatus() == STATUS_ACTIVE ? '' : 'display: none' ?>"></div>
                                                        <a href="javascript:void(0)"
                                                           class="comment-status-change comment-status-active comment-status"
                                                           style="<?= $comment->getStatus() == STATUS_ACTIVE ? '' : 'display: none' ?>"
                                                           data-status="<?= STATUS_PENDING ?>"
                                                           data-url="<?= base_url(route_to('admin_comment_status')); ?>">
                                                            <?= cve_admin_lang_path('Buttons', 'standby') ?>
                                                        </a>
                                                        <div class="bullet"></div>
                                                        <a href="javascript:void(0)" class="text-success comment-edit-show" data-url="<?= base_url(route_to('admin_comment_edit_modal')); ?>">
                                                            <?= cve_admin_lang_path('Buttons', 'edit') ?>
                                                        </a>
                                                        <div class="bullet"></div>
                                                        <a href="javascript:void(0)" class="text-danger comment-delete" data-url="<?= base_url(route_to('admin_comment_delete')); ?>">
                                                            <?= cve_admin_lang_path('Buttons', 'delete') ?>
                                                        </a>
                                                        <div class="w-100 d-sm-none"></div>
                                                        <div class="float-right mt-sm-0 mt-3">
                                                            <a href="#" class="btn">3 Yanıtı Gör <i class="fas fa-chevron-right"></i></a>
                                                        </div>

                                                    </div>
                                                <?php else: ?>
                                                    <div class="media-links">
                                                        <div class="bullet"></div>
                                                        <a href="javascript:void(0)"
                                                           class="text-success comment-undo-delete"
                                                           data-url="<?= base_url(route_to('admin_comment_undo_delete')) ?>">
                                                            <?= cve_admin_lang_path('Buttons', 'undo_delete') ?>
                                                        </a>
                                                        <div class="bullet"></div>
                                                        <a href="javascript:void(0)"
                                                           class="text-danger comment-purge-delete"
                                                           data-url="<?= base_url(route_to('admin_comment_purge_delete')) ?>">
                                                            <?= cve_admin_lang_path('Buttons', 'purge_delete') ?>
                                                        </a>
                                                        <div class="w-100 d-sm-none"></div>
                                                        <div class="float-right mt-sm-0 mt-3">
                                                            <a href="#" class="btn">3 Yanıtı Gör <i class="fas fa-chevron-right"></i></a>
                                                        </div>

                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </li>

                                    <?php endforeach; ?>
                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>

<div id="filter" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= cve_admin_lang_path('Buttons', 'filter') ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= current_url(); ?>" method="get">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="content" class="form-control select2">
                                    <option value=""><?= cve_admin_lang_path('Inputs', 'content_select') ?></option>
                                    <?php foreach ($contents as $value): ?>
                                        <option <?= $content == $value->id ? 'selected': '' ?> value="<?= $value->id ?>"><?= $value->getTitle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input value="" name="dateFilter" placeholder="<?= cve_admin_lang_path('Inputs', 'date_filter') ?>" type="text" class="form-control daterange-cus">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-light date_filter_clear"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input value="<?= $search; ?>" name="search" type="text" class="form-control" placeholder="<?= cve_admin_lang_path('Inputs', 'search') ?>...">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="perpage" class="form-control select2">
                                    <option value=""><?= cve_admin_lang_path('Inputs', 'per_page') ?></option>
                                    <?php foreach (config('system')->perPageList as $per): ?>
                                        <option value="<?= $per ?>"><?= $per ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-lg" type="submit"><?= cve_admin_lang_path('Buttons', 'filter') ?></button>
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
