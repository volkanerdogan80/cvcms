<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="section-title">Sayfa Ayarları</h4>
                <div class="card-header-action">
                    <a data-collapse="#page-setting" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                </div>
            </div>
            <div class="collapse show" id="page-setting" style="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    Kayıt Sayfasını Seç
                                </label>
                                <select name="setting[register]" class="form-control select2" required>
                                    <?php foreach (cve_posts(['module' => 'page']) as $page): ?>
                                        <option <?= cve_theme_setting('register') == $page->id ? 'selected' : null; ?>
                                                value="<?= $page->id; ?>"><?= $page->getTitle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    Giriş Sayfasını Seç
                                </label>
                                <select name="setting[login]" class="form-control select2" required>
                                    <?php foreach (cve_posts(['module' => 'page']) as $page): ?>
                                        <option <?= cve_theme_setting('login') == $page->id ? 'selected' : null; ?>
                                                value="<?= $page->id; ?>"><?= $page->getTitle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    Şifremi Unuttum Sayfasını Seç
                                </label>
                                <select name="setting[forgot]" class="form-control select2" required>
                                    <?php foreach (cve_posts(['module' => 'page']) as $page): ?>
                                        <option <?= cve_theme_setting('forgot') == $page->id ? 'selected' : null; ?>
                                                value="<?= $page->id; ?>"><?= $page->getTitle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    Favori İçeriklerim Sayfası
                                </label>
                                <select name="setting[favorite]" class="form-control select2" required>
                                    <?php foreach (cve_posts(['module' => 'page']) as $page): ?>
                                        <option <?= cve_theme_setting('favorite') == $page->id ? 'selected' : null; ?>
                                                value="<?= $page->id; ?>"><?= $page->getTitle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    Popüler İçerikler Listeleme Sayfası
                                </label>
                                <select name="setting[popular]" class="form-control select2" required>
                                    <?php foreach (cve_posts(['module' => 'page']) as $page): ?>
                                        <option <?= cve_theme_setting('popular') == $page->id ? 'selected' : null; ?>
                                                value="<?= $page->id; ?>"><?= $page->getTitle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    En Çok Beğenilenler
                                </label>
                                <select name="setting[top_liked]" class="form-control select2" required>
                                    <?php foreach (cve_posts(['module' => 'page']) as $page): ?>
                                        <option <?= cve_theme_setting('top_liked') == $page->id ? 'selected' : null; ?>
                                                value="<?= $page->id; ?>"><?= $page->getTitle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="section-title">Slider Ayarları</h4>
                <div class="card-header-action">
                    <a data-collapse="#slider-setting" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                </div>
            </div>
            <div class="collapse show" id="slider-setting" style="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    İçerik Sayısı
                                </label>
                                <input value="<?= cve_theme_setting('slider_count'); ?>" name="setting[slider_count]"
                                       type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    Modül Seç
                                </label>
                                <select name="setting[slider_module]" class="form-control select2" required>
                                    <?php foreach (cve_module_list() as $module): ?>
                                        <option <?= cve_theme_setting('slider_module') == $module ? 'selected' : null; ?>
                                                value="<?= $module ?>">
                                            <?= cve_admin_lang($module, 'module'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    Kategori/ler Seçiniz
                                </label>
                                <select name="setting[slider_category][]" class="form-control select2" multiple="">
                                    <?php foreach (cve_categories(['module' => 'blog']) as $category): ?> <!-- 'module !=' => null -->
                                        <option <?= !is_null(cve_theme_setting('slider_category')) && in_array($category->id, cve_theme_setting('slider_category')) ? 'selected' : ''; ?>
                                                value="<?= $category->id; ?>"><?= $category->getTitle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="section-title">Ana Sayfa Haftanın En Çok Okunan Widget Ayarları</h4>
                <div class="card-header-action">
                    <a data-collapse="#homepage-setting" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                </div>
            </div>
            <div class="collapse show" id="homepage-setting" style="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    İçerik Sayısı
                                </label>
                                <input value="<?= cve_theme_setting('top_week_count'); ?>"
                                       name="setting[top_week_count]" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    Modül Seç
                                </label>
                                <select name="setting[top_week_module]" class="form-control select2" required>
                                    <?php foreach (cve_module_list() as $module): ?>
                                        <option <?= cve_theme_setting('top_week_module') == $module ? 'selected' : null; ?>
                                                value="<?= $module ?>">
                                            <?= cve_admin_lang($module, 'module'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">
                                    Kategori/ler Seçin
                                </label>
                                <select name="setting[top_week_category][]" class="form-control select2" multiple="">
                                    <?php foreach (cve_categories(['module !=' => null]) as $category): ?>
                                        <option <?= !is_null(cve_theme_setting('top_week_category')) && in_array($category->id, cve_theme_setting('top_week_category')) ? 'selected' : ''; ?>
                                                value="<?= $category->id; ?>"><?= $category->getTitle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="section-title">Reklam Alanları Ayarları</h4>
                <div class="card-header-action">
                    <a data-collapse="#advertisement-setting" class="btn btn-icon btn-info" href="#">
                        <i class="fas fa-minus"></i>
                    </a>
                </div>
            </div>
            <div class="collapse show" id="advertisement-setting" style="">
                <div class="card-body">
                    <div class="form-group">
                        <label class="col-form-label">
                            Reklam Alanları
                        </label>
                        <textarea style="height: 150px" name="setting[home_page_sidebar_ads]" type="text"
                                  class="codeeditor"><?= cve_theme_setting('home_page_sidebar_ads'); ?></textarea>
                    </div><hr>
                    <div class="form-group">
                        <label class="col-form-label">
                            Kategori Sidebar Reklam Alanı
                        </label>
                        <textarea style="height: 150px" name="setting[category_sidebar_ads]" type="text"
                                  class="codeeditor"><?= cve_theme_setting('category_sidebar_ads'); ?></textarea>
                    </div><hr>
                    <div class="form-group">
                        <label class="col-form-label">
                            Tekil Sayfa Sidebar Reklam Alanı
                        </label>
                        <textarea style="height: 150px" name="setting[single_sidebar_ads]" type="text"
                                  class="codeeditor"><?= cve_theme_setting('single_sidebar_ads'); ?></textarea>
                    </div><hr>
                    <div class="form-group">
                        <label class="col-form-label">
                            Anasayfa Sidebar 1. Sponsored
                        </label>
                        <textarea style="height: 150px" name="setting[home_page_sidebar_1_sponsored]" type="text"
                                  class="codeeditor"><?= cve_theme_setting('home_page_sidebar_1_sponsored'); ?></textarea>
                    </div><hr>
                    <div class="form-group">
                        <label class="col-form-label">
                            Anasayfa Sidebar 2. Sponsored
                        </label>
                        <textarea style="height: 150px" name="setting[home_page_sidebar_2_sponsored]" type="text"
                                  class="codeeditor"><?= cve_theme_setting('home_page_sidebar_2_sponsored'); ?></textarea>
                    </div><hr>
                    <div class="form-group">
                        <label class="col-form-label">
                            Anasayfa Sidebar 3. Sponsored
                        </label>
                        <textarea style="height: 150px" name="setting[home_page_sidebar_3_sponsored]" type="text"
                                  class="codeeditor"><?= cve_theme_setting('home_page_sidebar_3_sponsored'); ?></textarea>
                    </div><hr>
                    <div class="form-group">
                        <label class="col-form-label">
                            Anasayfa Sidebar 4. Sponsored
                        </label>
                        <textarea style="height: 150px" name="setting[home_page_sidebar_4_sponsored]" type="text"
                                  class="codeeditor"><?= cve_theme_setting('home_page_sidebar_4_sponsored'); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-success btn-block btn-lg"><?= cve_admin_lang('Buttons', 'save') ?></button>
    </div>
</div>
