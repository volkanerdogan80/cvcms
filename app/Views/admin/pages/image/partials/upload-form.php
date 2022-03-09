<div class="row">
    <div class="col-md-12">
        <form action="<?= base_url(route_to('admin_image_upload')); ?>" id="<?= $divId; ?>" class="dropzone cve-image-upload-form">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </form>
        <div class="test" style="position: absolute;right: 25px;top: 10px;width: 25%;z-index:100">
            <div class="card" style="border: 1px solid #ccc!important;">
                <div class="card-body">
                    <div class="form-group">
                        <select class="form-control select2 image-group-select">
                            <option value="default"><?= cve_admin_lang('Inputs', 'group_select'); ?></option>
                            <option value="new-group"><?= cve_admin_lang('Inputs', 'group_add'); ?></option>
                            <?php foreach ($image_groups as $group): ?>
                                <?php if ($group->getGroup() == 'default'){continue;} ?>
                                <option value="<?= $group->getGroup(); ?>"><?= $group->getGroupName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group image-group-name" style="display:none;">
                        <input type="text" class="form-control" placeholder="<?= cve_admin_lang('Inputs', 'group_title'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
