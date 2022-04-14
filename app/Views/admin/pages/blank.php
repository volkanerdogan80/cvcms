<?php $this->extend(PANEL_FOLDER. '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Boş Sayfa</h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <?= admin_form_group_row([
                    'label' => 'test',
                    'tags' => [
                        'name' => 'status_1',
                        'required' => true,
                    ]
                ]); ?>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>