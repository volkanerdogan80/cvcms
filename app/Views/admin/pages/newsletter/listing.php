<?php $this->extend('admin/layout/main'); ?>

<?php $segment = service('request')->uri->getSegment(5); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Sidebar', 'email_subscribers'); ?></h1>
            </div>

            <?= $this->include('admin/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="float-left">
                            <div class="row ml-2">
                                <div class="dropdown d-inline mr-2">
                                    <button class="btn btn-primary btn-lg dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <?= cve_admin_lang('Buttons', 'action'); ?>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item all-unsubscribe"
                                           href="javascript:void(0)"
                                           data-url="<?= base_url(route_to('admin_newsletter_unsubscribe', 'all')); ?>">
                                            <?= cve_admin_lang('Buttons', 'delete'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="float-right mr-2">
                            <div class="row">
                                <button type="button" class="btn btn-primary btn-lg mr-2" data-toggle="modal"
                                        data-target="#filter">
                                    <?= cve_admin_lang('Buttons', 'filter'); ?>
                                </button>
                                <a href="<?= current_url(); ?>" class="btn btn-primary btn-lg">
                                    <?= cve_admin_lang('Buttons', 'clear'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="clearfix mb-3"></div>

                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <tr>
                                    <th class="pt-2">
                                        <div class="custom-checkbox custom-checkbox-table custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                   class="custom-control-input" id="checkbox-all">
                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th><?= cve_admin_lang('Inputs', 'full_name'); ?></th>
                                    <th><?= cve_admin_lang('Inputs', 'email'); ?></th>
                                    <th><?= cve_admin_lang('General', 'created_at'); ?></th>
                                </tr>
                                <?php foreach ($subscribers as $key => $subscriber): ?>
                                    <tr data-id="<?= $subscriber->id; ?>">
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input data-id="<?= $subscriber->id ?>" type="checkbox"
                                                       data-checkboxes="mygroup" class="custom-control-input"
                                                       id="checkbox-<?= $subscriber->id ?>">
                                                <label for="checkbox-<?= $subscriber->id ?>" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><?= $subscriber->name; ?>
                                            <div class="table-links">
                                                <div class="bullet"></div>
                                                <a data-url="<?= base_url(route_to('admin_newsletter_unsubscribe', $subscriber->token)); ?>"
                                                   href="javascript:void(0)"
                                                   class="text-danger unsubscribe">
                                                    <?= cve_admin_lang('Buttons', 'delete'); ?>
                                                </a>
                                            </div>
                                        </td>
                                        <td><?= $subscriber->email; ?></td>
                                        <td><?= $subscriber->created_at; ?></td>
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
                    <h5 class="modal-title"><?= cve_admin_lang('Buttons', 'filter'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?= current_url(); ?>" method="get">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input value="" name="dateFilter"
                                               placeholder="<?= cve_admin_lang('Inputs', 'date_filter'); ?>"
                                               type="text" class="form-control daterange-cus">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-light date_filter_clear"><i
                                                        class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input value="<?= $search; ?>" name="search" type="text" class="form-control"
                                               placeholder="<?= cve_admin_lang('Inputs', 'search'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="per_page" class="form-control select2">
                                        <option value=""><?= cve_admin_lang('Inputs', 'per_page'); ?></option>
                                        <?php foreach (config('system')->perPageList as $per): ?>
                                            <option value="<?= $per ?>"><?= $per ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-lg"
                                type="submit"><?= cve_admin_lang('Buttons', 'filter'); ?></button>
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