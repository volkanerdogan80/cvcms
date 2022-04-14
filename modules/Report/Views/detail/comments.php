<ul class="list-unstyled list-unstyled-border list-unstyled-noborder comment-list">
    <?php foreach ($content->withComment() as $comment): ?>
        <li class="media comment-<?= $comment->id ?>" data-id="<?= $comment->id ?>">
            <img alt="image" class="mr-3 rounded-circle" width="70"
                 src="<?= base_url(PUBLIC_ADMIN_IMAGE_PATH . 'avatar/avatar-1.png') ?>">
            <div class="media-body">
                <div class="media-right">
                    <div style="<?= $comment->getStatus() == STATUS_ACTIVE ? '' : 'display: none' ?>"
                         class="text-primary comment-status-active comment-status"><?= lang('General.text.approved') ?></div>
                    <div style="<?= $comment->getStatus() == STATUS_PENDING ? '' : 'display: none' ?>"
                         class="text-warning comment-status-pending comment-status"><?= lang('General.text.pending') ?></div>
                </div>
                <div class="media-title mb-1"><?= $comment->getName() ?></div>
                <div class="text-job text-muted mb-1"><?= $comment->getEmail() ?></div>
                <div class="text-time"><?= $comment->getUpdatedAt(true) ?></div>
                <h2 class="section-title"><?= $comment->withContent()->getTitle() ?></h2>
                <div class="media-description text-muted"><?= $comment->getComment() ?></div>
                <div class="media-links">
                    <a href="javascript:void(0)"
                       class="comment-status-active comment-status comment-reply-show"
                       data-url="<?= base_url(route_to('admin_comment_reply_modal')); ?>"
                       style="<?= $comment->getStatus() == STATUS_ACTIVE ? '' : 'display: none' ?>">
                        <?= lang('General.text.reply') ?>
                    </a>
                    <a href="javascript:void(0)"
                       class="comment-status-change comment-status-pending comment-status"
                       style="<?= $comment->getStatus() == STATUS_PENDING ? '' : 'display: none' ?>"
                       data-status="<?= STATUS_ACTIVE ?>"
                       data-url="<?= base_url(route_to('admin_comment_status')); ?>">
                        <?= lang('General.text.approve') ?>
                    </a>
                    <div class="bullet comment-status-change comment-status-active comment-status"
                         style="<?= $comment->getStatus() == STATUS_ACTIVE ? '' : 'display: none' ?>"></div>
                    <a href="javascript:void(0)"
                       class="comment-status-change comment-status-active comment-status"
                       style="<?= $comment->getStatus() == STATUS_ACTIVE ? '' : 'display: none' ?>"
                       data-status="<?= STATUS_PENDING ?>"
                       data-url="<?= base_url(route_to('admin_comment_status')); ?>">
                        <?= lang('General.text.pending_select') ?>
                    </a>
                    <div class="bullet"></div>
                    <a href="javascript:void(0)" class="text-success comment-edit-show"
                       data-url="<?= base_url(route_to('admin_comment_edit_modal')); ?>">
                        <?= lang('General.text.edit') ?>
                    </a>
                    <div class="bullet"></div>
                    <a href="javascript:void(0)" class="text-danger comment-delete"
                       data-url="<?= base_url(route_to('admin_comment_delete')); ?>">
                        <?= lang('General.text.delete') ?>
                    </a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>







