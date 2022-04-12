<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Sidebar', 'user_create') ?></h1>
            </div>
            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>
            <div class="section-body">
                <form action="<?= current_url(); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <?= admin_row_input([
                                [
                                    'label' => cve_admin_lang('Inputs', 'first_name'),
                                    'input' => [
                                        'name' => 'first_name',
                                        'required' => true
                                    ]
                                ],
                                [
                                    'label' => cve_admin_lang('Inputs', 'last_name'),
                                    'input' => [
                                        'name' => 'sur_name',
                                        'required' => true
                                    ]
                                ],
                                [
                                    'label' => cve_admin_lang('Inputs', 'email'),
                                    'input' => [
                                        'type' => 'email',
                                        'name' => 'email',
                                        'required' => true
                                    ]
                                ],
                                [
                                    'label' => cve_admin_lang('Inputs', 'phone'),
                                    'input' => 'phone'
                                ],
                                [
                                    'label' => cve_admin_lang('Inputs', 'identity'),
                                    'input' => 'identity'
                                ],
                                [
                                    'label' => cve_admin_lang('Inputs', 'password'),
                                    'input' => [
                                        'name' => 'password',
                                        'type' => 'password',
                                        'required' => true
                                    ]
                                ]
                            ]) ?>
                            <?= admin_row_select([
                                [
                                    'label' => cve_admin_lang('Inputs', 'status'),
                                    'select' => [
                                        'name' => 'status',
                                        'required' => true,
                                        'options' => [
                                            ['value' => '', 'title' => cve_admin_lang('Inputs', 'status_select')],
                                            ['value' => STATUS_ACTIVE, 'title' => cve_admin_lang('General', 'active')],
                                            ['value' => STATUS_PASSIVE, 'title' => cve_admin_lang('General', 'passive')],
                                            ['value' => STATUS_PENDING, 'title' => cve_admin_lang('General', 'pending')]
                                        ]
                                    ]
                                ],
                                [
                                    'label' => cve_admin_lang('Inputs', 'group_select'),
                                    'select' => [
                                        'name' => 'group_id',
                                        'required' => true,
                                        'options' => [
                                            'object' => $groups,
                                            'value' => 'id',
                                            'title' => 'title'
                                        ]
                                    ]
                                ],

                                /*[
                                    'label' => cve_admin_lang('Inputs', 'group_select'),
                                    'select' => [
                                        'name' => 'group_id',
                                        'required' => true,
                                        'options' => [
                                            'ajax' => base_url(route_to('admin_group_listing', null)),
                                            'value' => 'id',
                                            'title' => 'title',
                                            'item' => 'groups'
                                        ]
                                    ]
                                ] */

                            ]) ?>
                            <!-- <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?php // cve_admin_lang('Inputs', 'first_name') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="first_name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?php // cve_admin_lang('Inputs', 'last_name') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="sur_name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?php // cve_admin_lang('Inputs', 'email') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="email" type="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">
                                    <?php // cve_admin_lang('Inputs', 'phone'); ?>
                                </label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="phone" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">
                                    <?php // cve_admin_lang('Inputs', 'identity'); ?>
                                </label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="identity" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?php // cve_admin_lang('Inputs', 'password') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <input name="password" type="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('Inputs', 'status') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <select name="status" class="form-control select2" required>
                                        <option value=""><?php // cve_admin_lang('Inputs', 'status_select') ?></option>
                                        <option value="<?php // STATUS_ACTIVE ?>"><?php // cve_admin_lang('Buttons', 'active') ?></option>
                                        <option value="<?php // STATUS_PASSIVE ?>"><?php // cve_admin_lang('Buttons', 'passive') ?></option>
                                        <option value="<?php // STATUS_PENDING ?>"><?php // cve_admin_lang('Buttons', 'pending') ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?php  //cve_admin_lang('Inputs', 'group_select') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <select name="group_id" class="form-control select2" required>
                                        <option value=""><?// cve_admin_lang('Inputs', 'group_select') ?></option>
                                        <?php // foreach ($groups as $group): ?>
                                            <option value="<?php // $group->id; ?>"><?php // $group->getTitle(); ?></option>
                                        <?php // endforeach; ?>
                                    </select>
                                </div>
                            </div>-->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= cve_admin_lang('Inputs', 'bio') ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <textarea name="bio" class="form-control" style="height: 150px"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row " style="justify-content: center">
                                <div class="col-sm-12 col-md-8">
                                    <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'save') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>