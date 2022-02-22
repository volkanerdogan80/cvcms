<div class="modal-header">
    <h5 class="modal-title"><?= cve_admin_lang('Comments', 'reply_comment') ?></h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body comment-modal">
    <input type="hidden" value="<?= $comment->id ?>" id="comment_id">
    <div class="form-group">
        <label class="col-form-label"><?= cve_admin_lang('Comments', 'your_comment') ?></label>
        <textarea id="reply" class="form-control" style="height: 200px"></textarea>
    </div>
    <div id="accordion">
        <div class="accordion">
            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#comment-body" aria-expanded="true">
                <h4><i class="fas fa-bars"></i></h4>
            </div>
            <div class="accordion-body collapse show" id="comment-body" data-parent="#accordion">
                <p class="mb-0">
                <blockquote class="blockquote">
                    <p class="mb-0"><?= $comment->getComment() ?></p>
                    <hr>
                    <footer class="blockquote-footer"><?= cve_admin_lang('Comments', 'commenter') ?>: <cite title="Comment Owner"><strong> <?= $comment->getName() ?></strong> </cite></footer>
                </blockquote>

                </p>
            </div>
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-primary btn-block comment-reply-send" data-url="<?= base_url(route_to('admin_comment_reply')) ?>" ><?= cve_admin_lang('Buttons', 'send') ?></button>
</div>


