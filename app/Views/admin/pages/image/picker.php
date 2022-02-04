<div class="modal-header">
    <h5 class="modal-title"><?= cve_admin_lang_path('Buttons', 'single_modal_title') ?></h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body image-picker-modal-body">
    <div class="form-group">
        <form action="<?= base_url(route_to('admin_image_upload')); ?>" id="<?= $divId; ?>" class="dropzone">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </form>
        <hr>
        <div class="row gutters-sm" id="single-image-list">
            <?php foreach($images as $image): ?>
                <div class="col-6 col-sm-2">
                    <label class="imagecheck mb-4">
                        <input data-id="<?= $image->id; ?>"
                               data-original="<?= $image->getUrl(); ?>"
                               data-src="<?= $image->getUrl('187x134'); ?>"
                               name="imagecheck"
                               type="<?= $type == 'editor' || $type == 'single' ? 'radio' : 'checkbox' ; ?>"
                               value="<?= $image->id; ?>"
                               class="imagecheck-input"  />
                        <figure class="imagecheck-figure">
                            <img src="<?= $image->getUrl('187x134'); ?>" class="imagecheck-image">
                        </figure>
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
                <input style="width: 500px;" id="image-url-input" type="text" class="form-control image-url-input" placeholder="" aria-label="">
                <div class="input-group-append">
                    <button class="btn btn-primary image-url-copy" type="button"><i class="far fa-clipboard"></i></button>
                </div>
            </div>
        </div>
    </div>
    <?php if($type == 'editor'): ?>
        <button type="button" class="btn btn-primary image-picker-use"><?= cve_admin_lang_path('Buttons', 'save') ?></button>
    <?php elseif($type == 'single'): ?>
        <button type="button" class="btn btn-primary image-picker-select"><?= cve_admin_lang_path('Buttons', 'single_modal_button_title') ?></button>
    <?php elseif($type == 'multi'): ?>
        <button type="button" class="btn btn-primary images-picker-select"><?= cve_admin_lang_path('Buttons', 'multi_modal_button_title') ?></button>
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
    <?= $variable; ?>.on("complete", function(file) {
        let image = JSON.parse(file.xhr.response);
        if(!image.status){
            iziToast.error({message: image.message.file, position: 'topRight'});
        }else{
            $('#single-image-list').prepend('<div class="col-6 col-sm-2">\n' +
                '<label class="imagecheck mb-4">\n' +
                '<input data-original="'+image.original+'" data-id="'+image.id+'" data-src="'+image.src+'" name="imagecheck" type="radio" value="6" class="imagecheck-input"  />\n' +
                '<figure class="imagecheck-figure">\n' +
                '<img src="'+image.src+'" alt="" class="imagecheck-image">\n' +
                '</figure>\n' +
                '</label>\n' +
                '</div>');
        }
    });
</script>