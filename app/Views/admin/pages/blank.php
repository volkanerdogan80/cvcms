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

                <?= admin_row_input([
                    'label' => [
                        'title' => 'Array Label',
                        'class' => 'col-md-8',
                        'id' => 'Array Label',
                        'style' => 'Array Label',
                        'data' => [
                                'data' => 'Data'
                        ],
                        'extra' => [
                                'extra' => 'Extra'
                        ],
                    ],
                    'input' => [
                        'type' => 'Array Input',
                        'name' => 'array_test',
                        'value' => 'array_test value',
                        'class' => 'array_test-class array_test-class-2',
                        'id' => 'array_test-id',
                        'style' => 'width:50%',
                        'placeholder' => 'Array Test Placeholder',
                        'required' => true,
                        'data' => [
                            'login' => base_url(route_to('admin_login')),
                            'register' => base_url(route_to('admin_register'))
                        ],
                        'extra' => [
                            'maxlength' => 3
                        ]
                    ]
                ]);
                ?>
                <?= admin_row_input([
                    'label' => 'String Label',
                    'input' => 'String Input'
                ]);
                ?>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>