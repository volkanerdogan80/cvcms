<div id="<?= $areaID; ?>" class="row gutters-sm">
    <?php foreach ($images as $image): ?>
        <div class="gallery-item ml-4">
            <button class="btn btn-danger btn-block gallery-item-delete"><i class="fas fa-trash"></i></button>
            <label class="mb-4">
                <input type="hidden" name="<?= $inputName ?>[]" value="<?= $image->id ?>">
                <img  src="<?= base_url(LOADING_GIF); ?>"
                      data-src="<?= $image->getUrl('187x134'); ?>"
                      style="width: 187px; height: 134px;"
                      class="imagecheck-image lazyload">
            </label>
        </div>
    <?php endforeach; ?>
</div>
