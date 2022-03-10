<div class="modal-header">
    <h5 class="modal-title"><?= cve_admin_lang('Buttons', 'single_modal_title') ?></h5>
    <button type="button" style="font-size: 30px" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body image-picker-modal-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <select class="form-control select2 image-listing-status">
                    <option value="all-image"><?= cve_admin_lang('Inputs', 'all_uploaded_img'); ?></option>
                    <option value="new-image"><?= cve_admin_lang('Inputs', 'currently_uploaded_img'); ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-9">
            <form action="<?= base_url(route_to('admin_image_filter')); ?>" method="get" class="row" id="cve-image-picker-filter">
                <div class="col-md-5">
                    <div class="form-group col-md-12">
                        <select name="group" class="form-control select2 image-listing-group">
                            <option value=""><?= cve_admin_lang('Inputs', 'group_select') ?></option>
                            <?php foreach ($image_groups as $group): ?>
                                <?php if ($group->getGroup() == 'default'){continue;} ?>
                                <option value="<?= $group->getGroup(); ?>"><?= $group->getGroupName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="search" type="text" class="form-control image-search" placeholder="<?= cve_admin_lang('Inputs', 'search'); ?>...">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="hidden" name="type" value="<?= $type ?>">
                        <button class="btn btn-primary btn-lg" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block"
                type="button"
                data-toggle="collapse"
                data-target="#collapseDropzone"
                aria-expanded="false"
                aria-controls="collapseDropzone"
        >
            <?= cve_admin_lang('Buttons', 'upload_image') ?>
        </button>
    </div>
    <div class="form-group">
        <div class="collapse" id="collapseDropzone">
            <?= $this->include(PANEL_FOLDER . '/pages/image/partials/upload-form'); ?>
        </div>
        <hr>
        <div class="row gutters-sm" id="single-image-list">
            <?php foreach ($images as $image): ?>
                <div data-id="<?= $image->id; ?>"  data-name="<?= $image->getName() ?>" class="all-image col-6 col-sm-2">
                    <button class="btn btn-danger btn-sm m-2 image-delete"
                            data-id="<?= $image->id; ?>"
                            data-url="<?= base_url(route_to('admin_image_delete')) ?>"
                            style="position: absolute; right: 75px; z-index: 10000"
                    >
                        <i class="fas fa-trash"></i>
                    </button>
                    <label class="imagecheck mb-4">
                        <input data-id="<?= $image->id; ?>"
                               data-original="<?= $image->getUrl(); ?>"
                               data-src="<?= $image->getUrl('187x134'); ?>"
                               name="imagecheck"
                               type="<?= $type == 'editor' || $type == 'single' ? 'radio' : 'checkbox'; ?>"
                               value="<?= $image->id; ?>"
                               class="imagecheck-input"/>
                        <figure style="width: 190px;" class="imagecheck-figure">
                            <img src="<?= base_url(LOADING_GIF); ?>"
                                 data-src="<?= $image->getUrl('187x134'); ?>"
                                 style="width: 100%; height: 134px;"
                                 class="imagecheck-image lazyload">
                        </figure>
                        <span style="width: 190px;"  class="badge badge-light image-picker-name-three-dots">
                            <?= $image->getName() ?>
                        </span>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="mr-auto">
        <div class="form-group">
            <div class="input-group mb-3">
                <input style="width: 500px;" id="image-url-input" type="text" class="form-control image-url-input"
                       placeholder="" aria-label="">
                <div class="input-group-append">
                    <button class="btn btn-primary image-url-copy" type="button"><i class="far fa-clipboard"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="image-pager">
        <?= $pager->links('default', 'cms_pager'); ?>
    </div>
    <?php if ($type == 'editor'): ?>
        <button type="button" class="btn btn-primary image-picker-use"><?= cve_admin_lang('Buttons', 'save') ?></button>
    <?php elseif ($type == 'single'): ?>
        <button type="button"
                class="btn btn-primary image-picker-select"><?= cve_admin_lang('Buttons', 'single_modal_button_title') ?></button>
    <?php elseif ($type == 'multi'): ?>
        <button type="button"
                class="btn btn-primary images-picker-select"><?= cve_admin_lang('Buttons', 'multi_modal_button_title') ?></button>
    <?php endif; ?>
</div>


<div style="display: none"
     id="<?= $type; ?>-modal-attribute"
     data-src="<?= $src_id; ?>"
     data-input="<?= $input_id; ?>"
     data-area="<?= $area; ?>"
</div>

<script>
    Dropzone.autoDiscover = false;
    let <?= $variable; ?> = new Dropzone("#<?= $divId; ?>");

    <?= $variable; ?>.on('processing', function () {
        this.options.url = $('.cve-image-upload-form').attr('action');
    })

    <?= $variable; ?>.on("complete", function(file) {
        let image = JSON.parse(file.xhr.response);
        if(!image.status){
            iziToast.error({message: image.message.file, position: 'topRight'});
        }else{
            $('#single-image-list').prepend('<div data-id="'+image.id+'"  data-name="'+image.name+'" class="new-image all-image col-6 col-sm-2">\n' +
                '<button class="btn btn-danger btn-sm m-2 image-delete"'+
                'data-id="'+image.id+'"'+
                'data-url="<?= base_url(route_to('admin_image_delete')) ?>"'+
                'style="position: absolute; right: 75px; z-index: 10000">'+
                '<i class="fas fa-trash"></i>'+
                '</button>'+
                '<label class="imagecheck mb-4">\n' +
                '<input data-original="'+image.original+'" data-id="'+image.id+'" data-src="'+image.src+'" name="imagecheck" type="radio" value="6" class="imagecheck-input"  />\n' +
                '<figure style="width: 190px;"  class="imagecheck-figure">\n' +
                '<img src="'+image.src+'" style="width: 100%; height: 134px" alt="" class="imagecheck-image lazyload">\n' +
                '<span class="badge badge-light image-picker-name-three-dots">'+image.name+'</span>'+
                '</figure>\n' +
                '</label>\n' +
                '</div>');
        }
    });

    $("img.lazyload").lazyload();
</script>