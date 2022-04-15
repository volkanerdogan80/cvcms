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
                    [
                        'checkbox' => [
                            'name' => 'test',
                            'value' => 'kayitli-kullanicilar',
                            'options' => [
                                'ajax' => base_url(route_to('admin_group_listing', null)),
                                'item' => 'groups',
                                'value' => 'slug',
                                'title' => 'title'
                            ]
                        ]
                    ]
                ]); ?>

            </div>
        </section>
    </div>
<?php $this->endSection(); ?>