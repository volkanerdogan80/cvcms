<div class="col-12 col-md-8 col-lg-8">
    <div class="card">
        <div class="card-body">
            <address>
                <strong>Türü:</strong>
                <!-- TODO: Daha kısa bir yol bulunabilir. getCategories() içinde array durumuna göre kontrol yaptırılabilir mesela -->
                <?php foreach($content->getCategories() as $category): ?>
                    <?= cve_cat_title($category) ?>
                <?php endforeach; ?>
            </address>
            <address>
                <strong>Açıklama:</strong>
                <?= $content->getContent() ?>
            </address>
            <address>
                <strong>Notlar:</strong><br>
                <?= $content->getDescription() ?>
            </address>
            <address>
                <strong>Etiketler:</strong>
                <input name="" value="<?= $content->getKeywords(); ?>" type="text" class="form-control inputtags">
            </address>
            <?php foreach($content->getAllField() as $key => $value): ?>
            <address>
                <strong><?= $key ?>:</strong>
                <?= is_object($value) ? cve_lang_data($value) : $value ?>
            </address>
            <?php endforeach; ?>
            <hr>
            <form action="<?= current_url(); ?>" method="post">
                <?= csrf_field();  ?>
                <div class="form-group">
                    <label class="col-form-label"> <?= cve_admin_lang('Inputs', 'comment'); ?></label>
                    <textarea name="comment" class="form-control ckedtor" id="comment" style="height: 150px"></textarea>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary btn-lg"><?= cve_admin_lang('Buttons', 'send'); ?></button>
                </div>
            </form>
            <?= $this->include(cve_module_view('Report','detail/comments')); ?>
            <?= $this->include(cve_module_view('Report','detail/gallery')); ?>
        </div>
    </div>
</div>

