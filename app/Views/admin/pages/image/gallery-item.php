<div id="<?= $areaID; ?>" class="row gutters-sm">
    <?php foreach ($images as $image): ?>
        <div class="gallery-item ml-4">
            <label class="mb-4">
                <input type="hidden" name="<?= $inputName ?>[]" value="<?= $image->id ?>">
                <img src="<?= $image->getUrl('187x134'); ?>" class="imagecheck-image">
            </label>
            <button class="btn btn-danger btn-block gallery-item-delete">Kaldır</button>
        </div>
    <?php endforeach; ?>
</div>
