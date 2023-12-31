<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Menus', 'menu_edit') ?></h1>
                <div class="section-header-breadcrumb">
                    <form action="<?= current_url() ?>" method="post">
                        <?= csrf_field(); ?>
                        <textarea name="menu" id="menu-list-output" style="display: none"></textarea>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input name="name" type="text" class="form-control" value="<?= $data->getKey(); ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit"><?= cve_admin_lang('Buttons', 'update') ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="col-form-label"><?= cve_admin_lang('Inputs', 'type_select') ?></label>
                                    <select name="type" class="form-control selectric menu-type">
                                        <option value="type"><?= cve_admin_lang('Inputs', 'type_select') ?></option>
                                        <option value="category"><?= cve_admin_lang('Inputs', 'category') ?></option>
                                        <option value="content"><?= cve_admin_lang('Inputs', 'content') ?></option>
                                        <option value="static"><?= cve_admin_lang('Inputs', 'fixed') ?></option>
                                        <option value="custom"><?= cve_admin_lang('Inputs', 'custom') ?></option>
                                    </select>
                                </div>
                                <div class="module-area area" style="display: none">
                                    <div class="form-group">
                                        <label class="col-form-label"><?= cve_admin_lang('Inputs', 'module_select') ?></label>
                                        <select data-url="<?= base_url(route_to('admin_menu_select')); ?>" name="module" class="form-control selectric menu-module">
                                            <option value="module"><?= cve_admin_lang('Inputs', 'module_select') ?></option>
                                            <?php foreach (cve_module_list() as $module): ?>
                                                <option value="<?= $module; ?>">
                                                    <?= cve_admin_lang('Modules', strtolower($module)) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="module-select-item area" id="module-category-area" style="display: none">
                                    <div class="form-group">
                                        <label class="col-form-label"><?= cve_admin_lang('Inputs', 'category_select') ?></label>
                                        <select name="category" class="form-control select2 module-category">
                                            <option value="category"><?= cve_admin_lang('Inputs', 'category_select') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="module-select-item area" id="module-content-area" style="display: none">
                                    <div class="form-group">
                                        <label class="col-form-label"><?= cve_admin_lang('Inputs', 'content_select') ?></label>
                                        <select name="content" class="form-control select2 module-content">
                                            <option value="content"><?= cve_admin_lang('Inputs', 'content_select') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="custom-area area" style="display:none;">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <?php foreach (cve_language() as $key => $lang): ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= $key == 0 ? 'active' : ''; ?> "
                                                   id="<?= $lang->getCode(); ?>-tab"
                                                   data-toggle="tab"
                                                   href="#<?= $lang->getCode(); ?>"
                                                   role="tab"
                                                   aria-controls="<?= $lang->getCode(); ?>"
                                                   aria-selected="true">
                                                    <img width="20" src="<?= $lang->getFlag(); ?>">
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <?php foreach (cve_language() as $key => $lang): ?>
                                            <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>" id="<?= $lang->getCode(); ?>" role="tabpanel" aria-labelledby="<?= $lang->getCode(); ?>-tab">
                                                <div class="form-group">
                                                    <label><?= $lang->getTitle(); ?> <?= cve_admin_lang('Inputs', 'title') ?></label>
                                                    <input data-lang="<?= $lang->getCode(); ?>" type="text" class="form-control custom-title">
                                                </div>
                                                <div class="form-group">
                                                    <label><?= $lang->getTitle(); ?> URL</label>
                                                    <input data-lang="<?= $lang->getCode(); ?>" type="text" class="form-control custom-url">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="<?= current_url(); ?>" class="btn btn-primary btn-lg"><?= cve_admin_lang('Buttons', 'clear') ?></a>
                                    <button type="submit" class="btn btn-success btn-lg menu-item-add"><?= cve_admin_lang('Buttons', 'add') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="dd" id="menu-list">
                                    <ol class="dd-list" id="menu-item">
                                        <?php if ($data->getValue()): ?>
                                            <?php foreach ($data->getValue() as $menu): ?>
                                                <?php cve_tree_menu($data, $menu); ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<li class="dd-item dd3-item item-clone" data-id="" data-module="" style="display: none">
    <div class="dd-handle dd3-handle"></div>
    <div class="dd3-content">
        <span class="item-title"></span>
        <button class="btn btn-icon btn-sm btn-danger menu-item-delete" style="float: right">
            <i class="fas fa-times"></i>
        </button>
    </div>
</li>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>

    <?= script_tag(PUBLIC_ADMIN_JS_PATH . 'jquery.nestable.js'); ?>
    <?= script_tag(PUBLIC_ADMIN_JS_PATH . 'menu.js'); ?>

<?php $this->endSection(); ?>
