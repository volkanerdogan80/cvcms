<div class="card-footer">
    <div class="gallery gallery-sm">
        <?php foreach ($content->withGallery() as $image): ?>
            <div class="gallery-item"
                 data-image="<?= $image->getUrl(); ?>"
                 data-title="Image 1"
                 href="<?= $image->getUrl('187x134'); ?>"
                 title="Image 1"
                 style="background-image: url(&quot;<?= $image->getUrl('187x134'); ?>&quot;);">
            </div>
        <?php endforeach; ?>
    </div>
</div>




