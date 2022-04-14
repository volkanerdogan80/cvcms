<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= cve_admin_lang('Analytics', 'visitor_history') ?></h1>
            <div class="section-header-breadcrumb">
                <a href="<?= base_url(route_to('admin_analytics_realtime')); ?>" class="btn btn-primary">
                    <i class="fas fa-user-clock"></i> <?= cve_admin_lang('Buttons', 'instant_visitors') ?>
                </a>
            </div>
        </div>
        <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><?= $page_title ?></h4>
                    <form class="card-header-form">
                        <div class="input-group">
                            <input value="" name="dateFilter" placeholder="<?= cve_admin_lang('Inputs', 'date_filter') ?>" type="text" class="form-control daterange-analytics">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="visitors-tab2" data-toggle="tab" href="#visitors" role="tab" aria-controls="listing" aria-selected="true"><?= cve_admin_lang('Analytics', 'visitors') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="referral-tab2" data-toggle="tab" href="#referral" role="tab" aria-controls="referral" aria-selected="false"><?= cve_admin_lang('Analytics', 'referrals') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="browser-tab2" data-toggle="tab" href="#browser" role="tab" aria-controls="browser" aria-selected="false"><?= cve_admin_lang('Analytics', 'browser') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="operating-tab2" data-toggle="tab" href="#operating" role="tab" aria-controls="operating" aria-selected="false"><?= cve_admin_lang('Analytics', 'operating') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="keywords-tab2" data-toggle="tab" href="#keywords" role="tab" aria-controls="keywords" aria-selected="false"><?= cve_admin_lang('Analytics', 'keywords') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="topContent-tab2" data-toggle="tab" href="#topContent" role="tab" aria-controls="topContent" aria-selected="false"><?= cve_admin_lang('Analytics', 'top_content') ?></a>
                        </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                        <div class="tab-pane fade show active" id="visitors" role="tabpanel" aria-labelledby="visitors-tab2">
                            <?= $this->include('admin/pages/analytics/partials/visitors'); ?>
                        </div>
                        <div class="tab-pane fade" id="referral" role="tabpanel" aria-labelledby="referral-tab2">
                            <?= $this->include('admin/pages/analytics/partials/referral'); ?>
                        </div>
                        <div class="tab-pane fade" id="browser" role="tabpanel" aria-labelledby="browser-tab2">
                            <?= $this->include('admin/pages/analytics/partials/browser'); ?>
                        </div>
                        <div class="tab-pane fade" id="operating" role="tabpanel" aria-labelledby="operating-tab2">
                            <?= $this->include('admin/pages/analytics/partials/operating'); ?>
                        </div>
                        <div class="tab-pane fade" id="keywords" role="tabpanel" aria-labelledby="keywords-tab2">
                            <?= $this->include('admin/pages/analytics/partials/keywords'); ?>
                        </div>
                        <div class="tab-pane fade" id="topContent" role="tabpanel" aria-labelledby="topContent-tab2">
                            <?= $this->include('admin/pages/analytics/partials/top-content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<script>
    $("input[name=dateFilter]").val('<?= @$dateFilter?>');
</script>
<?= script_tag(PUBLIC_ADMIN_JS_PATH . 'countries.js') ?>
<?= script_tag(PUBLIC_ADMIN_JS_PATH . 'jquery.vmap.min.js') ?>
<?= script_tag(PUBLIC_ADMIN_JS_PATH . 'jquery.vmap.world.js') ?>
<?= script_tag(PUBLIC_ADMIN_JS_PATH . 'analytics.js') ?>
<script>
    let admin_realtime_visitors = '<?= base_url(route_to('admin_realtime_visitors')); ?>'
</script>
<?php $this->endSection(); ?>
