<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Whatsapp Telefon Numarası
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <input value="<?= cve_component_setting('whatsappPhone') ?>" name="setting[whatsappPhone]" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Karşılama Mesajı
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <input value="<?= cve_component_setting('whatsappPopupMessage') ?>" name="setting[whatsappPopupMessage]" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Kullanıcı Mesajı
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <input value="<?= cve_component_setting('whatsappMessage') ?>" name="setting[whatsappMessage]" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Chat Ekranı Başlık
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <input value="<?= cve_component_setting('whatsappTitle') ?>" name="setting[whatsappTitle]" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Whatsapp Resim
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <?= cve_single_image_picker('whatsapp-image', 'setting[whatsappImage]', 'whatsapp-image-id', [
                            'image' => cve_image_url(cve_component_setting('whatsappImage')),
                            'value' => cve_component_setting('whatsappImage'),
                        ]); ?>
                    </div>
                </div>


                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        Buton Konumu
                    </label>
                    <div class="col-sm-12 col-md-9">
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input <?= cve_component_setting('whatsappPosition') == 'left' ? 'checked' : ''; ?> type="radio" name="setting[whatsappPosition]" value="left" class="selectgroup-input">
                                <span class="selectgroup-button">Solda</span>
                            </label>
                            <label class="selectgroup-item">
                                <input <?= cve_component_setting('whatsappPosition') == 'right' ? 'checked' : ''; ?> type="radio" name="setting[whatsappPosition]" value="right" class="selectgroup-input">
                                <span class="selectgroup-button">Sağda</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'save'); ?></button>
    </div>
</div>
