<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label">Yayın Durumu</label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="status" value="<?= STATUS_ACTIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button">Aktif</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="status" value="<?= STATUS_PASSIVE ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button">Pasif</span>
                    </label>
                    <label class="selectgroup-item">
                        <input checked type="radio" name="status" value="<?= STATUS_PENDING ?>" class="selectgroup-input" required>
                        <span class="selectgroup-button">Beklemede</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label">Kategoriler</label>
                <select name="categories[]" class="form-control select2" multiple="" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id; ?>"><?= $category->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label">Görsel</label>
                <br>
                <?= cve_single_image_picker('blog-image', 'thumbnail', 'blog-image-id'); ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label class="col-form-label">Benzer İçerik</label>
                <select name="similar[]" class="form-control select2" multiple="">
                    <?php foreach ($blogs as $blog): ?>
                        <option value="<?= $blog->id; ?>"><?= $blog->getTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success btn-block btn-lg">Kaydet</button>
        </div>
    </div>
</div>

