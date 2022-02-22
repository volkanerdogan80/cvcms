<div id="notification-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= cve_admin_lang('Navbar', 'send_notification'); ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body comment-modal">
                <div class="form-group">
                    <label class="col-form-label"><?= cve_admin_lang('Inputs', 'title'); ?></label>
                    <input id="title" type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label"><?= cve_admin_lang('Inputs', 'message'); ?></label>
                    <textarea id="description" name="description" class="form-control" style="height: 200px" required></textarea>
                </div>
                <div class="form-group">
                    <label class="col-form-label"><?= cve_admin_lang('Inputs', 'notify_link'); ?></label>
                    <input id="click_action" type="text" name="click_action" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary notification_send" data-url="<?= base_url(route_to('admin_firebase_notification_send')) ?>">
                    <?= cve_admin_lang('Buttons', 'send'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
