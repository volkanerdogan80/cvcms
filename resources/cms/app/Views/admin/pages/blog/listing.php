<?php $this->extend('admin/layout/main'); ?>

<?php $segment = service('request')->uri->getSegment(5); ?>

<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Blog Yazıları</h1>

            <div class="section-header-breadcrumb">
                <a href="<?= base_url(route_to('admin_blog_create')); ?>" class="btn btn-primary">
                    Yeni Blog Ekle
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
                               href="<?= base_url(route_to('admin_blog_listing', null)) ?>">
                                Hepsi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $segment == strtolower(STATUS_ACTIVE) ? 'active' : '' ?>"
                               href="<?= base_url(route_to('admin_blog_listing', '/active')) ?>">
                                Aktif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $segment == strtolower(STATUS_PASSIVE) ? 'active' : '' ?>"
                               href="<?= base_url(route_to('admin_blog_listing', '/passive')) ?>">
                                Pasif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $segment == strtolower(STATUS_PENDING) ? 'active' : '' ?>"
                               href="<?= base_url(route_to('admin_blog_listing', '/pending')) ?>">
                                Beklemede
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $segment == 'deleted' ? 'active' : '' ?>"
                               href="<?= base_url(route_to('admin_blog_listing', '/deleted')) ?>">
                                Silinmiş
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="float-left">
                        <div class="row ml-2">
                            <div class="dropdown d-inline mr-2">
                                <button class="btn btn-primary btn-lg dropdown-toggle"
                                        type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                >
                                    İşlem
                                </button>
                                <div class="dropdown-menu">
                                    <?php if ($segment != 'deleted'): ?>
                                        <a class="dropdown-item all-delete" href="javascript:void(0)" data-url="<?= base_url(route_to('admin_blog_delete')) ?>">Sil</a>
                                        <a class="dropdown-item all-status-change" data-status="<?= STATUS_ACTIVE ?>" data-url="<?= base_url(route_to('admin_blog_status')) ?>" href="javascript:void(0)">Aktife Al</a>
                                        <a class="dropdown-item all-status-change" data-status="<?= STATUS_PASSIVE ?>" data-url="<?= base_url(route_to('admin_blog_status')) ?>" href="javascript:void(0)">Pasife Al</a>
                                        <a class="dropdown-item all-status-change" data-status="<?= STATUS_PENDING ?>" data-url="<?= base_url(route_to('admin_blog_status')) ?>" href="javascript:void(0)">Beklemeye Al</a>
                                    <?php else: ?>
                                        <a class="dropdown-item all-undo-delete" data-url="<?= base_url(route_to('admin_blog_undo_delete')); ?>" href="javascript:void(0)">Geri Al</a>
                                        <a class="dropdown-item all-purge-delete" data-url="<?= base_url(route_to('admin_blog_purge_delete')); ?>" href="javascript:void(0)">Kalıcı Olarak Sil</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="float-right mr-2">
                        <div class="row">
                            <button type="button" class="btn btn-primary btn-lg mr-2" data-toggle="modal" data-target="#filter">Filtrele</button>
                            <a href="<?= current_url(); ?>" class="btn btn-primary btn-lg">Temizle</a>
                        </div>
                    </div>
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
                                <th>Yazar</th>
                                <th>Kategori</th>
                                <th>Okunma</th>
                                <th>Oluşturma Tarihi</th>
                                <th>Durum</th>
                            </tr>
                            <?php foreach ($blogs as $blog): ?>
                                <tr data-id="<?= $blog->id; ?>">
                                    <td>
                                        <div class="custom-checkbox custom-control">
                                            <input data-id="<?= $blog->id; ?>" type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-<?= $blog->id; ?>">
                                            <label for="checkbox-<?= $blog->id; ?>" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $blog->getTitle(); ?>
                                        <?php if ($segment == 'deleted'): ?>
                                            <div class="table-links">
                                                <div class="bullet"></div>
                                                <a data-url="<?= base_url(route_to('admin_blog_undo_delete')); ?>" class="text-success undo-delete" href="javascript:void(0)">
                                                    Geri Al
                                                </a>
                                                <div class="bullet"></div>
                                                <a class="text-danger purge-delete" data-url="<?= base_url(route_to('admin_blog_purge_delete')); ?>" href="javascript:void(0)">
                                                    Kalıcı Olarak Sil
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="table-links">
                                                <div class="bullet"></div>
                                                <a href="<?= base_url(route_to('admin_blog_edit',  $blog->id)); ?>">
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
                                                           data-url="<?= base_url(route_to('admin_blog_status')); ?>"
                                                           href="javascript:void(0)">
                                                            Aktife Al
                                                        </a>
                                                        <a class="dropdown-item status-change"
                                                           data-status="<?= STATUS_PASSIVE ?>"
                                                           data-url="<?= base_url(route_to('admin_blog_status')); ?>"
                                                           href="javascript:void(0)">
                                                            Pasife Al
                                                        </a>
                                                        <a class="dropdown-item status-change"
                                                           data-status="<?= STATUS_PENDING ?>"
                                                           data-url="<?= base_url(route_to('admin_blog_status')); ?>"
                                                           href="javascript:void(0)">
                                                            Beklemeye Al
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="bullet"></div>
                                                <a data-url="<?= base_url(route_to('admin_blog_delete')) ?>" href="javascript:void(0)" class="text-danger delete">Sil</a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $blog->withUser()->getFullName(); ?></td>
                                    <td>
                                        <a href="javascript:;"
                                           data-toggle="popover"
                                           title="Yazı Kategorileri"
                                           data-content="
                                                        <?php foreach ($blog->withCategories() as $blog_category): ?>
                                                        <?= $blog_category->getTitle(); ?> -
                                                        <?php endforeach; ?>
                                                    "
                                           data-trigger="focus">
                                            Görüntüle
                                        </a>
                                    </td>
                                    <td><?= $blog->getViews(); ?></td>
                                    <td><?= $blog->getCreatedAt(); ?></td>
                                    <td>
                                        <div style="<?= $blog->getStatus() != STATUS_ACTIVE ? 'display: none' : '' ?>" class="badge badge-status badge-status-active badge-success">Aktif</div>
                                        <div style="<?= $blog->getStatus() != STATUS_PASSIVE ? 'display: none' : '' ?>" class="badge badge-status badge-status-passive badge-danger">Pasif</div>
                                        <div style="<?= $blog->getStatus() != STATUS_PENDING ? 'display: none' : '' ?>" class="badge badge-status badge-status-pending badge-warning">Beklemede</div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <?= $pager->links('default', 'cms_pager'); ?>
                </div>

            </div>
        </div>
    </section>
</div>

<div id="filter" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filtrele</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= current_url(); ?>" method="get">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="user" class="form-control select2">
                                    <option value="">Kullanıcı Seç</option>
                                    <?php foreach ($users as $value): ?>
                                        <option <?= $user == $value->id ? 'selected': '' ?> value="<?= $value->id ?>"><?= $value->getFullName(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="category" class="form-control select2">
                                    <option value="">Kategori Seç</option>
                                    <?php foreach ($categories as $value): ?>
                                        <option <?= $category == $value->id ? 'selected': '' ?> value="<?= $value->id ?>"><?= $value->getTitle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
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
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input value="<?= $search; ?>" name="search" type="text" class="form-control" placeholder="Ara...">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="perpage" class="form-control select2">
                                    <option value="">İçerik Sayısı</option>
                                    <?php foreach (config('system')->perPageList as $per): ?>
                                        <option value="<?= $per ?>"><?= $per ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-lg" type="submit">Filtrele</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<script>
    $("input[name=dateFilter]").val('<?= $dateFilter?>');
    $("select[name=perPage]").val('<?= $perPage?>');
</script>
<?php $this->endSection(); ?>
