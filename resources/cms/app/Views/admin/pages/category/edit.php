<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= $category->getTitle(); ?> <?= lang('Blogs.text.edit'); ?></h1>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="card">
                    <form action="<?= current_url(); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="card-header">
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
                                            <?= $lang->getTitle(); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.parent_category'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <select name="parent_id" class="form-control select2">
                                        <option value=""><?= lang('Input.text.null'); ?></option>
                                        <?php foreach ($categories as $cat): ?>
                                            <?php if ($category->getParentId() == $cat->id): ?>
                                                <option selected value="<?= $cat->id; ?>"><?= $cat->getTitle(); ?></option>
                                            <?php else: ?>
                                                <option value="<?= $cat->id; ?>"><?= $cat->getTitle(); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <?php foreach (cve_language() as $key => $lang): ?>
                                    <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>" id="<?= $lang->getCode(); ?>" role="tabpanel" aria-labelledby="<?= $lang->getCode(); ?>-tab">
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= $lang->getTitle(); ?> <?= lang('Input.text.title'); ?></label>
                                            <div class="col-sm-12 col-md-8">
                                                <input name="title[<?= $lang->getCode(); ?>]" value="<?= $category->getTitle($lang->getCode()); ?>" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= $lang->getTitle(); ?> <?= lang('Input.text.description'); ?></label>
                                            <div class="col-sm-12 col-md-8">
                                                <textarea name="description[<?= $lang->getCode(); ?>]" class="form-control" style="height: 150px"><?= $category->getDescription($lang->getCode()); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= $lang->getTitle(); ?> <?= lang('Input.text.keywords'); ?></label>
                                            <div class="col-sm-12 col-md-8">
                                                <input name="keywords[<?= $lang->getCode(); ?>]" value="<?= $category->getKeywords($lang->getCode()); ?>" type="text" class="form-control inputtags">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.module'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <select name="module" class="form-control select2" required>
                                        <option value="<?= MODULE_BLOG ?>"><?= lang('General.text.' . MODULE_BLOG); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.status'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input <?= $category->getStatus() == STATUS_ACTIVE ? 'checked' : ''; ?> type="radio" name="status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('Input.text.active'); ?></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input <?= $category->getStatus() == STATUS_PASSIVE ? 'checked' : ''; ?> type="radio" name="status" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= lang('Input.text.passive'); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"><?= lang('Input.text.image'); ?></label>
                                <div class="col-sm-12 col-md-8">
                                    <?= cve_single_image_picker(
                                            'category-image', 'image', 'category-image-id', [
                                                'image' => $category->getImage() ? $category->withImage()->getUrl() : null,
                                                'value' => $category->getImage()
                                            ]
                                    ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row " style="justify-content: center">
                                <div class="col-sm-12 col-md-8">
                                    <button type="submit" class="btn btn-success btn-block btn-lg"><?= lang('Blogs.text.save_btn'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>

<script>
    $(".inputtags").tagsinput('items');
</script>

<?php $this->endSection(); ?>
