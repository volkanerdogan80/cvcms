<?php foreach($images as $image): ?>
    <div data-name="<?= $image->getName(); ?>" class="all-image col-6 col-sm-2">
        <label class="imagecheck mb-4">
            <input data-id="<?= $image->id; ?>"
                   data-original="<?= $image->getUrl(); ?>"
                   data-src="<?= $image->getUrl('187x134'); ?>"
                   name="imagecheck"
                   type="<?= $type == 'editor' || $type == 'single' ? 'radio' : 'checkbox' ; ?>"
                   value="<?= $image->id; ?>"
                   class="imagecheck-input"  />
            <figure class="imagecheck-figure">
                <img style="width: 187px; height: 134px;"
                     src="<?= $image->getUrl('187x134'); ?>"
                     class="imagecheck-image"
                >
                <span class="badge badge-light image-picker-name-three-dots">
                                <?= $image->getName(); ?>
                            </span>
            </figure>
        </label>
    </div>
<?php endforeach; ?>