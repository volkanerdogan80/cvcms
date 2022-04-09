<?php $this->extend(PANEL_FOLDER. '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Boş Sayfa</h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <?= admin_input([
                    [
                        'type' => 'text',
                        'name' => 'test',
                        'value' => 'test value',
                        'class' => 'test-class test-class-2 mb-2',
                        'id' => 'test-id',
                        'style' => 'width:50%',
                        'placeholder' => 'Test Placeholder',
                        'required' => true,
                        'data' => [
                            'login' => base_url(route_to('admin_login')),
                            'register' => base_url(route_to('admin_register'))
                        ],
                        'extra' => [
                            'maxlength' => 3
                        ]
                    ],
                    [
                        'type' => 'text',
                        'name' => 'test',
                        'value' => 'test value',
                        'class' => 'test-class test-class-2',
                        'id' => 'test-id',
                        'style' => 'width:50%',
                        'placeholder' => 'Test Placeholder',
                        'required' => true,
                        'data' => [
                            'login' => base_url(route_to('admin_login')),
                            'register' => base_url(route_to('admin_register'))
                        ],
                        'extra' => [
                            'maxlength' => 3
                        ]
                    ],
                    [
                        'type' => 'text',
                        'name' => 'test',
                        'value' => 'test value',
                        'class' => 'test-class test-class-2',
                        'id' => 'test-id',
                        'style' => 'width:50%',
                        'placeholder' => 'Test Placeholder',
                        'required' => true,
                        'data' => [
                            'login' => base_url(route_to('admin_login')),
                            'register' => base_url(route_to('admin_register'))
                        ],
                        'extra' => [
                            'maxlength' => 3
                        ]
                    ]
                ]); ?>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>