<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>Özel Alanlar</h4>
            <div class="card-header-action">
                <div class="btn-group dropleft">
                    <button style="border-radius: 5px !important;" class="btn btn-primary dropdown-toggle"
                            type="button" id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        Yeni Alan Ekle
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item new-field" data-url="<?= base_url(route_to("admin_field_add")); ?>" data-type="standard">Sabit Alan</a>
                        <a class="dropdown-item new-field" data-url="<?= base_url(route_to("admin_field_add")); ?>" data-type="translation">Dil Seçenekli</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" id="custom-field">
        </div>
    </div>
</div>

