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
                        'label' => cve_admin_lang('Inputs', 'status'),
                        'select' => [
                            'name' => 'status',
                            'required' => true,
                            'options' => [
                                ['value' => STATUS_ACTIVE, 'title' => cve_admin_lang('General', 'active')],
                                ['value' => STATUS_PASSIVE, 'title' => cve_admin_lang('General', 'passive')],
                                ['value' => STATUS_PENDING, 'title' => cve_admin_lang('General', 'pending')]
                            ]
                        ]
                    ],
                    [
                        'label' => cve_admin_lang('Inputs', 'password'),
                        'input' => [
                            'name' => 'password',
                            'type' => 'password',
                            'required' => true
                        ]
                    ]
                ]); ?>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>