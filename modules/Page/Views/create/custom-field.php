<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4><?= cve_admin_lang_path('General', 'extra_fields'); ?></h4>
            <div class="card-header-action">
                <div class="btn-group dropleft">
                    <button style="border-radius: 5px !important;" class="btn btn-primary dropdown-toggle"
                            type="button" id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <?= cve_admin_lang_path('Buttons', 'add_extra_fields'); ?>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item new-field"
                           data-url="<?= base_url(route_to("admin_field_add")); ?>"
                           data-type="standard">
                            <?= cve_admin_lang_path('Buttons', 'fixed_fields'); ?>
                        </a>
                        <a class="dropdown-item new-field"
                           data-url="<?= base_url(route_to("admin_field_add")); ?>"
                           data-type="translation">
                            <?= cve_admin_lang_path('Buttons', 'language_option'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" id="custom-field">
        </div>
    </div>
</div>