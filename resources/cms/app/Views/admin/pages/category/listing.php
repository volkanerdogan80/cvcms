<?php $this->extend('admin/layout/main'); ?>

<?php $segment = service('request')->uri->getSegment(5); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kategoriler</h1>

                <div class="section-header-breadcrumb">
                    <a href="<?= base_url(route_to('admin_category_create')); ?>" class="btn btn-primary">
                        Yeni Kategori Ekle
                    </a>
                </div>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link <?= empty($segment) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_category_listing', null)) ?>">
                                    Hepsi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $segment == strtolower(STATUS_ACTIVE) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_category_listing', '/active')) ?>">
                                    Aktif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $segment == strtolower(STATUS_PASSIVE) ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_category_listing', '/passive')) ?>">
                                    Pasif
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?= $segment == 'deleted' ? 'active' : '' ?>"
                                   href="<?= base_url(route_to('admin_category_listing', '/deleted')) ?>">
                                    Silinmiş
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= current_url(); ?>" method="get">
                            <div class="float-left">
                                <div class="row ml-3">
                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            İşlem
                                        </button>
                                        <div class="dropdown-menu">
                                            <?php if ($segment != 'deleted'): ?>
                                                <a class="dropdown-item all-delete" href="javascript:void(0)" data-url="<?= base_url(route_to('admin_category_delete')); ?>">Sil</a>
                                                <a class="dropdown-item all-status-change" data-status="<?= STATUS_ACTIVE ?>" data-url="<?= base_url(route_to('admin_category_status')) ?>" href="javascript:void(0)">Aktife Al</a>
                                                <a class="dropdown-item all-status-change" data-status="<?= STATUS_PASSIVE ?>" data-url="<?= base_url(route_to('admin_category_status')) ?>" href="javascript:void(0)">Pasife Al</a>
                                            <?php else: ?>
                                                <a class="dropdown-item all-undo-delete" data-url="<?= base_url(route_to('admin_category_undo_delete')); ?>" href="javascript:void(0)">Geri Al</a>
                                                <a class="dropdown-item all-purge-delete" data-url="<?= base_url(route_to('admin_category_purge_delete')); ?>" href="javascript:void(0)">Kalıcı Olarak Sil</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select name="perPage" class="form-control">
                                            <option value="">İçerik Sayısı</option>
                                            <?php foreach (config('system')->perPageList as $per): ?>
                                                <option value="<?= $per ?>"><?= $per ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select name="module" class="form-control">
                                            <option value="">Modül Seç</option>
                                            <option <?= $module == MODULE_BLOG ? 'selected': '' ?> value="<?= MODULE_BLOG ?>"><?= lang('General.text.' . MODULE_BLOG); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="user" class="form-control">
                                            <option value="">Kullanıcı Seç</option>
                                            <?php foreach ($users as $value): ?>
                                                <option <?= $user == $value->id ? 'selected': '' ?> value="<?= $value->id ?>"><?= $value->getFullName(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="row">
                                    <div class="input-group col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input value="" name="dateFilter" placeholder="Tarihe Göre Filtrele" type="text" class="form-control daterange-cus">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-light date_filter_clear"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group col">
                                        <input value="" name="search" type="text" class="form-control" placeholder="Ara...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="clearfix mb-3"></div>

                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <tr>
                                    <th class="pt-2">
                                        <div class="custom-checkbox custom-checkbox-table custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>Başlık</th>
                                    <th>Modül</th>
                                    <th>Üst Kategori</th>
                                    <th>Oluşturan</th>
                                    <th>Oluşturma Tarihi</th>
                                    <th>Durum</th>
                                </tr>
                                <?php foreach ($categories as $category): ?>
                                    <tr data-id="<?= $category->id; ?>">
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input data-id="<?= $category->id; ?>" type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-<?= $category->id; ?>">
                                                <label for="checkbox-<?= $category->id; ?>" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <?= $category->getTitle(); ?>
                                            <?php if ($segment == 'deleted'): ?>
                                                <div class="table-links">
                                                    <div class="bullet"></div>
                                                    <a data-url="<?= base_url(route_to('admin_category_undo_delete')); ?>" class="text-success undo-delete" href="javascript:void(0)">
                                                        Geri Al
                                                    </a>
                                                    <div class="bullet"></div>
                                                    <a class="text-danger purge-delete" data-url="<?= base_url(route_to('admin_category_purge_delete')); ?>" href="javascript:void(0)">
                                                        Kalıcı Olarak Sil
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <div class="table-links">
                                                    <div class="bullet"></div>
                                                    <a href="<?= base_url(route_to('admin_category_edit',  $category->id)); ?>">
                                                        Düzenle
                                                    </a>
                                                    <div class="bullet"></div>
                                                    <div class="dropdown d-inline mr-2">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Durumunu Değiştir
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item status-change"
                                                               data-status="<?= STATUS_ACTIVE ?>"
                                                               data-url="<?= base_url(route_to('admin_category_status')) ?>"
                                                               href="javascript:void(0)">
                                                                Aktife Al
                                                            </a>
                                                            <a class="dropdown-item status-change"
                                                               data-status="<?= STATUS_PASSIVE ?>"
                                                               data-url="<?= base_url(route_to('admin_category_status')) ?>"
                                                               href="javascript:void(0)">
                                                                Pasife Al
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="bullet"></div>
                                                    <a data-url="<?= base_url(route_to('admin_category_delete')); ?>" href="javascript:void(0)" class="text-danger delete">Sil</a>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $category->getModule(); ?></td>
                                        <td><?= $category->getParentId() ? $category->withParent()->getTitle() : 'Yok'; ?></td>
                                        <td><?= $category->withUser()->getFullName() ?></td>
                                        <td><?= $category->getCreatedAt(); ?></td>
                                        <td>
                                            <div style="<?= $category->getStatus() != STATUS_ACTIVE ? 'display: none' : '' ?>" class="badge badge-status badge-status-active badge-success">Aktif</div>
                                            <div style="<?= $category->getStatus() != STATUS_PASSIVE ? 'display: none' : '' ?>" class="badge badge-status badge-status-passive badge-danger">Pasif</div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<script>
    $("input[name=dateFilter]").val('<?= $dateFilter?>');
    $("select[name=perPage]").val('<?= $perPage?>');
</script>
<?php $this->endSection(); ?>
