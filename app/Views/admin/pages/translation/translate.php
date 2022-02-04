<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= cve_admin_lang_path('Translation', 'translate_page_title'); ?></h1>
        </div>

        <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

        <div class="section-body">
            <form action="<?= current_url(); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label><?= cve_admin_lang_path('Inputs', 'title'); ?></label>
                            <textarea class="form-control" name="translate[title]" style="height: 60px;"><?= $strings['title']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label><?= cve_admin_lang_path('Inputs', 'description'); ?></label>
                            <textarea class="form-control" name="translate[description]" style="height: 60px;"><?= $strings['description']; ?></textarea>
                        </div>
                        <?php foreach ($strings['text'] as $key => $value): ?>
                            <div class="form-group">
                                <label><?= $key ?></label>
                                <textarea class="form-control" name="translate[text][<?= $key ?>]" style="height: 60px;"><?= $value ?></textarea>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang_path('Buttons', 'update'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<?php $this->endSection(); ?>
